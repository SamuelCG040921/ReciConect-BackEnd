<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiaRecoleccion extends Model
{
    protected $table = 'Dias_Recoleccion';
    protected $primaryKey = 'Di_Rec_Id';
    public $timestamps = false;

    protected $fillable = ['Di_Rec_Semana', 'Loc_Id', 'Res_Id'];

    public function localidad()
    {
        return $this->belongsTo(Localidad::class, 'Loc_Id', 'Loc_Id');
    }

    public function tipoResiduo()
    {
        return $this->belongsTo(TipoResiduo::class, 'Res_Id', 'Tip_Res_Id');
    }
}
