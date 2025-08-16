<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'Usuario';
    protected $primaryKey = 'Usu_Id';
    public $timestamps = false;

    protected $fillable = [
        'Usu_Nombre',
        'Usu_Correo',
        'Usu_Contraseña',
        'Rol_Id',
        'Loc_Id'
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'Rol_Id', 'Rol_Id');
    }

    public function localidad()
    {
        return $this->belongsTo(Localidad::class, 'Loc_Id', 'Loc_Id');
    }

    public function canjes()
    {
        return $this->hasMany(Canje::class, 'Usu_Id', 'Usu_Id');
    }

    public function solicitudes()
    {
        return $this->hasMany(SolicitudRecoleccion::class, 'Usu_Id', 'Usu_Id');
    }

    public function puntos()
    {
        return $this->hasMany(Punto::class, 'Usu_Id', 'Usu_Id');
    }
}
