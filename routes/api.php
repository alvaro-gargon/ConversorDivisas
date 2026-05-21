<?php

use App\Http\Controllers\AutentificacionController;
use App\Http\Controllers\ConversorController;
use Illuminate\Support\Facades\Route;

//rutas para la pagina de inico de sesion
Route::post('/registro', [AutentificacionController::class, 'registro']);
Route::post('/login',    [AutentificacionController::class, 'login']);
//rutas para las divisas
Route::get('/convertir', [ConversorController::class, 'convertir']);