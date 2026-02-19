<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Middleware;


// Rotas de login e logout
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// Rota de Dashboard
Route::middleware('auth')->group(function () {
  Route::get('/dashboard', [SiteController::class, 'dashboard']);
});

//Rotas publicas
Route::get('/home', [SiteController::class, 'index']);