<?php

namespace App\Http\Controllers;

use App\Models\StorageBuilding;
use Illuminate\Http\Request;

class StorageBuildingController extends Controller
{
    // 1. List all storage buildings
    public function index()
    {
        $storageBuildings = StorageBuilding::all();
        return view('storage-buildings.index', compact('storageBuildings'));
    }

    // 2. Create a new storage abuilding
    public function create(Request $request)
    {
        $storageBuildings = StorageBuilding::all();
        
        return view('storage-buildings.create', compact('storageBuildings'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',        // Name is required, a string with max length of 255
            'capacity' => 'required|integer',           // Capacity is required and should be an integer
            'location' => 'required|string|max:255',    // Location is required, a string with max length of 255
        ]);

        // Create a new StorageBuilding instance and save it to the database
        $storageBuilding = new StorageBuilding();
        $storageBuilding->name = $request->name;               // Store the name
        $storageBuilding->capacity = $request->capacity;       // Store the capacity
        $storageBuilding->location = $request->location;       // Store the location
        $storageBuilding->save();                              // Save the new storage building

        // Redirect to the storage buildings index page with a success message
        return redirect()->route('storage-buildings.index')
                         ->with('success', 'Storage building created successfully!');
    }

    // 3. Show a specific storage building
    public function show($id)
    {
        $storageBuilding = StorageBuilding::find($id);

        if (!$storageBuilding) {
            return response()->json(['message' => 'Storage building not found'], 404);
        }

        return view('storage-buildings.show', compact('storageBuildings'));
    }

    public function edit($id)
    {
        // Find the storage building by its ID
        $storageBuilding = StorageBuilding::find($id);
    
        // If the storage building is not found, redirect to the index page with an error message
        if (!$storageBuilding) {
            return redirect()->route('storage-buildings.index')
                             ->with('error', 'Storage building not found');
        }
    
        // Pass the storage building to the view
        return view('storage-buildings.edit', compact('storageBuilding')); // Pass the correct variable
    }
    

    // Update a storage building
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'location' => 'required|string|max:255',
        ]);

        // Find the storage building by its ID
        $storageBuilding = StorageBuilding::find($id);

        // If the storage building is not found, redirect to the index page with an error message
        if (!$storageBuilding) {
            return redirect()->route('storage-buildings.index')
                             ->with('error', 'Storage building not found');
        }

        // Update the storage building with the new data
        $storageBuilding->name = $request->name;
        $storageBuilding->capacity = $request->capacity;
        $storageBuilding->location = $request->location;
        $storageBuilding->save(); // Save the updated storage building

        // Redirect to the storage buildings index page with a success message
        return redirect()->route('storage-buildings.index')
                         ->with('success', 'Storage building updated successfully');
    }

    

    public function destroy($id)
    {
        // Find the storage building by ID
        $storageBuilding = StorageBuilding::find($id);

        // If the storage building is not found, redirect back with an error message
        if (!$storageBuilding) {
            return redirect()->route('storage-buildings.index')
                             ->with('error', 'Storage building not found');
        }

        // Delete the storage building
        $storageBuilding->delete();

        // Redirect to the storage buildings index page with a success message
        return redirect()->route('storage-buildings.index')
                         ->with('success', 'Storage building deleted successfully');
    }

    // 6. Send contents to another storage building (this might involve transferring items between buildings)
    public function sendToAnotherBuilding(Request $request, $id)
    {
        $request->validate([
            'destination_id' => 'required|exists:storage_buildings,id',
        ]);

        $sourceBuilding = StorageBuilding::find($id);
        $destinationBuilding = StorageBuilding::find($request->destination_id);

        if (!$sourceBuilding || !$destinationBuilding) {
            return response()->json(['message' => 'Storage building not found'], 404);
        }

        // Example action: transfer items (assuming a relationship to items)
        // $sourceBuilding->items()->update(['storage_building_id' => $destinationBuilding->id]);

        return response()->json(['message' => 'Storage contents transferred successfully']);
    }
}
