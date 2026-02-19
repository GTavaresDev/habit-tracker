<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Rotas de login e logout
Route::get('/login', [LoginController::class, 'index'])->name('site.index');
Route::post('/login', [LoginController::class, 'authenticate'])->name('site.auth');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('site.logout');

// Rota de Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [SiteController::class, 'dashboard'])->name('site.dashboard');
});

// Rotas publicas
Route::get('/home', [SiteController::class, 'index']);
