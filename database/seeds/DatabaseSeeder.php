<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        App\Empresas::table('datos_empresas')->insert([
            'id' => 'SVGF',
            'creacion' => date('Y-m-d H:i:s'),
            'modificacion' => date('Y-m-d H:i:s'),
            'nombre' => 'ServiGraf',
            'estado' => 1,
        ]);
        
        DB::table('perfiles')->insert([
            'id' => 1,
            'creacion' => date('Y-m-d H:i:s'),
            'modificacion' => date('Y-m-d H:i:s'),
            'empresa_id' => 'SVGF',
            'perfil' => 'Root',
            'descripcion' => 'perfil de desarrollo',
        ]);
        
        DB::table('horarios')->insert([
            'id' => 1,
            'creacion' => date('Y-m-d H:i:s'),
            'empresa_id' => 'SVGF',
            'nombre' => 'matutino',
            'llegada_ma' => '09:00',
            'salida_ma' => '13:00',
            'llegada_ta' => '14:00',
            'salida_ta' => '18:00',
            'espera' => 30,
            'gracia' => 5,
        ]);
        
        DB::table('usuarios')->insert([
            'creacion' => date('Y-m-d H:i:s'),
            'modificacion' => date('Y-m-d H:i:s'),
            'cedula' => 1010101010,
            'nombre' => 'Root',
            'apellido' => 'Developer',
            'correo' => 'mail@server.com',
            'telefono' => 02123456,
            'empresa_id' => 'SVGF',
            'usuario' => 'Root',
            'password' => Hash::make('123456'),
            'perfil_id' => 1,
            'activo' => 1,
            'horario_id' => 1,
            'reservarot' => 1,
            'libro' => 1,
        ]);
        
        DB::table('modulos')->insert([
            [
                'id' => 10,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Resumen administrativo',
                'principal' => 1,
            ],
            [
                'id' => 11,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Interna',
                'principal' => 0,
            ],
            [
                'id' => 12,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Externa',
                'principal' => 0,
            ],
            [
                'id' => 13,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Material',
                'principal' => 0,
            ],
            [
                'id' => 14,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Produccion total',
                'principal' => 0,
            ],
            [
                'id' => 15,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Facturacion total',
                'principal' => 0,
            ],
            [
                'id' => 16,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Clientes',
                'principal' => 0,
            ],
            [
                'id' => 17,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Material_cliente',
                'principal' => 0,
            ],
            [
                'id' => 18,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Anual',
                'principal' => 0,
            ],
            [
                'id' => 20,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Usuarios',
                'principal' => 1,
            ],
            [
                'id' => 21,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Asistencia',
                'principal' => 0,
            ],
            [
                'id' => 22,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Reporte de asistencia',
                'principal' => 0,
            ],
            [
                'id' => 30,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Administracion',
                'principal' => 1,
            ],
            [
                'id' => 31,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Facturacion',
                'principal' => 0,
            ],
            [
                'id' => 32,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Libros usuario',
                'principal' => 0,
            ],
            [
                'id' => 33,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Libro admin',
                'principal' => 0,
            ],
            [
                'id' => 34,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'RRHH',
                'principal' => 0,
            ],
            [
                'id' => 40,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Produccion',
                'principal' => 1,
            ],
            [
                'id' => 41,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Duplicar ot',
                'principal' => 0,
            ],
            [
                'id' => 42,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Reporte ot',
                'principal' => 0,
            ],
            [
                'id' => 43,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Reporte pagos',
                'principal' => 0,
            ],
            [
                'id' => 44,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Reporte maquinas',
                'principal' => 0,
            ],
            [
                'id' => 45,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Procesos',
                'principal' => 0,
            ],
            [
                'id' => 46,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Materiales',
                'principal' => 0,
            ],
            [
                'id' => 50,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Ventas',
                'principal' => 1,
            ],
            [
                'id' => 51,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Actividades',
                'principal' => 0,
            ],
            [
                'id' => 52,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Contactos',
                'principal' => 0,
            ],
            [
                'id' => 53,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Plantillas',
                'principal' => 0,
            ],
            [
                'id' => 54,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Evaluacion',
                'principal' => 0,
            ],
            [
                'id' => 60,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Sistema',
                'principal' => 0,
            ],
            [
                'id' => 61,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Empresa',
                'principal' => 0,
            ],
            [
                'id' => 62,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Reset porduccion',
                'principal' => 0,
            ],
            [
                'id' => 63,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Cloud',
                'principal' => 0,
            ],
            [
                'id' => 64,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Mail',
                'principal' => 0,
            ],
            [
                'id' => 65,
                'creacion' => date('Y-m-d H:i:s'),
                'empresa_id' => 'SVGF',
                'nombre' => 'Tienda',
                'principal' => 0,
            ]
        ]);
        
        DB::table('roles')->insert([
            [
                'id' => 1,
                'creacion' => date('Y-m-d H:i:s'),
                'rol' => 'Listar',
            ],
            [
                'id' => 2,
                'creacion' => date('Y-m-d H:i:s'),
                'rol' => 'Crear',
            ],
            [
                'id' => 3,
                'creacion' => date('Y-m-d H:i:s'),
                'rol' => 'Modificar',
            ],
            [
                'id' => 4,
                'creacion' => date('Y-m-d H:i:s'),
                'rol' => 'Eliminar',
            ]
        ]);
        
        DB::table('modulo_perfil')->insert([
            [
                'creacion' => date('Y-m-d H:i:s'),
                'perfil_id' => 1,
                'modulo_id' => 20,
                'rol_id' => 1,
            ],
            [
                'creacion' => date('Y-m-d H:i:s'),
                'perfil_id' => 1,
                'modulo_id' => 20,
                'rol_id' => 2,
            ],
            [
                'creacion' => date('Y-m-d H:i:s'),
                'perfil_id' => 1,
                'modulo_id' => 20,
                'rol_id' => 3,
            ],
            [
                'creacion' => date('Y-m-d H:i:s'),
                'perfil_id' => 1,
                'modulo_id' => 20,
                'rol_id' => 4,
            ],
        ]);
    }
}