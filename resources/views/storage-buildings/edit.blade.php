<!-- resources/views/storage-buildings/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Storage Building</h1>

    <form action="{{ route('storage-buildings.update', $storageBuilding->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $storageBuilding->name }}" required>
        </div>
        <div>
            <label for="capacity">Capacity:</label>
            <input type="number" name="capacity" id="capacity" value="{{ $storageBuilding->capacity }}" required>
        </div>
        <div>
            <label for="location">Location:</label>
            <input type="text" name="location" id="location" value="{{ $storageBuilding->location }}" required>
        </div>
        <button type="submit">Update Storage Building</button>
    </form>
@endsection
