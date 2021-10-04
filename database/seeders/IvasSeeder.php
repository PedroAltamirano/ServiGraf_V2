<?php

namespace Database\Seeders;

use App\Models\Administracion\Iva;
use App\Models\Administracion\Retencion;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class IvasSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $ivas = [
      [
        'empresa_id' => 1709636664001,
        'porcentaje' => 0,
        'status' => 1
      ],
      [
        'empresa_id' => 1709636664001,
        'porcentaje' => 12,
        'status' => 1
      ],
    ];

    foreach ($ivas as $iva) {
      Iva::create($iva);
    }

    $retenciones = [
      // Iva
      [
        'empresa_id' => 1709636664001,
        'tipo' => 1,
        'porcentaje' => 0,
        'descripcion' => 'default',
        'status' => 1
      ],
      [
        'empresa_id' => 1709636664001,
        'tipo' => 1,
        'porcentaje' => 30,
        'descripcion' => 'default',
        'status' => 1
      ],
      [
        'empresa_id' => 1709636664001,
        'tipo' => 1,
        'porcentaje' => 70,
        'descripcion' => 'default',
        'status' => 1
      ],
      [
        'empresa_id' => 1709636664001,
        'tipo' => 1,
        'porcentaje' => 100,
        'descripcion' => 'default',
        'status' => 1
      ],
      // Fuente
      [
        'empresa_id' => 1709636664001,
        'tipo' => 0,
        'porcentaje' => 0,
        'descripcion' => 'default',
        'status' => 1
      ],
      [
        'empresa_id' => 1709636664001,
        'tipo' => 0,
        'porcentaje' => 1.75,
        'descripcion' => 'default',
        'status' => 1
      ],
      [
        'empresa_id' => 1709636664001,
        'tipo' => 0,
        'porcentaje' => 2.75,
        'descripcion' => 'default',
        'status' => 1
      ],
    ];

    foreach ($retenciones as $retencion) {
      Retencion::create($retencion);
    }
  }
}
