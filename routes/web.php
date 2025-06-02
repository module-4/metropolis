<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComponentBlockListController;
use App\Http\Controllers\ComponentEffectManagementController;
use App\Http\Controllers\PDFReportController;
use App\Http\Controllers\SimulationController;
use App\Models\ComponentNotification;
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
    return view('dashboard', [
        'notifications' => ComponentNotification::orderBy('created_at', 'desc')->limit(5)->get(),
    ]);
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

Route::middleware('auth')->group(function () {
    Route::get('/component-manager', [\App\Http\Controllers\ComponentController::class, 'index'])->name('component-manager');
    Route::post('/component-manager', [\App\Http\Controllers\ComponentController::class, 'store'])->name('component-store');
    Route::get('/components-manager/{component}/edit', [\App\Http\Controllers\ComponentController::class, 'edit'])->name('components.edit');
    Route::patch('/components-manager/{component}', [\App\Http\Controllers\ComponentController::class, 'update'])->name('components.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/blocklist', [ComponentBlockListController::class, 'index'])->name('blocklist.index');
    Route::get('/blocklist/create', [ComponentBlockListController::class, 'create'])->name('blocklist.create');
    Route::delete('/blocklist/{componentId}/{blockedComponentId}', [ComponentBlockListController::class, 'destroy'])->name('blocklist.destroy');
    Route::post('/blocklist', [ComponentBlockListController::class, 'store'])->name('blocklist.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/report', [PDFReportController::class, 'show'])->name('reports.show');
});
