<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SimulationController;

Route::put("/simulation/{simulation}/component", [SimulationController::class, 'updateComponent']);
Route::get("/simulation/{simulation}/neighbors", [SimulationController::class, 'getNeighbors']);
