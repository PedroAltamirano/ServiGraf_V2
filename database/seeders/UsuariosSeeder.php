<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //horario
        $horario = new \App\Models\Sistema\Horario;
        $horario->id = 1;
        $horario->empresa_id = 1709636664001;
        $horario->nombre = 'Matutino';
        $horario->llegada_ma = '09:00';
        $horario->salida_ma = '13:00';
        $horario->llegada_ta = '14:00';
        $horario->salida_ta = '18:00';
        $horario->save();

        //nomina
        $nomina = new \App\Models\Sistema\Nomina;
        $nomina->empresa_id = 1709636664001;
        $nomina->cedula = 1010101010;
        $nomina->fecha_nacimiento = '2020-01-01';
        $nomina->lugar_nacimiento = 'Quito';
        $nomina->nacionalidad = 'ecuatoriano';
        $nomina->idioma_nativo = 'Espanol';
        $nomina->nombre = 'RootNomina';
        $nomina->apellido = 'ApellNomina';
        $nomina->direccion = 'La calle y la que crusa';
        $nomina->sector = 'Barrio';
        $nomina->telefono = 7777777;
        $nomina->celular = 999999999;
        $nomina->correo = 'root@nomina.com';
        $nomina->tipo_sangre = 1;
        $nomina->genero = 1;
        $nomina->estado_civil = 1;
        $nomina->inicio_labor = '2020-01-01';
        $nomina->cargo = 'Administrador';
        $nomina->centro_costos = 1;
        $nomina->iess_asumido_empleador = 1;
        $nomina->sueldo = 2000.00;
        $nomina->banco_id = 0;
        $nomina->tipo_cuenta_banco = 0;
        $nomina->numero_cuenta_bancaria = 123456789;
        $nomina->horario_id = 1;
        $nomina->save();

        //perfil
        $perfil = new \App\Models\Usuarios\Perfil;
        $perfil->id = 1;
        $perfil->empresa_id = 1709636664001;
        $perfil->perfil = 'RootPerf';
        $perfil->descripcion = 'Perfil de desarrollo';
        $perfil->save();

        //usuario
        $usuario = new \App\Models\Usuarios\Usuario;
        $usuario->cedula = 1010101010;
        $usuario->empresa_id = 1709636664001;
        $usuario->usuario = 'RootUser';
        $usuario->password = Hash::make('123456');
        $usuario->perfil_id = 1;
        $usuario->save();
    }
}
