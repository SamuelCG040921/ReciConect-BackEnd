<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaRecolectora extends Model
{
    protected $table = 'Empresas_Recolectoras';
    protected $primaryKey = 'Emp_Id';
    public $timestamps = false;

    protected $fillable = [
        'Emp_Nombre',
        'Emp_Telefono',
        'Emp_Correo',
        'Emp_Direccion'
    ];

    public function recolecciones()
    {
        return $this->hasMany(Recoleccion::class, 'Emp_Id', 'Emp_Id');
    }
}
