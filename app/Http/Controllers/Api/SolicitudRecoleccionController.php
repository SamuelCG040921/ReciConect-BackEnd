<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\SolicitudRecoleccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SolicitudRecoleccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solicitudes = SolicitudRecoleccion::with([
            'usuario:Usu_Id,Usu_Nombre',
            'subtipoResiduo:Sub_Res_Id,Sub_Res_Descripcion'
        ])->get(['Sol_Rec_Id', 'Sol_Rec_Tipo', 'Sol_Rec_Fecha', 'Sol_Rec_Estado', 'Usu_Id', 'Sub_Res_Id']);

        $resultado = $solicitudes->map(function ($sol) {
            return [
                'Sol_Rec_Id' => $sol->Sol_Rec_Id,
                'Sol_Rec_Tipo' => $sol->Sol_Rec_Tipo,
                'Sol_Rec_Fecha' => $sol->Sol_Rec_Fecha,
                'Sol_Rec_Estado' => $sol->Sol_Rec_Estado,
                'Usu_Nombre' => $sol->usuario->Usu_Nombre,
                'Sub_Res_Descripcion' => $sol->subtipoResiduo->Sub_Res_Descripcion,
            ];
        });

        return response()->json($resultado, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validación
        $validator = Validator::make($request->all(), [
            'Sol_Rec_Tipo'   => 'required|string|in:Programada,Por demanda',
            'Sol_Rec_Fecha'  => 'required|date',
            'Sol_Rec_Estado' => 'required|string|in:Pendiente,Completada,Cancelada',
            'Usu_Id'         => 'required|integer|exists:Usuario,Usu_Id',
            'Sub_Res_Id'     => 'required|integer|exists:subtipos_residuos,Sub_Res_Id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Solicitud de recoleccion creada correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $solicitudes = SolicitudRecoleccion::with([
            'usuario:Usu_Id,Usu_Nombre',
            'subtipoResiduo:Sub_Res_Id,Sub_Res_Descripcion'
        ])->where('Sol_Rec_Id', $id)->get(['Sol_Rec_Id', 'Sol_Rec_Tipo', 'Sol_Rec_Fecha', 'Sol_Rec_Estado', 'Usu_Id', 'Sub_Res_Id']);

        $resultado = $solicitudes->map(function ($sol) {
            return [
                'Sol_Rec_Id' => $sol->Sol_Rec_Id,
                'Sol_Rec_Tipo' => $sol->Sol_Rec_Tipo,
                'Sol_Rec_Fecha' => $sol->Sol_Rec_Fecha,
                'Sol_Rec_Estado' => $sol->Sol_Rec_Estado,
                'Usu_Nombre' => $sol->usuario->Usu_Nombre,
                'Sub_Res_Descripcion' => $sol->subtipoResiduo->Sub_Res_Descripcion,
            ];
        });

        if ($resultado->isEmpty()) {
            return response()->json(['error' => 'Solicitud no encontrada'], 404);
        }

        return response()->json($resultado);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SolicitudRecoleccion $solicitudRecoleccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SolicitudRecoleccion $solicitudRecoleccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SolicitudRecoleccion $solicitudRecoleccion)
    {
        //
    }
}
