<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        $this->call([
            EmpresasSeeder::class,
            UsuariosSeeder::class,
            ModulesSeeder::class,
            ClientesSeeder::class,
            AreasSeeder::class,
            // PedidosSeeder::class,
        ]);
    }
}
