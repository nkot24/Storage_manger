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

        $storage = new Storage();
        $storage->name = $request->name;
        $storage->quantity = $request->quantity;
        $storage->storage_building_id = $request->storage_building_id;
        $storage->save();

        // Redirect back to the storage index with a success message
        return redirect()->route('storages.index')->with('success', 'Storage item created successfully');
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

        return view('storages.edit', compact('storage')); // Pass storage data to the edit form view
    }

    // 6. Update a storage item
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
        ]);

        $storage = Storage::find($id);

        if (!$storage) {
            return redirect()->route('storages.index')->with('error', 'Storage item not found');
        }

        $storage->name = $request->name;
        $storage->quantity = $request->quantity;
        $storage->save();

        return redirect()->route('storages.index')->with('success', 'Storage item updated successfully');
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
