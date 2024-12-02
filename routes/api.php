<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AuthenticatedSeminarController;
use App\Http\Controllers\API\AuthenticatedWorkshopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('seminars', AuthenticatedSeminarController::class);
    Route::apiResource('workshops', AuthenticatedWorkshopController::class);
});
