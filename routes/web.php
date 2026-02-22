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

/*
 * Route::resource('habits', HabitController::class) gera automaticamente:
 *
 * GET         /habits              habits.index
 * GET         /habits/create       habits.create
 * POST        /habits              habits.store
 * GET         /habits/{habit}      habits.show
 * GET         /habits/{habit}/edit habits.edit
 * PUT/PATCH   /habits/{habit}      habits.update
 * DELETE      /habits/{habit}      habits.destroy
 */
Route::middleware('auth')->group(function () {
    Route::resource('habits', HabitController::class);
    Route::post('habits/{habit}/toggle', [HabitController::class, 'toggle'])->name('habits.toggle');
});

// Rotas publicas
Route::get('/home', [SiteController::class, 'index']);
