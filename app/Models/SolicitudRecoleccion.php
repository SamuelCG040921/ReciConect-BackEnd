<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudRecoleccion extends Model
{

    protected $table = 'Solicitud_Recoleccion';

    protected $primaryKey = 'Sol_Rec_Id'; 

    public $timestamps = false;

    protected $fillable = [
        'Sol_Rec_Tipo',
        'Sol_Rec_Fecha',
        'Sol_Rec_Estado', 
        'Usu_Id',
        'Tip_Res_Id',
        'Sub_Res_Id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'Usu_Id', 'Usu_Id');
    }

    public function tipoResiduo()
    {
        return $this->belongsTo(TipoResiduo::class, 'Tip_Res_Id', 'Tip_Res_Id');
    }

    public function subtipoResiduo()
    {
        return $this->belongsTo(SubtipoResiduo::class, 'Sub_Res_Id', 'Sub_Res_Id');
    }

    public function recolecciones()
    {
        return $this->hasMany(Recoleccion::class, 'Sol_Rec_Id', 'Sol_Rec_Id');
    }
}
