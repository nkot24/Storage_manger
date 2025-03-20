<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\StorageBuildingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/storages', [StorageController::class, 'index'])->name('storages.index'); // Index route first
Route::get('/storages/create', [StorageController::class, 'create'])->name('storages.create');
Route::post('/storages', [StorageController::class, 'store'])->name('storages.store');
Route::get('/storages/{id}', [StorageController::class, 'show'])->name('storages.show');
Route::get('/storages/{id}/edit', [StorageController::class, 'edit'])->name('storages.edit');
Route::put('/storages/{id}', [StorageController::class, 'update'])->name('storages.update');
Route::delete('/storages/{id}', [StorageController::class, 'delete'])->name('storages.delete');
Route::post('/storages/{id}/transfer', [StorageController::class, 'transferToAnotherStorage'])->name('storages.transferToAnotherStorage');


Route::get('/storage-buildings', [StorageBuildingController::class, 'index'])->name('storage-buildings.index'); // Index route first
Route::get('/storage-buildings/create', [StorageBuildingController::class, 'create'])->name('storage-buildings.create');
Route::post('/storage-buildings', [StorageBuildingController::class, 'store'])->name('storage-buildings.store');
Route::get('/storage-buildings/{id}', [StorageBuildingController::class, 'show'])->name('storage-buildings.show');
Route::get('/storage-buildings/{id}/edit', [StorageBuildingController::class, 'edit'])->name('storage-buildings.edit');
Route::put('/storage-buildings/{id}', [StorageBuildingController::class, 'update'])->name('storage-buildings.update');
Route::delete('/storage-buildings/{id}', [StorageBuildingController::class, 'destroy'])->name('storage-buildings.destroy');
Route::post('/storage-buildings/{id}/send', [StorageBuildingController::class, 'sendToAnotherBuilding'])->name('storage-buildings.sendToAnotherBuilding');
