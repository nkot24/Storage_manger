<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use App\Models\StorageBuilding;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    // 1. List all storage items
    public function index()
    {
        $storages = Storage::all(); // Get all storage items
        return view('storages.index', compact('storages')); // Pass the data to the view
    }

    // 2. Create a new storage item
    public function create(Request $request)
    {
        $storageBuildings = StorageBuilding::all();
        // Display the form for creating a new storage item (you can also handle validation in the view)
        return view('storages.create', compact('storageBuildings'));
    }

    // 3. Store a new storage item
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'storage_building_id' => 'required|exists:storage_buildings,id',
        ]);

        // Get the storage building based on the selected storage building ID
        $storageBuilding = StorageBuilding::find($request->storage_building_id);

        // Calculate the total quantity already in the selected storage building
        $totalQuantityInStorage = Storage::where('storage_building_id', $storageBuilding->id)->sum('quantity');
        $newTotalQuantity = $totalQuantityInStorage + $request->quantity;

        // Check if the quantity to be added exceeds the storage building's capacity
        if ($newTotalQuantity > $storageBuilding->capacity) {
            return redirect()->route('storages.create')
                             ->with('error', 'The quantity exceeds the capacity of the storage building.');
        }

        // Create a new Storage item
        $storage = new Storage();
        $storage->name = $request->name;
        $storage->quantity = $request->quantity;
        $storage->storage_building_id = $request->storage_building_id;
        $storage->save();

        // Redirect back to the storage index with a success message
        return redirect()->route('storages.index')->with('success', 'Storage item created successfully.');
    }

    // 4. Show a specific storage item
    public function show($id)
    {
        $storage = Storage::find($id);

        if (!$storage) {
            return redirect()->route('storages.index')->with('error', 'Storage item not found');
        }

        return view('storages.show', compact('storage')); // Pass storage data to the view
    }

    // 5. Show the edit form for a storage item
    public function edit($id)
    {
        $storage = Storage::find($id);

        if (!$storage) {
            return redirect()->route('storages.index')->with('error', 'Storage item not found');
        }

        $storageBuildings = StorageBuilding::all(); // Fetch all storage buildings for selection
        return view('storages.edit', compact('storage', 'storageBuildings')); // Pass data to the edit form view
    }

    // 6. Update a storage item
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
        ]);

        // Find the storage item and its associated storage building
        $storage = Storage::find($id);
        $storageBuilding = StorageBuilding::find($storage->storage_building_id);

        // Calculate the total quantity already in the selected storage building excluding the current item
        $totalQuantityInStorage = Storage::where('storage_building_id', $storageBuilding->id)
                                         ->where('id', '!=', $id)  // Exclude the current item being updated
                                         ->sum('quantity');
        $newTotalQuantity = $totalQuantityInStorage + $request->quantity;

        // Check if the quantity to be updated exceeds the storage building's capacity
        if ($newTotalQuantity > $storageBuilding->capacity) {
            return redirect()->route('storages.edit', $id)
                             ->with('error', 'The quantity exceeds the capacity of the storage building.');
        }

        // Update the storage item
        $storage->name = $request->name;
        $storage->quantity = $request->quantity;
        $storage->save();

        // Redirect back to the storage index with a success message
        return redirect()->route('storages.index')->with('success', 'Storage item updated successfully.');
    }

    // 7. Delete a storage item
    public function delete($id)
    {
        $storage = Storage::find($id);

        if (!$storage) {
            return redirect()->route('storages.index')->with('error', 'Storage item not found');
        }

        $storage->delete();

        return redirect()->route('storages.index')->with('success', 'Storage item deleted successfully');
    }
    public function transfer($id)
    {
        $storage = Storage::find($id);
        if (!$storage) {
            return redirect()->route('storages.index')->with('error', 'Storage item not found');
        }

        // Fetch all available storage buildings for selection
        $storageBuildings = StorageBuilding::all();
        return view('storages.transfer', compact('storage', 'storageBuildings'));
    }

    // 8. Transfer items to another storage building
    public function transferToAnotherStorage(Request $request, $id)
    {
        $request->validate([
            'destination_storage_building_id' => 'required|exists:storage_buildings,id',
        ]);

        $storageItem = Storage::find($id);
        $destinationStorageBuilding = $request->destination_storage_building_id;

        if (!$storageItem) {
            return redirect()->route('storages.index')->with('error', 'Storage item not found');
        }

        // Transfer logic: Update the storage building ID to the new one
        $storageItem->storage_building_id = $destinationStorageBuilding;
        $storageItem->save();

        return redirect()->route('storages.index')->with('success', 'Storage item transferred successfully');
    }
}
