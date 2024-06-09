<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlquilerHasProducto extends Model
{
    use HasFactory;

    protected $fillable = [
        'alquiler_id', 'producto_id', 'cantidad_recibida', 'cantidad_devuelta', 'precio'
    ];

    public function alquiler() {
        return $this->belongsTo(Alquiler::class, 'alquiler_id', 'id');
    }

    public function producto() {
        return $this->belongsTo(Producto::class, 'producto_id', 'id');
    }

    public $timestamps= false;

}
