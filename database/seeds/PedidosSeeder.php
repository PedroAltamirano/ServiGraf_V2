<?php

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
        factory(App\Models\Ventas\Cliente_empresa::class, 3)->create();
        factory(App\Models\Ventas\Contacto::class, 10)->create();
        factory(App\Models\Ventas\Cliente::class, 10)->create();

        factory(App\Models\Produccion\Area::class, 5)->create();
        factory(App\Models\Produccion\Servicio::class, 10)->create();

        factory(App\Models\Produccion\Pedido::class, 1)->create(); //de uno en uno hasta el 9
        factory(App\Models\Produccion\Pedido_servicio::class, 30)->create();
    }
}
