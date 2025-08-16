<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubtipoResiduo extends Model
{
    protected $table = 'Subtipos_Residuos';
    protected $primaryKey = 'Sub_Res_Id';
    public $timestamps = false;

    protected $fillable = ['Sub_Res_Descripcion', 'Tip_Res_Id'];

    public function tipoResiduo()
    {
        return $this->belongsTo(TipoResiduo::class, 'Tip_Res_Id', 'Tip_Res_Id');
    }

    public function solicitudes()
    {
        return $this->hasMany(SolicitudRecoleccion::class, 'Sub_Res_Id', 'Sub_Res_Id');
    }
}
