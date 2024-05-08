<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cantidad_existente',
        'lugar_adquirido',
    ];

    
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'lugar_adquirido');
    }
}
