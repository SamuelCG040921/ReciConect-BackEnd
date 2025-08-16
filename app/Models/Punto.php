<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Punto extends Model
{
    protected $table = 'Puntos';
    protected $primaryKey = 'Pun_Id';
    public $timestamps = false;

    protected $fillable = [
        'Pun_Cantidad_Puntos',
        'Pun_Formula',
        'Pun_Fecha',
        'Usu_Id',
        'Rec_Id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'Usu_Id', 'Usu_Id');
    }

    public function recoleccion()
    {
        return $this->belongsTo(Recoleccion::class, 'Rec_Id', 'Rec_Id');
    }
}
