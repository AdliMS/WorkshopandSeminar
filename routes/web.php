<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestDashboardController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;

// admin views
Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin');

require __DIR__.'/auth.php';

// guest views
Route::get('/', [GuestDashboardController::class, 'index']);
Route::get('/seminar', [GuestDashboardController::class, 'getSeminars']);
Route::get('/workshop', [GuestDashboardController::class, 'getWorkshops']);
Route::get('/seminar/{seminar}', [SeminarController::class, 'show']);
Route::get('/workshop/{workshop}', [WorkshopController::class, 'show']);

Route::get('/seminar/{seminar}/registration', [SeminarController::class, 'create']);
Route::post('/seminar/{seminar}/registration', [SeminarController::class, 'store']);
Route::get('/workshop/{workshop}/registration', [WorkshopController::class, 'create']);
Route::post('/workshop/{workshop}/registration', [WorkshopController::class, 'store']);

app('debugbar')->disable();