<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComponentEffectManagementController;
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

Route::get('/component-effect-management', [ComponentEffectManagementController::class, 'index'])
    ->name('component-effect-management')
    ->middleware('auth');

Route::patch('/component-effect-management/{componentId}/{effectId}', [ComponentEffectManagementController::class, 'update'])
    ->name('component-effect-management-update')
    ->middleware('auth');

Route::get('/drag-drop-test', function () {
    return view('drag-drop-test');
})->name('drag-drop-test');
