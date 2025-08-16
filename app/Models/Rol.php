<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'Rol';
    protected $primaryKey = 'Rol_Id';
    public $timestamps = false;

    protected $fillable = ['Rol_Nombre'];

    // Relaciones
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'Rol_Id', 'Rol_Id');
    }
}
