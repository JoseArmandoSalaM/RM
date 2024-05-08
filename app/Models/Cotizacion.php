<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'empre_id',
        'service_id',
        'costo_total',
        'notas',
        'fecha_estimada_termino',
    ];
    public function work()
    {
        return $this->belongsTo(Work::class, 'user_id');
    }

    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class, 'cotizacion_id', 'id');
    }

    public function empre()
    {
        return $this->belongsTo(Empresa::class, 'empre_id');
    }
    public function service()
    {
        return $this->belongsTo(Servicio::class, 'service_id');
    }
}
