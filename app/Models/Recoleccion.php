<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recoleccion extends Model
{
    protected $table = 'Recolecciones';
    protected $primaryKey = 'Rec_Id';
    public $timestamps = false;

    protected $fillable = [
        'Rec_Fecha',
        'Rec_Peso',
        'Rec_Turno',
        'Sol_Rec_Id',
        'Emp_Id'
    ];

    public function solicitud()
    {
        return $this->belongsTo(SolicitudRecoleccion::class, 'Sol_Rec_Id', 'Sol_Rec_Id');
    }

    public function empresa()
    {
        return $this->belongsTo(EmpresaRecolectora::class, 'Emp_Id', 'Emp_Id');
    }

    public function puntos()
    {
        return $this->hasMany(Punto::class, 'Rec_Id', 'Rec_Id');
    }
}
