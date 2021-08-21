<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Produccion\Area;
use \App\Models\Produccion\Proceso;
use \App\Models\Produccion\Tinta;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Area::class, 5)->create();
        factory(Proceso::class, 10)->create();
        factory(Tinta::class, 4)->create();
    }
}
