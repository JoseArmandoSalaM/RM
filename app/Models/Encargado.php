<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'herramienta_id',
        'fecha_entrega',
        'entregado',
        'fecha_devolucion',
        'cantidad_prestada',
        
    ];

    public function work()
    {
        return $this->belongsTo(Work::class, 'user_id');
    }
    public function herramienta()
    {
        return $this->belongsTo(Herramienta::class, 'herramienta_id');
    }
}
