<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Site\Habit\HabitController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

// Rotas de login e logout
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('site.auth');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('site.logout');

// Rota de cadastra de Usuario
Route::get('/create-user', [RegisterController::class, 'index'])->name('site.create-user');
Route::post('/create-user', [RegisterController::class, 'store'])->name('site.auth.register');

// Rotas de Habits (Resource)
Route::middleware('auth')->group(function () {
    Route::resource('habits', HabitController::class);
});

// Rotas publicas
Route::get('/home', [SiteController::class, 'index']);
