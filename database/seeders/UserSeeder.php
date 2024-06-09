<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['rol_id'=>1, 'cedula'=>1099735015, 'nombre'=>'Naren', 'apellido'=>'Flórez', 'email'=>'naren@gmail.com', 'fecha_nacimiento'=>'2000-01-01', 'telefono'=>3174395595, 'estado'=>'pendiente', 'password'=>bcrypt('12345')]);
        User::create(['rol_id'=>1, 'cedula'=>1099735016, 'nombre'=>'Jeickssonn', 'apellido'=>'Rojas', 'email'=>'json@gmail.com', 'fecha_nacimiento'=>'2000-01-01', 'telefono'=>317423423,'estado'=>'pendiente', 'password'=>bcrypt('12345')]);
        User::create(['rol_id'=>1, 'cedula'=>1099735017, 'nombre'=>'Jaime', 'apellido'=>'Giraldo', 'email'=>'jaime@gmail.com', 'fecha_nacimiento'=>'2000-01-01', 'telefono'=>3177657324,'estado'=>'pendiente', 'password'=>bcrypt('12345')]);
        
        User::create(['rol_id'=>2, 'cedula'=>1052625534, 'nombre'=>'Empresario', 'apellido'=>'Empresario', 'email'=>'empresario@gmail.com', 'fecha_nacimiento'=>'2000-01-01', 'telefono'=>317545625,'estado'=>'pendiente', 'password'=>bcrypt('12345')]);
        User::create(['rol_id'=>2, 'cedula'=>1052625537, 'nombre'=>'Empresario2', 'apellido'=>'Empresario2', 'email'=>'empresario2@gmail.com', 'fecha_nacimiento'=>'2000-01-01', 'telefono'=>317545628,'estado'=>'pendiente', 'password'=>bcrypt('12345')]);
        User::create(['rol_id'=>3, 'cedula'=>1052625531, 'nombre'=>'Usuario', 'apellido'=>'Usuario', 'email'=>'usuario@gmail.com', 'fecha_nacimiento'=>'2000-01-01', 'telefono'=>317545625,'estado'=>'pendiente', 'password'=>bcrypt('12345')]);
    }
}
