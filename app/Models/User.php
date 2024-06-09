<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rol_id', 'cedula', 'nombre', 'apellido', 'email', 'fecha_nacimiento', 'telefono', 'estado', 'foto', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sanciones() {
        return $this->hasMany(sanciones::class, 'user_id', 'id');
    }

    public function empresa () {
        return $this->hasOne(Empresa::class, 'user_id', 'id');   
    }


    public function favorito() {
        return $this->hasMany(Favorito::class, 'user_id', 'id');
    }

    public $timestamps= false;

    public function alquiler(){
        return $this->hasmany(Alquiler::class, 'user_id','id');
    }

    public function rol(){
        return $this->belongsTo(Rol::class, 'rol_id','id');
    }
}
