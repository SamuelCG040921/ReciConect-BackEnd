<?php

use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\SolicitudRecoleccionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//index
Route::get('/SolicitudRecoleccion', [SolicitudRecoleccionController::class, 'index']);
Route::post('/SolicitudRecoleccion', [SolicitudRecoleccionController::class, 'store']);

//Endpoints de usuario
Route::post('/registro', [UsuarioController::class, 'registrar']);
Route::post('/login', [UsuarioController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UsuarioController::class, 'logout']);
});