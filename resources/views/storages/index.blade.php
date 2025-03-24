<!-- resources/views/storages/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Storage Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('storages.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add New Storage Item</a>
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Quantity</th>
                                <th class="px-4 py-2">Storage Building</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($storages as $storage)
                                <tr>
                                    <td class="border px-4 py-2">{{ $storage->name }}</td>
                                    <td class="border px-4 py-2">{{ $storage->quantity }}</td>
                                    <td class="border px-4 py-2">{{ $storage->storageBuilding->name }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('storages.edit', $storage->id) }}" class="text-yellow-500">Edit</a> | 
                                        <a href="{{ route('storages.show', $storage->id) }}" class="text-blue-500">View</a> | 
                                        <form action="{{ route('storages.delete', $storage->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
