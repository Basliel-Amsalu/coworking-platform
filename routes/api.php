<?php

use App\Http\Controllers\AmenityController;
use App\Http\Controllers\DeskController;
use App\Http\Controllers\MeetingRoomController;
use App\Http\Controllers\SpaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

// Register
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest:sanctum');

// Login
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest:sanctum');

// Forgot Password
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest:sanctum');

// Reset Password
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest:sanctum');

// Verify Email
Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth:sanctum', 'signed', 'throttle:6,1']);

// Resend Verification Email
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth:sanctum', 'throttle:6,1']);

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:sanctum');


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('spaces', SpaceController::class)->middleware('auth:sanctum');
Route::apiResource('meeting-rooms', MeetingRoomController::class)->middleware('auth:sanctum');
Route::apiResource('desks', DeskController::class)->middleware('auth:sanctum');
Route::apiResource('amenities', AmenityController::class)->middleware('auth:sanctum');