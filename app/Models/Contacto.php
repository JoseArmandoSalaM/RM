<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_completo',
        'correo',
        'numero_telefono',
        'fecha_alianza',
        'rol_compra',
        'empresa_id',
    ];

    // Definir la relación con la tabla de empresas
    public function empresa()
{
    return $this->belongsTo(Empresa::class, 'empresa_id');
}
}
