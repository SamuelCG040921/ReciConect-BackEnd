<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'Localidades';
    protected $primaryKey = 'Loc_Id';
    public $timestamps = false;

    protected $fillable = ['Loc_Nombre'];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'Loc_Id', 'Loc_Id');
    }

    public function diasRecoleccion()
    {
        return $this->hasMany(DiaRecoleccion::class, 'Loc_Id', 'Loc_Id');
    }
}
