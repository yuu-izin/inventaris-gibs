<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RecapController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\InventoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Building
Route::get('/building', [BuildingController::class, 'index'])->name('building.index');
Route::get('/building/create', [BuildingController::class, 'create'])->name('building.create');
Route::post('/building', [BuildingController::class, 'store'])->name('building.store');
Route::get('/building/{id}/edit', [BuildingController::class, 'edit'])->name('building.edit');
Route::put('/building/{id}', [BuildingController::class, 'update'])->name('building.update');
Route::delete('/building/{id}', [BuildingController::class, 'destroy'])->name('building.destroy');

// Room
Route::get('/buildings/{building}/rooms', [RoomsController::class, 'index'])->name('room.index');
Route::get('/buildings/{building}/rooms/create', [RoomsController::class, 'create'])->name('room.create');
Route::post('/buildings/{building}/rooms', [RoomsController::class, 'store'])->name('room.store');
Route::get('/buildings/{building}/rooms/{room}/edit', [RoomsController::class, 'edit'])->name('room.edit');
Route::put('/buildings/{building}/rooms/{room}', [RoomsController::class, 'update'])->name('room.update');
Route::delete('/buildings/{building}/rooms/{room}', [RoomsController::class, 'destroy'])->name('room.destroy');

// inventories
Route::resource('buildings.rooms.inventories', InventoryController::class);
Route::get('/buildings/{building}/rooms/{room}/inventories', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/buildings/{building}/rooms/{room}/inventories/create', [InventoryController::class, 'create'])->name('inventory.create');
Route::post('/buildings/{building}/rooms/{room}/inventories', [InventoryController::class, 'store'])->name('inventory.store');
Route::get('/inventory/{inventory}/edit/{building}/{room}', [InventoryController::class, 'edit'])->name('inventory.edit');
Route::put('/buildings/{building}/rooms/{room}/inventories/{inventory}', [InventoryController::class, 'update'])->name('inventory.update');
Route::delete('/buildings/{building}/rooms/{room}/inventories/{inventory}', [InventoryController::class, 'destroy'])->name('inventory.destroy');

// item
Route::get('/items', [ItemController::class, 'index'])->name('item.index');
Route::get('/items/create', [ItemController::class, 'create'])->name('item.create');
Route::post('/items', [ItemController::class, 'store'])->name('item.store');
Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('item.edit');
Route::put('/items/{item}', [ItemController::class, 'update'])->name('item.update');
Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('item.destroy');

// rekap
Route::get('/recap', [RecapController::class, 'index'])->name('recap.index');
Route::get('/recap/export', [RecapController::class, 'export'])->name('recap.export');

// officer
Route::get('/officers', [OfficerController::class, 'index'])->name('officer.index');
Route::get('/officers/create', [OfficerController::class, 'create'])->name('officer.create');
Route::post('/officers', [OfficerController::class, 'store'])->name('officer.store');
Route::get('/officers/{officer}/edit', [OfficerController::class, 'edit'])->name('officer.edit');
Route::put('/officers/{officer}', [OfficerController::class, 'update'])->name('officer.update');
Route::delete('/officers/{officer}', [OfficerController::class, 'destroy'])->name('officer.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
