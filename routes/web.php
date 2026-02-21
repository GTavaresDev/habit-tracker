<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Rotas de login e logout
Route::get('/login', [LoginController::class, 'index'])->name('site.index');
Route::post('/login', [LoginController::class, 'authenticate'])->name('site.auth');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('site.logout');

// Rota de cadastra de Usuario
Route::get('/create-user', [RegisterController::class, 'index'])->name('site.create-user');
Route::post('/create-user', [RegisterController::class, 'store'])->name('site.auth.register');

// Rota de Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [SiteController::class, 'dashboard'])->name('site.dashboard');

    // Habits
    Route::get('/create-habit', [HabitController::class, 'index'])->name('site.create-habit');
    Route::post('/create-habit', [HabitController::class, 'store'])->name('site.create-habit');
    Route::delete('/delete-habit/{habit}', [HabitController::class, 'destroy'])->name('site.delete-habit');
    Route::get('/update-habit/{habit}/edit', [HabitController::class, 'edit'])->name('site.edit-habit');
    Route::put('/update-habit/{habit}', [HabitController::class, 'update'])->name('site.update-habit');
});

// Rotas publicas
Route::get('/home', [SiteController::class, 'index']);
