<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storage Item Details</title>
</head>
<body>
    <h1>Storage Item Details</h1>
    <p><strong>Name:</strong> {{ $storage->name }}</p>
    <p><strong>Quantity:</strong> {{ $storage->quantity }}</p>
    <p><strong>Storage Building:</strong> {{ $storage->storageBuilding->name }}</p>
    <a href="{{ route('storages.index') }}">Back to List</a>
</body>
</html>
