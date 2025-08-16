<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoResiduo extends Model
{
    protected $table = 'Tipos_Residuos';
    protected $primaryKey = 'Tip_Res_Id';
    public $timestamps = false;

    protected $fillable = ['Tip_Res_Descripcion'];

    public function subtipos()
    {
        return $this->hasMany(SubtipoResiduo::class, 'Tip_Res_Id', 'Tip_Res_Id');
    }

    public function diasRecoleccion()
    {
        return $this->hasMany(DiaRecoleccion::class, 'Res_Id', 'Tip_Res_Id');
    }

    public function solicitudes()
    {
        return $this->hasMany(SolicitudRecoleccion::class, 'Tip_Res_Id', 'Tip_Res_Id');
    }
}
