<?php

use App\Http\Controllers\AutentificacionController;
use Illuminate\Support\Facades\Route;

//rutas para la pagina de inico de sesion
Route::post('/register', [AutentificacionController::class, 'registro']);
Route::post('/login',    [AutentificacionController::class, 'login']);