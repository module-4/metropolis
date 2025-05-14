<?php

use App\Http\Controllers\Api\SimulationComponentApi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SimulationController;


Route::group(['prefix' => 'simulation/{simulation}'], function () {
    return [
        Route::group(["prefix" => 'component'], function () {
            return [
                Route::post("/", [SimulationComponentApi::class, 'index']),
                Route::delete("/", [SimulationComponentApi::class, 'destroy']),
                Route::patch("/", [SimulationComponentApi::class, 'index'])
            ];
        })
    ];
});
//Route::put("/simulation/{simulation}/component", [SimulationController::class, 'updateComponent']);
Route::get("/simulation/{simulation}/neighbors", [SimulationController::class, 'getNeighbors']);
