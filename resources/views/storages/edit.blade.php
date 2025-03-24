<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Storage Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Displaying error message -->
                    @if(session('error'))
                        <div class="bg-red-500 text-white p-4 mb-4 rounded-md">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-500 text-white p-4 mb-4 rounded-md">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('storages.update', $storage->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name" class="block">Name</label>
                            <input type="text" name="name" id="name" value="{{ $storage->name }}" class="w-full px-4 py-2 border rounded-md" required>
                        </div>
                        <div class="mt-4">
                            <label for="quantity" class="block">Quantity</label>
                            <input type="number" name="quantity" id="quantity" value="{{ $storage->quantity }}" class="w-full px-4 py-2 border rounded-md" required>
                        </div>
                        <div class="mt-4">
                            <label for="storage_building_id" class="block">Storage Building</label>
                            <select name="storage_building_id" id="storage_building_id" class="w-full px-4 py-2 border rounded-md" required>
                                @foreach($storageBuildings as $building)
                                    <option value="{{ $building->id }}" @if($storage->storage_building_id == $building->id) selected @endif>
                                        {{ $building->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
