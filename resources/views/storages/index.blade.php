<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storage Items</title>
</head>
<body>
    <h1>Storage Items</h1>

    <!-- Button to navigate to the Create Storage Item page -->
    <a href="{{ route('storages.create') }}">
        <button>Create New Storage Item</button>
    </a>

    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Storage Building</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($storages as $storage)
                <tr>
                    <td>{{ $storage->name }}</td>
                    <td>{{ $storage->quantity }}</td>
                    <td>{{ $storage->storageBuilding->name }}</td>
                    <td>
                        <a href="{{ route('storages.show', $storage->id) }}">Show</a> |
                        <a href="{{ route('storages.edit', $storage->id) }}">Edit</a> |
                        <form action="{{ route('storages.delete', $storage->id) }}" method="POST" style="display:inline;">
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
