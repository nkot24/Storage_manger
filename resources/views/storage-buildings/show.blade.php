<!-- resources/views/storage-buildings/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Storage Building Details</h1>

    <p><strong>Name:</strong> {{ $storageBuilding->name }}</p>
    <p><strong>Capacity:</strong> {{ $storageBuilding->capacity }}</p>
    <p><strong>Location:</strong> {{ $storageBuilding->location }}</p>

    <a href="{{ route('storage-buildings.index') }}">Back to Storage Buildings List</a>
@endsection
