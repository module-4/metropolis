<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SimulationController;

Route::get("/simulation/{simulation}/component", [SimulationController::class, 'updateComponent']);
