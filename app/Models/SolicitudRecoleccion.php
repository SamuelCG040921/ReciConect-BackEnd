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
}
