<?php

use App\Http\Controllers\Api\EmpresaRecolectoraController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\SolicitudRecoleccionController;
use App\Http\Controllers\Api\SubTipoResiduoController;
use App\Http\Controllers\Api\TipoResiduoController;
use App\Http\Controllers\Api\RecoleccionController;
use App\Models\EmpresaRecolectora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//SOLICITUDES RECOLECCION
Route::get('/SolicitudRecoleccion', [SolicitudRecoleccionController::class, 'index']);
Route::get('/SolicitudRecoleccion/{id}', [SolicitudRecoleccionController::class, 'show']);
Route::post('/SolicitudRecoleccion', [SolicitudRecoleccionController::class, 'store']);
Route::put('/SolicitudRecoleccion/{id}', [SolicitudRecoleccionController::class, 'update']);

//TIPOS RESIDUOS
Route::get('/TiposResiduos', [TipoResiduoController::class, 'index']);

//SUBTIPOS RESIDUOS
Route::get('/SubTipoResiduos/{id}', [SubTipoResiduoController::class, 'index']);

//EMPRESAS RECOLECTORAS
Route::get('/EmpresaRecolectoras', [EmpresaRecolectoraController::class, 'index']);

//RECOLECCIONES
Route::post('/Recoleccion', [RecoleccionController::class, 'store']);
Route::get('/Recoleccion/{id}', [RecoleccionController::class, 'show']);
Route::get('/Recoleccion', [RecoleccionController::class, 'index']);
Route::put('/Recoleccion/{id}', [RecoleccionController::class, 'update']);
Route::get('/empresas/{empId}/recolecciones/hoy', [RecoleccionController::class, 'recoleccionesDelDia']);

//Endpoints de usuario
Route::post('/registro', [UsuarioController::class, 'registrar']);
Route::post('/login', [UsuarioController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UsuarioController::class, 'logout']);
});

Route::get('/usuarios', [UsuarioController::class, 'index']);
