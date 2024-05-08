<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    use HasFactory;

    protected $fillable = [
        'cotizacion_id',
        'descripcion',
        'cantidad',
        'unidad',
        'costo_unitario',
        'importe',
        'utilidad',
        'financiamiento',
        'riesgo',
        'costo_total',
    ];

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class, 'cotizacion_id');
    }
}
