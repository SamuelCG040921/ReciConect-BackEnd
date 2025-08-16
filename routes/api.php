<?php

use App\Http\Controllers\SolicitudRecoleccionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//index
Route::get('/SolicitudRecoleccion', [SolicitudRecoleccionController::class, 'index']);
Route::post('/SolicitudRecoleccion', [SolicitudRecoleccionController::class, 'store']);

