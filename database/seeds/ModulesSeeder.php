<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modulos')->insert([
            //RESUMEN ADMINISTRATIVO
            [
              'id' => 10,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
              'empresa_id' => 1709636664001,
              'nombre' => 'Resumen administrativo',
              'principal' => 1,
            ],
            [
              'id' => 11,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
              'empresa_id' => 1709636664001,
              'nombre' => 'Producción Interna',
              'principal' => 0,
            ],
            [
              'id' => 12,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
              'empresa_id' => 1709636664001,
              'nombre' => 'Producción Externa',
              'principal' => 0,
            ],
            [
              'id' => 13,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
              'empresa_id' => 1709636664001,
              'nombre' => 'Producción total',
              'principal' => 0,
            ],
            [
              'id' => 14,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
              'empresa_id' => 1709636664001,
              'nombre' => 'Facturación total',
              'principal' => 0,
            ],
            [
              'id' => 15,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
              'empresa_id' => 1709636664001,
              'nombre' => 'Utilidades',
              'principal' => 0,
            ],
            [
              'id' => 16,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
              'empresa_id' => 1709636664001,
              'nombre' => 'Solicitud de Material',
              'principal' => 0,
            ],
            [
              'id' => 17,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
              'empresa_id' => 1709636664001,
              'nombre' => 'Clientes',
              'principal' => 0,
            ],
            [
              'id' => 18,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
              'empresa_id' => 1709636664001,
              'nombre' => 'Material_cliente',
              'principal' => 0,
            ],
            [
              'id' => 19,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
              'empresa_id' => 1709636664001,
              'nombre' => 'Anual',
              'principal' => 0,
            ],
            //ADMINISTRACION
            [
                'id' => 20,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Administracion',
                'principal' => 1,
            ],
            [
                'id' => 21,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Facturacion',
                'principal' => 0,
            ],
            [
                'id' => 22,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Libros admin',
                'principal' => 0,
            ],
            [
                'id' => 23,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Libro usuario',
                'principal' => 0,
            ],
            [
                'id' => 24,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'RRHH',
                'principal' => 0,
            ],
            //PRODUCCION
            [
                'id' => 30,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Produccion',
                'principal' => 1,
            ],
            [
                'id' => 31,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Duplicar pedido',
                'principal' => 0,
            ],
            [
                'id' => 32,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Reporte pedidos',
                'principal' => 0,
            ],
            [
                'id' => 33,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Reporte pagos',
                'principal' => 0,
            ],
            [
                'id' => 34,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Reporte maquinas',
                'principal' => 0,
            ],
            [
                'id' => 35,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Procesos',
                'principal' => 0,
            ],
            [
                'id' => 36,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Materiales',
                'principal' => 0,
            ],
            //CLOUD
            [
                'id' => 40,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Cloud',
                'principal' => 1,
            ],
            //MAIL
            [
                'id' => 45,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Mail',
                'principal' => 1,
            ],
            //VENTAS
            [
                'id' => 50,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Ventas',
                'principal' => 1,
            ],
            [
                'id' => 51,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Actividades',
                'principal' => 0,
            ],
            [
                'id' => 52,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Contactos',
                'principal' => 0,
            ],
            [
                'id' => 53,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Plantillas',
                'principal' => 0,
            ],
            [
                'id' => 54,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Evaluacion',
                'principal' => 0,
            ],
            //TIENDA
            [
                'id' => 60,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Tienda',
                'principal' => 1,
            ],
            //USUARIOS
            [
                'id' => 70,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Usuarios',
                'principal' => 1,
            ],
            [
                'id' => 71,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Perfiles',
                'principal' => 0,
            ],
            [
                'id' => 72,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Asistencia',
                'principal' => 0,
            ],
            [
                'id' => 73,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Reporte de asistencia',
                'principal' => 0,
            ],
            //SISTEMA
            [
                'id' => 80,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Sistema',
                'principal' => 1,
            ],
            [
                'id' => 81,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Facturación',
                'principal' => 0,
            ],
            [
                'id' => 82,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Claves',
                'principal' => 0,
            ],
            [
                'id' => 83,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'empresa_id' => 1709636664001,
                'nombre' => 'Reset producción',
                'principal' => 0,
            ],
        ]);

        DB::table('roles')->insert([
          [
            'id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'rol' => 'Listar',
          ],
          [
            'id' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'rol' => 'Crear',
          ],
          [
            'id' => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'rol' => 'Modificar',
          ],
          [
            'id' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'rol' => 'Eliminar',
          ]
        ]);

        DB::table('modulo_perfil')->insert([
          [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'perfil_id' => 1,
            'modulo_id' => 70,
            'rol_id' => 4,
          ],
          [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'perfil_id' => 1,
            'modulo_id' => 71,
            'rol_id' => 4,
          ]
        ]);
    }
}
