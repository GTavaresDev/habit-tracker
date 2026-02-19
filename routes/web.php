<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Auth\LoginController;

//Rotas de login
Route::get('/login', [LoginController::class, 'index']);

//Rota de Dashboard
Route::get('/home', [SiteController::class, 'index']);