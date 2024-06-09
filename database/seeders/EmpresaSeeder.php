<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create(['id'=>1, 'nit_empresa'=>'111222333', 'direccion_empresa'=>'Floridablanca', 'nombre_empresa'=>'ADSO', 'telefono_empresa'=>'	3173495595', 'email_empresa'=>'adso00@gmail.com', 'estado'=>'pendiente','user_id'=>4]);

        Empresa::create(['id'=>2, 'nit_empresa'=>'222333444', 'direccion_empresa'=>'Bucaramanga', 'nombre_empresa'=>'Ejemplo2', 'telefono_empresa'=>'5555555555', 'email_empresa'=>'ejemplo2@gmail.com','estado'=>'pendiente', 'user_id'=>5]);
        

    }
}
