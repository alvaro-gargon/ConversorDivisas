<?php

use App\Http\Controllers\AutentificacionController;
use App\Http\Controllers\ConversorController;
use App\Http\Controllers\DivisasFavUsuarioController;
use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

//rutas para la pagina de inico de sesion
Route::post('/registro', [AutentificacionController::class, 'registro']);
Route::post('/login',    [AutentificacionController::class, 'login']);
//rutas para las divisas
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/convertir', [ConversorController::class, 'convertir']);
    Route::get('/favoritos', [DivisasFavUsuarioController::class, 'index']);
    Route::post('/favoritos', [DivisasFavUsuarioController::class, 'store']);
    Route::delete('/favoritos/{id}', [DivisasFavUsuarioController::class, 'destroy']);
    Route::get('/fotoPerfil',[UsuarioController::class, 'getFotoPerfil']);
    Route::get('/avatares', [UsuarioController::class, 'getAvatares']);
    Route::patch('/editarFotoPerfil', [UsuarioController::class, 'editarFotoPerfil']);
});
Route::get('/historico', [HistoricoController::class, 'historico']);