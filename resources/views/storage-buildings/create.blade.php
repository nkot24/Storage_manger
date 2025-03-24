<!-- resources/views/storage-buildings/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Storage Building') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('storage-buildings.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block">Name</label>
                            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md" required>
                        </div>
                        <div class="mt-4">
                            <label for="capacity" class="block">Capacity</label>
                            <input type="number" name="capacity" id="capacity" class="w-full px-4 py-2 border rounded-md" required>
                        </div>
                        <div class="mt-4">
                            <label for="location" class="block">Location</label>
                            <input type="text" name="location" id="location" class="w-full px-4 py-2 border rounded-md" required>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
