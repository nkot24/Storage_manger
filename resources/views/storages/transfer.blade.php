<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transfer Storage Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('storages.transferToAnotherStorage', $storage->id) }}" method="POST">
                        @csrf
                        
                        <!-- Display error message if any -->
                        @if($errors->any())
                            <div class="bg-red-500 text-white p-4 mb-4 rounded-md">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="destination_storage_building_id" class="block">Select Destination Storage Building</label>
                            <select name="destination_storage_building_id" id="destination_storage_building_id" class="w-full px-4 py-2 border rounded-md" required>
                                @foreach($storageBuildings as $building)
                                    <option value="{{ $building->id }}">{{ $building->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Transfer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
