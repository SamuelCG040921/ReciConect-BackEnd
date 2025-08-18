<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Registro de usuario
     */
    public function registrar(Request $request)
    {
        // Validación
        $validator = Validator::make($request->all(), [
            'Usu_Nombre'     => 'required|string|max:100',
            'Usu_Correo'     => 'required|email|unique:Usuario,Usu_Correo',
            'Usu_Contraseña' => 'required|string',
            'Rol_Id'         => 'required|integer|exists:Rol,Rol_Id',
            'Loc_Id'         => 'nullable|integer|exists:Localidades,Loc_Id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Crear usuario
        $usuario = Usuario::create([
            'Usu_Nombre'     => $request->Usu_Nombre,
            'Usu_Correo'     => $request->Usu_Correo,
            'Usu_Contraseña' => Hash::make($request->Usu_Contraseña),
            'Rol_Id'         => $request->Rol_Id,
            'Loc_Id'         => $request->Loc_Id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Usuario registrado exitosamente',
            'usuario' => $usuario
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Usu_Correo'     => 'required|email',
            'Usu_Contraseña' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Buscar usuario por correo
        $usuario = Usuario::where('Usu_Correo', $request->Usu_Correo)->first();

        if (!$usuario || !Hash::check($request->Usu_Contraseña, $usuario->Usu_Contraseña)) {
            return response()->json([
                'status'  => false,
                'message' => 'Credenciales inválidas'
            ], 401);
        }

        // Crear token de acceso con Sanctum
        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login exitoso',
            'usuario' => $usuario,
            'token'   => $token
        ]);
    }

    /**
     * Logout de usuario
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Sesión cerrada correctamente'
        ]);
    }

    public function index()
    {
        // Obtenemos todos los usuarios con sus roles y localidades (si tienes las relaciones definidas en el modelo)
        $usuarios = Usuario::with(['rol', 'localidad'])->get();

        return response()->json([
            'status' => true,
            'usuarios' => $usuarios
        ]);
    }
}
