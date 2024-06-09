<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class novedades extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion'
    ];

    public function alquiler() {
        return $this->belongsTo(Alquiler::class, 'alquiler_id', 'id');
    }

    public function alquiler_user() {
        return $this->belongsTo(Alquiler::class, 'user_id', 'user_id');
    }


}
