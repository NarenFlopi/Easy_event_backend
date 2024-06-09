<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombre','foto', 'descripcion',
    ];

    public function producto () {
        return $this->hasMany(Producto::class, 'categoria_id', 'id');   
    }

}
