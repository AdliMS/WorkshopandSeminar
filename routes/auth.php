<?php


use App\Http\Controllers\SeminarController;
use App\Http\Controllers\WorkshopController;


use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/admin/seminars', [AuthenticatedSessionController::class, 'getAllSeminars'])->name('admin-all-seminar');
    Route::get('/admin/workshops', [AuthenticatedSessionController::class, 'getAllWorkshops'])->name('admin-all-workshop');

    Route::get('admin/seminar/{seminar}', [AuthenticatedSessionController::class, 'getSeminar'])->name('admin-seminar');
    Route::get('admin/workshop/{workshop}', [AuthenticatedSessionController::class, 'getWorkshop'])->name('admin-workshop');

    Route::get('/admin/seminar/tambah', [AuthenticatedSessionController::class, 'showSeminarForm'])->name('seminar-form');
    Route::get('/admin/workshop/tambah', [AuthenticatedSessionController::class, 'showWorkshopForm'])->name('workshop-form');

    Route::post('/admin/seminar/tambah', [AuthenticatedSessionController::class, 'addSeminar'])->name('add-seminar');
    Route::post('/admin/workshop/tambah', [AuthenticatedSessionController::class, 'addWorkshop'])->name('add-workshop');

    Route::put('admin/seminar/{seminar}', [AuthenticatedSessionController::class, 'updateSeminar'])->name('update-seminar');
    Route::put('admin/workshop/{workshop}', [AuthenticatedSessionController::class, 'updateWorkshop'])->name('update-workshop');

    Route::delete('admin/seminar/{seminar}/delete-participant/{participant}', [AuthenticatedSessionController::class, 'delSeminarParticipant'])->name('admin-seminar-delete-participant');
    Route::delete('admin/workshop/{workshop}/delete-participant/{participant}', [AuthenticatedSessionController::class, 'delWorkshopParticipant'])->name('admin-workshop-delete-participant');
});
