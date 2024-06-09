<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create(['id'=>1, 'nombre'=>'Sillas', 'foto'=>'my_files/categorias/sillas.png']);
        Categoria::create(['id'=>2, 'nombre'=>'Mesas', 'foto'=>'my_files/categorias/mesas.png']);
        Categoria::create(['id'=>3, 'nombre'=>'Luces', 'foto'=>'my_files/categorias/luces.png']);
        Categoria::create(['id'=>4, 'nombre'=>'Sonido', 'foto'=>'my_files/categorias/sonido.png']);
        Categoria::create(['id'=>5, 'nombre'=>'Mantel', 'foto'=>'my_files/categorias/manteles.png']);
        Categoria::create(['id'=>6, 'nombre'=>'Tarima', 'foto'=>'my_files/categorias/tarima.png']);
        Categoria::create(['id'=>7, 'nombre'=>'Alfombra', 'foto'=>'my_files/categorias/alfombra.png']);
        Categoria::create(['id'=>8, 'nombre'=>'Bases', 'foto'=>'my_files/categorias/bases.png']);
        Categoria::create(['id'=>9, 'nombre'=>'CandyBar', 'foto'=>'my_files/categorias/bar.png']);
        Categoria::create(['id'=>10, 'nombre'=>'Menaje', 'foto'=>'my_files/categorias/menaje.png']);
        

    }
}
