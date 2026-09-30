<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function (\Illuminate\Http\Request $request) {
    return view('dashboard', ['selectedCar' => $request->user()->car]);
})->middleware(['auth', 'verified'])->name('home');

Route::get('/dashboard', function (\Illuminate\Http\Request $request) {
    return view('dashboard', ['selectedCar' => $request->user()->car]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/game', function (\Illuminate\Http\Request $request) {
    return view('game', ['selectedCar' => $request->user()->car]);
})->middleware(['auth', 'verified'])->name('game');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/cars', [CarController::class, 'index'])->name('cars.select');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';