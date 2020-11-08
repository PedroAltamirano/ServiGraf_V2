<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Produccion\Area::class, 5)->create();
        factory(\App\Models\Produccion\Servicio::class, 10)->create();
    }
}
