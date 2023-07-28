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
    $n = 1;
    for ($year = 2020; $year <= 2023; $year++) {
      for ($month = 1; $month <= 12; $month++) {
        if ($year > 2022 && $month > 8) break;
        for ($i = 1; $i <= 28; $i++) {
          $date = $year . '-' . $month . '-' . $i;

          $pedidos = [
            'numero' => $n,
            'fecha_entrada' => $date,
            'fecha_salida' => $date,
            'created_at' => $date,
            'updated_at' => $date,
          ];

          $procesos = [
            'pedido_id' => $n,
            'created_at' => $date,
            'updated_at' => $date,
          ];

          if ($year > 2022 && $month > 7) {
            $pedidos['estado'] = 1;
            $procesos['status'] = 0;
          };

          factory(\App\Models\Produccion\Pedido::class, 1)->create($pedidos);
          factory(\App\Models\Produccion\Pedido_proceso::class, 6)->create($procesos);
          $n += 1;
        }
      }
    }
  }
}
