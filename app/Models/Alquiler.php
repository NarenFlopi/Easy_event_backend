<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'metodo_pago', 'lugar_entrega', 'fecha_alquiler', 'fecha_devolucion', 'estado',
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function alquilerHasProductos() {
        return $this->hasMany(AlquilerHasProducto::class, 'alquiler_id', 'id');

    }

    public $timestamps= false;

}

