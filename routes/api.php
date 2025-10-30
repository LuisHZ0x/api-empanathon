<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUserAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Routes

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Private Routes

Route::middleware([IsUserAuth::class])->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::post('logout', 'logout');
        Route::post('me', 'getUser');
    });

    Route::get('participants', [ParticipantsController::class, 'getParticipants']);

    Route::middleware([IsAdmin::class])->group(function () {

        Route::controller(ParticipantsController::class)->group(function () {
            Route::post('participants', 'addParticipants');
            Route::get('/participants/{id}', 'getParticipantsById');
            Route::patch('/participants/{id}', 'updateParticipantById');
            Route::delete('/participants/{id}', 'deleteParticipantById');
        });
    });
});
