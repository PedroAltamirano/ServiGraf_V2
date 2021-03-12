@extends('layouts.app')

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Nominas',
      'current' => false,
      'href' => route('nomina'),
    ],
    [
      'text' => $text,
      'current' => true,
      'href' => '#',
    ]
  ]"
>
</x-path>

<x-blueBoard
  :title=$text
  :foot="[
    ['text'=>$action, 'href'=>'#', 'id'=>'formSubmit', 'tipo'=> 'link']
  ]"
>
  <form action="{{ $path }}" method="POST" id="form" enctype="multipart/form-data">
    @csrf
    @method($method)
    <section id="datos-personales">
      <h6>Datos Personales</h6>
      <hr>
      <div class="row">
        <div class="form-group col-12 col-md-2">
          <label for="foto">Foto</label>
          <input type="file" class="form-control-file dropify" name="foto" id="foto" />
        </div>
        <div class="form-row col-12 col-md-10">
          <div class="form-group col-6 col-md-2">
            <label for="cedula">Cédula</label>
            <input type="text" id="cedula" name="cedula" class="form-control form-control-sm @error('cedula') is-invalid @enderror" value="{{ old('cedula', $nomina->cedula) }}">
          </div>
          <div class="form-group col-6 col-md-2">
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control form-control-sm @error('fecha_nancimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento', $nomina->fecha_nacimiento) ?? date('Y-m-d') }}">
          </div>
          <div class="form-group col-12 col-md-5">
            <label for="lugar_nacimiento">Lugar de nacimiento</label>
            <input type="text" id="lugar_nacimiento" name="lugar_nacimiento" class="form-control form-control-sm @error('lugar_nacimiento') is-invalid @enderror" value="{{ old('lugar_nacimiento', $nomina->lugar_nacimiento) }}">
          </div>
          <div class="form-group col-12 col-md-5">
            <label for="nacionalidad">Nacionalidad</label>
            <input type="text" id="nacionalidad" name="nacionalidad" class="form-control form-control-sm @error('nacionalidad') is-invalid @enderror" value="{{ old('nacionalidad', $nomina->nacionalidad) }}">
          </div>
          <div class="form-group col-12 col-md-5">
            <label for="idioma_nativo">Idioma nativo</label>
            <input type="text" id="idioma_nativo" name="idioma_nativo" class="form-control form-control-sm @error('idioma_nativo') is-invalid @enderror" value="{{ old('idioma_nativo', $nomina->idioma_nativo) }}">
          </div>
          <div class="form-group col-12 col-md-5">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control form-control-sm @error('nombre') is-invalid @enderror" value="{{ old('nombre', $nomina->nombre) }}">
          </div>
          <div class="form-group col-12 col-md-5">
            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="apellido" class="form-control form-control-sm @error('apellido') is-invalid @enderror" value="{{ old('apellido', $nomina->apellido) }}">
          </div>
          <div class="form-group col-12 col-md-5">
            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" class="form-control form-control-sm @error('direccion') is-invalid @enderror" value="{{ old('direccion', $nomina->direccion) }}">
          </div>
          <div class="form-group col-12 col-md-5">
            <label for="sector">sector</label>
            <input type="text" id="sector" name="sector" class="form-control form-control-sm @error('sector') is-invalid @enderror" value="{{ old('sector', $nomina->sector) }}">
          </div>
        </div>
        <div class="form-row col-12">
          <div class="form-group col-3 col-md-2">
            <label for="statusDiv">Visita Domiciliaria</label>
            <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
              <input type="checkbox" class="custom-control-input @error('visita_domiciliaria') is-invalid @enderror" id="visita_domiciliaria" name="visita_domiciliaria" {{ old('visita_domiciliaria', $nomina->visita_domiciliaria) == '1' ? 'checked':'' }} value='1'>
              <label class="custom-control-label" for="visita_domiciliaria"></label>
            </div>
          </div>
          <div class="form-group col-6 col-md-2">
            <label for="fecha_visita">fecha_visita</label>
            <input type="date" name="fecha_visita" id="fecha_visita" class="form-control form-control-sm @error('fecha_visita') is-invalid @enderror" value="{{ old('fecha_visita', $nomina->fecha_visita) }}">
          </div>
          <div class="form-group col-12 col-md-5">
            <label for="telefono">Teléfono</label>
            <input type="number" id="telefono" name="telefono" class="form-control form-control-sm @error('telefono') is-invalid @enderror" value="{{ old('telefono', $nomina->telefono) }}">
          </div>
          <div class="form-group col-12 col-md-5">
            <label for="celular">Celular</label>
            <input type="number" id="celular" name="celular" class="form-control form-control-sm @error('celular') is-invalid @enderror" value="{{ old('celular', $nomina->celular) }}">
          </div>
          <div class="form-group col-12 col-md-5">
            <label for="correo">Correo</label>
            <input type="mail" id="correo" name="correo" class="form-control form-control-sm @error('correo') is-invalid @enderror" value="{{ old('correo', $nomina->correo) }}">
          </div>
          <div class="form-group col-12 col-md-3">
            <label for="tipo_sangre">Tipo de Sangre</label>
            <select class="form-control form-control-sm @error('tipo_sangre') is-invalid @enderror" name="tipo_sangre" id="tipo_sangre" data-tags="true">
              <option disabled selected>Selecciona uno...</option>
              <option value="1" {{ old('tipo_sangre', $nomina->tipo_sangre) == '1' ? 'selected' : '' }}>A+</option>
              <option value="2" {{ old('tipo_sangre', $nomina->tipo_sangre) == '2' ? 'selected' : '' }}>A-</option>
              <option value="3" {{ old('tipo_sangre', $nomina->tipo_sangre) == '3' ? 'selected' : '' }}>B+</option>
              <option value="4" {{ old('tipo_sangre', $nomina->tipo_sangre) == '4' ? 'selected' : '' }}>B-</option>
              <option value="5" {{ old('tipo_sangre', $nomina->tipo_sangre) == '5' ? 'selected' : '' }}>AB+</option>
              <option value="6" {{ old('tipo_sangre', $nomina->tipo_sangre) == '6' ? 'selected' : '' }}>AB-</option>
              <option value="7" {{ old('tipo_sangre', $nomina->tipo_sangre) == '7' ? 'selected' : '' }}>O+</option>
              <option value="8" {{ old('tipo_sangre', $nomina->tipo_sangre) == '8' ? 'selected' : '' }}>O-</option>
            </select>
          </div>
          <div class="form-group col-12 col-md-5">
            <label for="padecimientos_medicos">Padecimientos Médicos</label>
            <textarea class="form-control form-control-sm @error('padecimientos_medicos') is-invalid @enderror" name="padecimientos_medicos" id="padecimientos_medicos" rows="3">{{ old('padecimientos_medicos', $nomina->padecimientos_medicos) }}</textarea>
          </div>
          <div class="form-group col-12 col-md-3">
            <label for="genero">Género</label>
            <select class="form-control form-control-sm @error('genero') is-invalid @enderror" name="genero" id="genero" data-tags="true">
              <option disabled selected>Selecciona uno...</option>
              <option value="1" {{ old('genero', $nomina->genero) == '1' ? 'selected' : '' }}>Masculino</option>
              <option value="2" {{ old('genero', $nomina->genero) == '2' ? 'selected' : '' }}>Femenino</option>
            </select>
          </div>
          <div class="form-group col-12 col-md-3">
            <label for="estado_civil">Estado Civil</label>
            <select class="form-control form-control-sm @error('estado_civil') is-invalid @enderror" name="estado_civil" id="estado_civil" data-tags="true">
              <option disabled selected>Selecciona uno...</option>
              <option value="1" {{ old('estado_civil', $nomina->estado_civil) == '1' ? 'selected' : '' }}>Soltero/a</option>
              <option value="2" {{ old('estado_civil', $nomina->estado_civil) == '2' ? 'selected' : '' }}>Casado/a</option>
              <option value="3" {{ old('estado_civil', $nomina->estado_civil) == '3' ? 'selected' : '' }}>Divorciado/a</option>
              <option value="4" {{ old('estado_civil', $nomina->estado_civil) == '4' ? 'selected' : '' }}>Viudo/a</option>
              <option value="5" {{ old('estado_civil', $nomina->estado_civil) == '5' ? 'selected' : '' }}>Unión Libre</option>
            </select>
          </div>
          <div class="form-group col-12 col-md-5">
            <label for="cant_hijos">Cantidad de Hijos</label>
            <input type="number" id="cant_hijos" name="cant_hijos" class="form-control form-control-sm @error('cant_hijos') is-invalid @enderror" value="{{ old('cant_hijos', $nomina->cant_hijos) }}">
          </div>
        </div>
      </div>
    </section>

    <section id="datos-empresariales" class="mt-3">
      <h6>Datos Empresariales</h6>
      <hr>
      <div class="form-row">
        <div class="form-group col-6 col-md-2">
          <label for="inicio_labor">Inicio Labores</label>
          <input type="date" name="inicio_labor" id="inicio_labor" class="form-control form-control-sm @error('inicio_labor') is-invalid @enderror" value="{{ old('inicio_labor', $nomina->inicio_labor) ?? date('Y-m-d') }}">
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="fin_labor">Fin de Labores</label>
          <input type="date" name="fin_labor" id="fin_labor" class="form-control form-control-sm @error('fin_labor') is-invalid @enderror" value="{{ old('fin_labor', $nomina->fin_labor) }}">
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="cargo">Cargo</label>
          <input type="text" id="cargo" name="cargo" class="form-control form-control-sm @error('cargo') is-invalid @enderror" value="{{ old('cargo', $nomina->cargo) }}">
        </div>
        <div class="form-group col-12 col-md-3">
          <label for="centro_costos">Centro de Costos</label>
          <select class="form-control form-control-sm @error('centro_costos') is-invalid @enderror" name="centro_costos" id="centro_costos" data-tags="true" disabled>
            <option disabled selected>Selecciona uno...</option>
            <option value="1" {{ old('centro_costos', $nomina->centro_costos) == '1' ? 'selected' : '' }}>Administración</option>
            <option value="2" {{ old('centro_costos', $nomina->centro_costos) == '2' ? 'selected' : '' }}>Producción</option>
            <option value="3" {{ old('centro_costos', $nomina->centro_costos) == '3' ? 'selected' : '' }}>Ventas</option>
          </select>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="ingreso_iess">Ingreso Iess</label>
          <input type="date" name="ingreso_iess" id="ingreso_iess" class="form-control form-control-sm @error('ingreso_iess') is-invalid @enderror" value="{{ old('ingreso_iess', $nomina->ingreso_iess) ?? date('Y-m-d') }}">
        </div>
        <div class="form-group col-3 col-md-2">
          <label for="statusDiv">Iess Asumido por el Empleador</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('iess_asumido_empleador') is-invalid @enderror" id="iess_asumido_empleador" name="iess_asumido_empleador" {{ old('iess_asumido_empleador', $nomina->iess_asumido_empleador) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="iess_asumido_empleador"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-5">
          <label for="sueldo">Sueldo</label>
          <input type="number" id="sueldo" name="sueldo" class="form-control form-control-sm @error('sueldo') is-invalid @enderror" value="{{ old('sueldo', $nomina->sueldo) }}">
        </div>
        <div class="form-group col-3 col-md-2">
          <label for="statusDiv">Liquidación Mensual</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('liquidacion_mensual') is-invalid @enderror" id="liquidacion_mensual" name="liquidacion_mensual" {{ old('liquidacion_mensual', $nomina->liquidacion_mensual) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="liquidacion_mensual"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-3">
          <label for="banco_id">Banco</label>
          <select class="form-control form-control-sm @error('banco_id') is-invalid @enderror" name="banco_id" id="banco_id" data-tags="true" disabled>
            <option disabled selected>Selecciona uno...</option>
            {{-- <option value="" {{ old('banco_id', $nomina->banco_id) == '' ? 'selected' : '' }}></option> --}}
          </select>
        </div>
        <div class="form-group col-12 col-md-3">
          <label for="tipo_cuenta_bancaria">tipo_cuenta_bancaria</label>
          <select class="form-control form-control-sm @error('tipo_cuenta_bancaria') is-invalid @enderror" name="tipo_cuenta_bancaria" id="tipo_cuenta_bancaria" data-tags="true" disabled>
            <option disabled selected>Selecciona uno...</option>
            <option value="1" {{ old('tipo_cuenta_bancaria', $nomina->tipo_cuenta_bancaria) == '1' ? 'selected' : '' }}>Ahorros</option>
            <option value="2" {{ old('tipo_cuenta_bancaria', $nomina->tipo_cuenta_bancaria) == '' ? 'selected' : '' }}>Corriente</option>
          </select>
        </div>
        <div class="form-group col-12 col-md-5">
          <label for="numero_cuenta_bancaria">Número de Cuenta Bancaria</label>
          <input type="text" id="numero_cuenta_bancaria" name="numero_cuenta_bancaria" class="form-control form-control-sm @error('numero_cuenta_bancaria') is-invalid @enderror" value="{{ old('numero_cuenta_bancaria', $nomina->numero_cuenta_bancaria) }}">
        </div>
        <div class="form-group col-12 col-md-5">
          <label for="observaciones">observaciones</label>
          <textarea class="form-control form-control-sm @error('observaciones') is-invalid @enderror" name="observaciones" id="observaciones" rows="3">{{ old('observaciones', $nomina->observaciones) }}</textarea>
        </div>
        <div class="form-group col-3 col-md-2">
          <label for="statusDiv">Activo</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" id="status" name="status" {{ old('status', $nomina->status) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="status"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-3">
          <label for="horario_id">Horario</label>
          <select class="form-control form-control-sm @error('horario_id') is-invalid @enderror" name="horario_id" id="horario_id" data-tags="true" disabled>
            <option disabled selected>Selecciona uno...</option>
            {{-- <option value="" {{ old('horario_id', $nomina->horario_id) == '' ? 'selected' : '' }}></option> --}}
          </select>
        </div>
        <div class="form-group col-3 col-md-2">
          <label for="statusDiv">Trabajo por Horas</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('Txhoras') is-invalid @enderror" id="Txhoras" name="Txhoras" {{ old('Txhoras', $nomina->Txhoras) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="Txhoras"></label>
          </div>
        </div>


        {{-- <div class="form-group col-12 col-md-5">
          <label for=""></label>
          <input type="text" id="" name="" class="form-control form-control-sm @error('') is-invalid @enderror" value="{{ old('', $nomina->) }}">
        </div>
        <div class="form-group col-3 col-md-2">
          <label for="statusDiv">Activo</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" id="status" name="status" {{ old('status', $nomina->status) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="status"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for=""></label>
          <input type="date" name="" id="" class="form-control form-control-sm @error('') is-invalid @enderror" value="{{ old('', $nomina->) ?? date('Y-m-d') }}">
        </div>
        <div class="form-group col-12 col-md-3">
          <label for=""></label>
          <select class="form-control form-control-sm @error('') is-invalid @enderror" name="" id="" data-tags="true">
            <option disabled selected>Selecciona uno...</option>
            <option value="" {{ old('', $nomina->) == '' ? 'selected' : '' }}></option>
            @endforeach
          </select>
        </div> --}}

      </div>
    </section>

    <hr style="border-width: 3px;">

    <section id="familia">
      <h6>Familiares</h6>
      <hr>
      <div class="table-responsive">
        <table id="table-familia" class="table table-sm">
          <thead>
            <tr>
              <th scope="col" class="crudCol"><i id="addFamilia" class="fas fa-plus"></i></th>
              <th scope="col">Relación</th>
              <th scope="col">Nombre</th>
              <th scope="col">Fecha de Nacimiento</th>
              <th scope="col">Ocupación</th>
              <th scope="col">Teléfono</th>
              <th scope="col">Celular</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </section>

    <hr style="border-width: 3px;">

    <section id="educacion">
      <h6>Educación</h6>
      <hr>
      <div class="table-responsive">
        <table id="table-educacion" class="table table-sm">
          <thead>
            <tr>
              <th scope="col" class="crudCol"><i id="addEducacion" class="fas fa-plus"></i></th>
              <th scope="col">Nivel de Educacion</th>
              <th scope="col">Institución</th>
              <th scope="col">Desde</th>
              <th scope="col">Hasta</th>
              <th scope="col">Título</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </section>

    <hr style="border-width: 3px;">

    <section id="documento">
      <h6>Documentos entregados</h6>
      <hr>
      <div class="form-row">
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">aviso_entrada</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('aviso_entrada') is-invalid @enderror" id="aviso_entrada" name="aviso_entrada" {{ old('aviso_entrada', $nomina->aviso_entrada) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="aviso_entrada"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">contrato_trabajo</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('contrato_trabajo') is-invalid @enderror" id="contrato_trabajo" name="contrato_trabajo" {{ old('contrato_trabajo', $nomina->contrato_trabajo) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="contrato_trabajo"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">solicitud_empleo</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('solicitud_empleo') is-invalid @enderror" id="solicitud_empleo" name="solicitud_empleo" {{ old('solicitud_empleo', $nomina->solicitud_empleo) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="solicitud_empleo"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">curriculum_vitae</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('curriculum_vitae') is-invalid @enderror" id="curriculum_vitae" name="curriculum_vitae" {{ old('curriculum_vitae', $nomina->curriculum_vitae) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="curriculum_vitae"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">cedula_identidad</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('cedula_identidad') is-invalid @enderror" id="cedula_identidad" name="cedula_identidad" {{ old('cedula_identidad', $nomina->cedula_identidad) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="cedula_identidad"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">papeleta_votacion</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('papeleta_votacion') is-invalid @enderror" id="papeleta_votacion" name="papeleta_votacion" {{ old('papeleta_votacion', $nomina->papeleta_votacion) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="papeleta_votacion"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">record_policial</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('record_policial') is-invalid @enderror" id="record_policial" name="record_policial" {{ old('record_policial', $nomina->record_policial) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="record_policial"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">libreta_militar</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('libreta_militar') is-invalid @enderror" id="libreta_militar" name="libreta_militar" {{ old('libreta_militar', $nomina->libreta_militar) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="libreta_militar"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">certificado_escolar</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('certificado_escolar') is-invalid @enderror" id="certificado_escolar" name="certificado_escolar" {{ old('certificado_escolar', $nomina->certificado_escolar) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="certificado_escolar"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">certificado_colegio</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('certificado_colegio') is-invalid @enderror" id="certificado_colegio" name="certificado_colegio" {{ old('certificado_colegio', $nomina->certificado_colegio) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="certificado_colegio"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">certificado_universitario</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('certificado_universitario') is-invalid @enderror" id="certificado_universitario" name="certificado_universitario" {{ old('certificado_universitario', $nomina->certificado_universitario) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="certificado_universitario"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">certificado_otros</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('certificado_otros') is-invalid @enderror" id="certificado_otros" name="certificado_otros" {{ old('certificado_otros', $nomina->certificado_otros) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="certificado_otros"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">referencia_empleos</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('referencia_empleos') is-invalid @enderror" id="referencia_empleos" name="referencia_empleos" {{ old('referencia_empleos', $nomina->referencia_empleos) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="referencia_empleos"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">referencia_personales</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('referencia_personales') is-invalid @enderror" id="referencia_personales" name="referencia_personales" {{ old('referencia_personales', $nomina->referencia_personales) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="referencia_personales"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">certificado_medico</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('certificado_medico') is-invalid @enderror" id="certificado_medico" name="certificado_medico" {{ old('certificado_medico', $nomina->certificado_medico) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="certificado_medico"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">aviso_salida</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('aviso_salida') is-invalid @enderror" id="aviso_salida" name="aviso_salida" {{ old('aviso_salida', $nomina->aviso_salida) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="aviso_salida"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">acta_finiquito</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('acta_finiquito') is-invalid @enderror" id="acta_finiquito" name="acta_finiquito" {{ old('acta_finiquito', $nomina->acta_finiquito) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="acta_finiquito"></label>
          </div>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="statusDiv">recibo_pago_acta_fini</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('recibo_pago_acta_fini') is-invalid @enderror" id="recibo_pago_acta_fini" name="recibo_pago_acta_fini" {{ old('recibo_pago_acta_fini', $nomina->recibo_pago_acta_fini) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="recibo_pago_acta_fini"></label>
          </div>
        </div>
      </div>
    </section>

    <hr style="border-width: 3px;">

    <section id="referncia">
      <h6>Referencias Laborales</h6>
      <hr>
      <div class="table-responsive">
        <table id="table-referncia" class="table table-sm">
          <thead>
            <tr>
              <th scope="col" class="crudCol"><i id="addReferncia" class="fas fa-plus"></i></th>
              <th scope="col">Tipo</th>
              <th scope="col">Empresa</th>
              <th scope="col">Contacto</th>
              <th scope="col">Teléfono</th>
              <th scope="col">Afinidad</th>
              <th scope="col">Inicio Laboral</th>
              <th scope="col">Fin Laboral</th>
              <th scope="col">Cargo</th>
              <th scope="col">Razón de Desvinculación</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </section>

    <hr style="border-width: 3px;">

    <section id="dotacion">
      <h6>Dotación Enregada</h6>
      <hr>
      <div class="table-responsive">
        <table id="table-dotacion" class="table table-sm">
          <thead>
            <tr>
              <th scope="col" class="crudCol"><i id="addDotacion" class="fas fa-plus"></i></th>
              <th scope="col">Entrega</th>
              <th scope="col">Articulo</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </section>
  </form>
</x-blueBoard>
@endsection

@section('scripts')
<script>

  //ARTICULO
  var i = 0;
  var ivas_opts = '';

  $('#addArticulo').click(function(){
    let table = $('#table-articulos > tbody');

    let button = $('<i />', {'type': 'button', 'class':'fas fa-times removeRow', 'name': 'remove', 'id':'articulo-'+i});

    let cantidad = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-center', 'value': '0', 'name': 'articulo[cantidad][]', 'id': 'articulo_cantidad_'+i, 'data-index':i, 'min': '0', 'onchange':'sumar('+i+');'});

    let detalle = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name':'articulo[detalle][]'});

    let iva = $('<select />', {'name' : 'articulo[iva_id][]', 'id': 'articulo_iva_'+i, 'class': 'form-control form-control-sm text-center', 'onchange':'sumar('+i+');'}).append(ivas_opts);

    let unitario = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-right fixFloat', 'value': '0.00', 'name':'articulo[valor_unitario][]', 'id': 'articulo_valor_unitario_'+i, 'min': '0', 'onchange':'sumar('+i+');'});

    let subtotal = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-right fixFloat', 'value': '0.00', 'name':'articulo[subtotal][]', 'id': 'articulo_subtotal_'+i, 'readonly':'readonly', 'min': '0'});

    newRow(table, [button, cantidad, detalle, iva, unitario, subtotal], 'row-articulo-'+i);
    i++;
  });

  $('#formSubmit').click(function(){
    $('#form').submit();
  });
</script>
@endsection
