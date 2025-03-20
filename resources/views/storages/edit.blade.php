<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Storage Item</title>
</head>
<body>
    <h1>Edit Storage Item</h1>
    <form action="{{ route('storages.update', $storage->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Item Name:</label>
            <input type="text" name="name" id="name" value="{{ $storage->name }}" required>
        </div>
        <div>
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="{{ $storage->quantity }}" required>
        </div>
        <div>
            <label for="storage_building_id">Storage Building:</label>
            <select name="storage_building_id" id="storage_building_id" required>
                @foreach ($storageBuildings as $building)
                    <option value="{{ $building->id }}" {{ $storage->storage_building_id == $building->id ? 'selected' : '' }}>
                        {{ $building->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Update Storage Item</button>
    </form>
</body>
</html>
