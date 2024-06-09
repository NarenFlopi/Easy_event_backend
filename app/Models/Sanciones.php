<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanciones extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['motivo_reporte', 'estado', 'motivo_sancion', 'duracion', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
