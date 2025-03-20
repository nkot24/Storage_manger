<!-- resources/views/storage-buildings/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Storage Building</title>
</head>
<body>
    <h1>Create New Storage Building</h1>

    <form action="{{ route('storage-buildings.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="capacity">Capacity:</label>
        <input type="number" name="capacity" id="capacity" required>

        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required>

        <button type="submit">Create</button>
    </form>
</body>
</html>
