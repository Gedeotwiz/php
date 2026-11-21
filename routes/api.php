<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'registration'])
    ->middleware('user.exists');

Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users/{id}', [AuthController::class, 'getUserById']);

    Route::middleware('role:admin')->group(function () {
        Route::get('/users', [AuthController::class, 'getAllUsers']);
    });
});

