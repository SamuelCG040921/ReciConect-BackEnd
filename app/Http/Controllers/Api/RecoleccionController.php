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
        $recolecciones = Recoleccion::with([
            'empresa:Emp_Id,Emp_Nombre',
            'solicitud.usuario:Usu_Id,Usu_Nombre',
            'solicitud.subtipoResiduo:Sub_Res_Id,Sub_Res_Descripcion,Tip_Res_Id',
            'solicitud.subtipoResiduo.tipoResiduo:Tip_Res_Id,Tip_Res_Descripcion'
        ])->get(['Rec_Id', 'Rec_Fecha', 'Rec_Peso', 'Rec_Turno', 'Emp_Id', 'Sol_Rec_Id']);

        $resultado = $recolecciones->map(function ($rec) {
            return [
                'Rec_Id' => $rec->Rec_Id,
                'Rec_Fecha' => $rec->Rec_Fecha,
                'Rec_Peso' => $rec->Rec_Peso,
                'Rec_Turno' => $rec->Rec_Turno,
                'Emp_Nombre' => $rec->empresa->Emp_Nombre,
                'Usu_Nombre' => $rec->solicitud->usuario->Usu_Nombre,
                'Sub_Res_Descripcion' => $rec->solicitud->subtipoResiduo->Sub_Res_Descripcion,
                'Tip_Res_Descripcion' => $rec->solicitud->subtipoResiduo->tipoResiduo->Tip_Res_Descripcion,
            ];
        });

        return response()->json($resultado, 200);
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

    public function show($id)
    {

         $recolecciones = Recoleccion::with([
            'empresa:Emp_Id,Emp_Nombre',
            'solicitud.usuario:Usu_Id,Usu_Nombre',
            'solicitud.subtipoResiduo:Sub_Res_Id,Sub_Res_Descripcion,Tip_Res_Id',
            'solicitud.subtipoResiduo.tipoResiduo:Tip_Res_Id,Tip_Res_Descripcion'
        ])->where('Rec_Id', $id)->get(['Rec_Id', 'Rec_Fecha', 'Rec_Peso', 'Rec_Turno', 'Emp_Id', 'Sol_Rec_Id']);

        $resultado = $recolecciones->map(function ($rec) {
            return [
                'Rec_Id' => $rec->Rec_Id,
                'Rec_Fecha' => $rec->Rec_Fecha,
                'Rec_Peso' => $rec->Rec_Peso,
                'Rec_Turno' => $rec->Rec_Turno,
                'Emp_Nombre' => $rec->empresa->Emp_Nombre,
                'Usu_Nombre' => $rec->solicitud->usuario->Usu_Nombre,
                'Sub_Res_Descripcion' => $rec->solicitud->subtipoResiduo->Sub_Res_Descripcion,
                'Tip_Res_Descripcion' => $rec->solicitud->subtipoResiduo->tipoResiduo->Tip_Res_Descripcion,
            ];
        });

        if ($resultado->isEmpty()) {
            return response()->json(['error' => 'Recoleccion no encontrada'], 404);
        }

        return response()->json($resultado, 200);

    }

    public function update(Request $request, $id)
    {
        // Validación
        $validator = Validator::make($request->all(), [
            'Rec_Fecha'  => 'required|date',
            'Rec_Peso'   => 'required|numeric|regex:/^\d+(\.\d+)?$/',
            'Rec_Turno'  => 'required|integer',
            'Emp_Id'     => 'required|integer|exists:Empresas_Recolectoras,Emp_Id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Buscar la recolección por ID
        $recoleccion = Recoleccion::find($id);
        if (!$recoleccion) {
            return response()->json([
                'status'  => false,
                'message' => 'Recolección no encontrada'
            ], 404);
        }

        // Actualizar campos permitidos
        $recoleccion->update($request->only([
            'Rec_Fecha',
            'Rec_Peso',
            'Rec_Turno',
            'Emp_Id'
        ]));

        return response()->json([
            'status'  => true,
            'message' => 'Recolección actualizada correctamente'
        ]);
    }
}
