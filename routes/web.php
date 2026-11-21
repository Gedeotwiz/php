<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function(){
    return 'Hello Gedeon welcome to Laraver app';
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'registerFromWeb'])->name('register.store');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'loginFromWeb'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/users', [AuthController::class, 'showUsers'])->name('users.index');
    Route::post('/logout', [AuthController::class, 'logoutFromWeb'])->name('logout');
});
