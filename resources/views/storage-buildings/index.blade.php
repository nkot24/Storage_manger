<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storage Buildings</title>
</head>
<body>
    <h1>Storage Buildings</h1>

    <!-- Button to navigate to the Create Storage Building page -->
    <a href="{{ route('storage-buildings.create') }}">
        <button>Create New Storage Building</button>
    </a>

    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Capacity</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($storageBuildings as $building)
                <tr>
                    <td>{{ $building->name }}</td>
                    <td>{{ $building->capacity }}</td>
                    <td>{{ $building->location }}</td>
                    <td>
                        <a href="{{ route('storage-buildings.show', $building->id) }}">Show</a> |
                        <a href="{{ route('storage-buildings.edit', $building->id) }}">Edit</a> |
                        <form action="{{ route('storage-buildings.destroy', $building->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
