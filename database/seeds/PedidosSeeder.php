<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            factory(\App\Models\Produccion\Pedido::class, 1)->create(); //de uno en uno hasta el 10
        }
        factory(\App\Models\Produccion\Pedido_proceso::class, 30)->create();
    }
}
