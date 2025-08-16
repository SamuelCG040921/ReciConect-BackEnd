<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Canje extends Model
{
    protected $table = 'Canjes';
    protected $primaryKey = 'Can_Id';
    public $timestamps = false;

    protected $fillable = [
        'Can_Descripcion',
        'Can_Fecha',
        'Can_Puntos_Canjeados',
        'Usu_Id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'Usu_Id', 'Usu_Id');
    }
}
