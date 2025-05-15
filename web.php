<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SimulationController;
use Illuminate\Support\Facades\Route;


Route::get('login', [AuthController::class, 'index'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::post('logout', [AuthController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/simulation', [SimulationController::class, 'index'])
    ->name('simulation')
    ->middleware('auth');

Route::get('/drag-drop-test', function () {
    return view('drag-drop-test');
})->name('drag-drop-test');

Route::get('/component-manager', [\App\Http\Controllers\ComponentController::class, 'index'])->name('component-manager');
Route::get('/components/{id}/edit', [\App\Http\Controllers\ComponentController::class, 'edit'])->name('components.edit');
Route::put('/components/{id}', [\App\Http\Controllers\ComponentController::class, 'update'])->name('components.update');


