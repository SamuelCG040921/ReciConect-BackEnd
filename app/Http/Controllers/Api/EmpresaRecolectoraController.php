<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmpresaRecolectora;
use Illuminate\Http\Request;

class EmpresaRecolectoraController extends Controller
{
    public function index()
    {
       return EmpresaRecolectora::select('Emp_Id', 'Emp_Nombre')->get();
    }
}
