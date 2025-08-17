<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recoleccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecoleccionController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {

        // Validación
        $validator = Validator::make($request->all(), [
            'Rec_Fecha'  => 'required|date',
            'Rec_Peso'   => 'required|numeric|regex:/^\d+(\.\d+)?$/',
            'Rec_Turno'   => 'required|integer',
            'Sol_Rec_Id' => 'required|integer|exists:Solicitud_Recoleccion,Sol_Rec_Id',
            'Emp_Id'     => 'required|integer|exists:Empresas_Recolectoras,Emp_Id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Recoleccion creada correctamente'
        ]);
    }

}
