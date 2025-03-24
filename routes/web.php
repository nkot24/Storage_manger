<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\StorageBuildingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('storages')->group(function () {
    Route::get('/', [StorageController::class, 'index'])->name('storages.index');
    Route::get('/create', [StorageController::class, 'create'])->name('storages.create');
    Route::post('/store', [StorageController::class, 'store'])->name('storages.store');
    Route::get('/{id}', [StorageController::class, 'show'])->name('storages.show');
    Route::get('/{id}/edit', [StorageController::class, 'edit'])->name('storages.edit');
    Route::put('/{id}', [StorageController::class, 'update'])->name('storages.update');
    Route::delete('/{id}', [StorageController::class, 'delete'])->name('storages.delete');
    Route::get('/{id}/transfer', [StorageController::class, 'transfer'])->name('storages.transfer');

// Handle the transfer logic
    Route::post('/{id}/transfer', [StorageController::class, 'transferToAnotherStorage'])->name('storages.transferToAnotherStorage');
});
Route::prefix('storage-buildings')->group(function () {
    Route::get('/', [StorageBuildingController::class, 'index'])->name('storage-buildings.index');
    Route::get('/create', [StorageBuildingController::class, 'create'])->name('storage-buildings.create');
    Route::post('/store', [StorageBuildingController::class, 'store'])->name('storage-buildings.store');
    Route::get('/{id}', [StorageBuildingController::class, 'show'])->name('storage-buildings.show');
    Route::get('/{id}/edit', [StorageBuildingController::class, 'edit'])->name('storage-buildings.edit');
    Route::put('/{id}', [StorageBuildingController::class, 'update'])->name('storage-buildings.update');
    Route::delete('/{id}', [StorageBuildingController::class, 'destroy'])->name('storage-buildings.destroy');
    Route::post('/{id}/send', [StorageBuildingController::class, 'sendToAnotherBuilding'])->name('storage-buildings.send');
});

require __DIR__.'/auth.php';
