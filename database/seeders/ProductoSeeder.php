<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;


class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $frases = [
            'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium',
            'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
            'Et harum quidem rerum facilis est et expedita distinctio',
            'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium',
            'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
            'Minus aut quo dolorum delectus vitae labore harum fugit. Est reiciendis iste corrupti quis id unde facilis vero. In at quasi libero sit hic debitis.',
        ];
        
        for ($i = 1; $i <= 25; $i++) {
            Producto::create([
                'codigo' => $i,
                'precio' => rand(10000, 1000000),
                'nombre_producto' => 'Producto Empresa 1-' . $i,
                'descripcion' => $frases[array_rand($frases)],
                'cantidad_disponible' => 50,
                'cantidad_inventario' => 50,
                'empresa_id' => 1,
                'categoria_id' => rand(1, 10), // Asigna una categoría aleatoria del 1 al 10
            ]);
        }

        for ($i = 26; $i <= 50; $i++) {
            Producto::create([
                'codigo' => $i,
                'precio' => rand(10000, 1000000),
                'nombre_producto' => 'Producto Empresa 2-' . $i,
                'descripcion' => $frases[array_rand($frases)],
                'cantidad_disponible' => 50,
                'cantidad_inventario' => 50,
                'empresa_id' => 2,
                'categoria_id' => rand(1, 10), // Asigna una categoría aleatoria del 1 al 10
            ]);
        }

    }
}
