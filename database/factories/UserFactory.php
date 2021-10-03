<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ventas\Cliente_empresa;
use App\Models\Ventas\Contacto;
use App\Models\Ventas\Cliente;

use App\Models\Produccion\Pedido;
use App\Models\Produccion\Pedido_proceso;
use App\Models\Produccion\Area;
use App\Models\Produccion\Proceso;
use App\Models\Produccion\Tinta;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Cliente_empresa::class, function (Faker $faker) {
    return [
        'nombre' => $faker->company,
        'ruc' => (Cliente_empresa::count() > 0) ? (Cliente_empresa::orderBy('ruc', 'desc')->first()->ruc + 1) : 1010101011,
        'empresa_id' => 1709636664001,
    ];
});

$factory->define(Contacto::class, function (Faker $faker) {
    return [
        'empresa_id' => 1709636664001,
        'usuario_id' => 1010101010,
        'cliente_empresa_id' => $faker->numberBetween(1, 3),
        'actividad' => 'web',
        'titulo' => $faker->title,
        'nombre' => $faker->firstName,
        'apellido' => $faker->lastName,
        'cargo' => $faker->jobTitle,
        'direccion' => $faker->address,
        'sector' => 'cotocollao',
        'telefono' => 7777777,
        'celular' => 999999999,
        'extencion' => 1234,
        'email' => $faker->email,
        'web' => $faker->url,
    ];
});

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'empresa_id' => 1709636664001,
        'usuario_id' => 1010101010,
        'contacto_id' => $faker->unique()->numberBetween($min=1, $max=10),
        'cliente_empresa_id' => $faker->numberBetween(1, 3),
        'tipo_contribuyente' => $faker->numberBetween(1, 2),
        'seguimiento' => $faker->boolean(25),
    ];
});

$factory->define(Area::class, function (Faker $faker) {
    return [
        'empresa_id' => 1709636664001,
        'area' => $faker->regexify('Test area [0-9]{2}'),
        'orden' => $faker->randomDigit,
    ];
});

$factory->define(Proceso::class, function (Faker $faker) {
    return [
        'empresa_id' => 1709636664001,
        'area_id' => $faker->numberBetween(1, 5),
        'proceso' => 'testproceso'.$faker->numberBetween(1, 20),
        'meta' => $faker->numberBetween(0.00, 600.00),
    ];
});

$factory->define(Tinta::class, function (Faker $faker) {
    return [
        'empresa_id' => 1709636664001,
        'color' => 'cmyk',
    ];
});

$factory->define(Pedido::class, function (Faker $faker) {
    return [
        'empresa_id' => 1709636664001,
        'numero' => (Pedido::count() > 0) ? (Pedido::orderBy('numero', 'desc')->first()->numero + 1) : 1,
        'usuario_id' => 1010101010,
        'usuario_mod_id' => 1010101010,
        'cliente_id' => $faker->numberBetween(1, 10),
        'fecha_entrada' => now(),
        'fecha_salida' => now(),
        'prioridad' => $faker->boolean(25), //1-0
        'estado' => $faker->numberBetween(1, 4), //1-4
        'cotizado' => $faker->numberBetween(0, 180.00), //1-4
        'detalle' => 'Ot de prueba',
        'papel' => 'papel',
        'cantidad' => $faker->numberBetween(0, 200),
        'corte_alto' => $faker->numberBetween(0, 30.00),
        'corte_ancho' => $faker->numberBetween(0, 21.00),
        'numerado_inicio' => $faker->numberBetween(0, 100),
        'numerado_fin' => $faker->numberBetween(100, 1000),
        'total_pedido' => $faker->numberBetween(0, 200.00),
        'abono' => $faker->numberBetween(0, 100.00),
        'saldo' => $faker->numberBetween(0, 100.00),
        'notas' => 'Esto es una nota',
    ];
});

$factory->define(Pedido_proceso::class, function (Faker $faker) {
    return [
        'empresa_id' => 1709636664001,
        'pedido_id' => $faker->numberBetween(1, 400),
        'proceso_id' => $faker->numberBetween(1, 10),
        'tiro'=> $faker->numberBetween(1, 5),
        'retiro' => $faker->numberBetween(0, 5),
        'millares' => $faker->numberBetween(1, 10),
        'valor_unitario' => $faker->numberBetween(1.00, 100.00),
        'total' => $faker->numberBetween(5.00, 500.00),
        'status' => $faker->boolean(25),
    ];
});
