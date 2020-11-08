<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 3; $i++) {
            factory(\App\Models\Ventas\Cliente_empresa::class, 1)->create();
        }
        factory(\App\Models\Ventas\Contacto::class, 10)->create();
        factory(\App\Models\Ventas\Cliente::class, 10)->create();
    }
}
