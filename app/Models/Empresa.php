<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
            'dueño',
            'nombre_empresa',
            'numero_telefono',
            'estado',
            'sector',
            'correo_electronico',
            'sitio_web',
            'fecha_inicio_asociacion',
            'notas',
    ];
}
