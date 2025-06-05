<?php

use App\Http\Controllers\Api\SimulationComponentApi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SimulationController;


Route::group(['prefix' => 'simulation/{simulation}'], function () {
    return [
        Route::group(["prefix" => 'component'], function () {
            return [
                Route::post("/", [SimulationComponentApi::class, 'store']),
                Route::delete("/", [SimulationComponentApi::class, 'destroy']),
                Route::patch("/", [SimulationComponentApi::class, 'update']),
            ];
        }),

        Route::get("/neighbors", [SimulationController::class, 'getNeighbors']),
        Route::get("/isblocked", [SimulationController::class, 'isBlocked']),
        Route::patch("/toggle-approved-status", [SimulationController::class, 'toggleApprovedStatus'])
    ];
});
