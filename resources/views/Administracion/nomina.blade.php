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
      <h6 class="font-weight-bold">Datos Personales</h6>
      <hr>
      <div class="row">
        <div class="form-group col-12 col-md-2">
          <label for="foto">Foto</label>
          <input type="file" class="form-control-file dropify" name="foto" id="foto" data-default-file="{{ asset("usuarios/$nomina->foto") }}" data-max-file-size="2M" />
        </div>
        <div class="form-row col-12 col-md-10">
          <div class="form-group col-12 col-md-2">
            <label for="fecha_nacimiento">Fecha Nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control form-control-sm @error('fecha_nancimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento', $nomina->fecha_nacimiento) ?? date('Y-m-d') }}">
          </div>
          <div class="form-group col-12 col-md-2">
            <label for="lugar_nacimiento">Lugar Nacimiento</label>
            <input type="text" id="lugar_nacimiento" name="lugar_nacimiento" class="form-control form-control-sm @error('lugar_nacimiento') is-invalid @enderror" value="{{ old('lugar_nacimiento', $nomina->lugar_nacimiento) }}">
          </div>
          <div class="form-group col-12 col-md-2">
            <label for="nacionalidad">Nacionalidad</label>
            <input type="text" id="nacionalidad" name="nacionalidad" class="form-control form-control-sm @error('nacionalidad') is-invalid @enderror" value="{{ old('nacionalidad', $nomina->nacionalidad) }}">
          </div>
          <div class="form-group col-12 col-md-2">
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
          <div class="form-group col-12 col-md-2">
            <label for="genero">Género</label>
            <select class="form-control form-control-sm @error('genero') is-invalid @enderror" name="genero" id="genero" data-tags="true">
              <option disabled selected>Selecciona uno...</option>
              <option value="1" {{ old('genero', $nomina->genero) == '1' ? 'selected' : '' }}>Masculino</option>
              <option value="2" {{ old('genero', $nomina->genero) == '2' ? 'selected' : '' }}>Femenino</option>
            </select>
          </div>
          <div class="form-group col-12 col-md-2">
            <label for="idioma_nativo">Idioma Nativo</label>
            <input type="text" id="idioma_nativo" name="idioma_nativo" class="form-control form-control-sm @error('idioma_nativo') is-invalid @enderror" value="{{ old('idioma_nativo', $nomina->idioma_nativo) }}">
          </div>
          <div class="form-group col-12 col-md-2">
            <label for="cedula">Cédula</label>
            <input type="text" id="cedula" name="cedula" class="form-control form-control-sm @error('cedula') is-invalid @enderror" value="{{ old('cedula', $nomina->cedula) }}">
          </div>
          <div class="form-group col-12 col-md-5">
            <label for="nombre">Nombres</label>
            <input type="text" id="nombre" name="nombre" class="form-control form-control-sm @error('nombre') is-invalid @enderror" value="{{ old('nombre', $nomina->nombre) }}">
          </div>
          <div class="form-group col-12 col-md-5">
            <label for="apellido">Apellidos</label>
            <input type="text" id="apellido" name="apellido" class="form-control form-control-sm @error('apellido') is-invalid @enderror" value="{{ old('apellido', $nomina->apellido) }}">
          </div>
          <div class="form-group col-12 col-md-2">
            <label for="telefono">Teléfono</label>
            <input type="number" id="telefono" name="telefono" class="form-control form-control-sm @error('telefono') is-invalid @enderror" value="{{ old('telefono', $nomina->telefono) }}">
          </div>
          <div class="form-group col-12 col-md-2">
            <label for="celular">Celular</label>
            <input type="number" id="celular" name="celular" class="form-control form-control-sm @error('celular') is-invalid @enderror" value="{{ old('celular', $nomina->celular) }}">
          </div>
          <div class="form-group col-12 col-md-4">
            <label for="correo">Correo</label>
            <input type="mail" id="correo" name="correo" class="form-control form-control-sm @error('correo') is-invalid @enderror" value="{{ old('correo', $nomina->correo) }}">
          </div>
          {{-- <div class="form-group col-12 col-md-5">
            <label for="cant_hijos">Cantidad de Hijos</label>
            <input type="number" id="cant_hijos" name="cant_hijos" class="form-control form-control-sm @error('cant_hijos') is-invalid @enderror" value="{{ old('cant_hijos', $nomina->cant_hijos) }}">
          </div> --}}
        </div>
      </div>
    </section>

    <section id="datos-domiciliarios">
      <h6 class="font-weight-bold">Datos Domiciliarios</h6>
      <hr>
      <div class="row">
        <div class="form-group col-12 col-md-6">
          <label for="direccion">Dirección</label>
          <input type="text" id="direccion" name="direccion" class="form-control form-control-sm @error('direccion') is-invalid @enderror" value="{{ old('direccion', $nomina->direccion) }}">
        </div>
        <div class="form-group col-12 col-md-2">
          <label for="sector">Sector</label>
          <input type="text" id="sector" name="sector" class="form-control form-control-sm @error('sector') is-invalid @enderror" value="{{ old('sector', $nomina->sector) }}">
        </div>
        <div class="form-group col-3 col-md-2 text-center">
          <label for="statusDiv">Visita Domiciliaria</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('visita_domiciliaria') is-invalid @enderror" id="visita_domiciliaria" name="visita_domiciliaria" {{ old('visita_domiciliaria', $nomina->visita_domiciliaria) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="visita_domiciliaria"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2">
          <label for="fecha_visita">Fecha Visita</label>
          <input type="date" name="fecha_visita" id="fecha_visita" class="form-control form-control-sm @error('fecha_visita') is-invalid @enderror" value="{{ old('fecha_visita', $nomina->fecha_visita) }}">
        </div>
      </div>
    </section>

    <section id="datos-empresariales" class="mt-3">
      <h6 class="font-weight-bold">Datos Empresariales</h6>
      <hr>
      <div class="form-row">
        <div class="form-group col-12 col-md-2">
          <label for="inicio_labor">Inicio Labores</label>
          <input type="date" name="inicio_labor" id="inicio_labor" class="form-control form-control-sm @error('inicio_labor') is-invalid @enderror" value="{{ old('inicio_labor', $nomina->inicio_labor) ?? date('Y-m-d') }}">
        </div>
        <div class="form-group col-12 col-md-2">
          <label for="fin_labor">Fin de Labores</label>
          <input type="date" name="fin_labor" id="fin_labor" class="form-control form-control-sm @error('fin_labor') is-invalid @enderror" value="{{ old('fin_labor', $nomina->fin_labor) }}">
        </div>
        <div class="form-group col-12 col-md-2">
          <label for="cargo">Cargo</label>
          <input type="text" id="cargo" name="cargo" class="form-control form-control-sm @error('cargo') is-invalid @enderror" value="{{ old('cargo', $nomina->cargo) }}">
        </div>
        <div class="form-group col-12 col-md-2">
          <label for="sueldo">Sueldo</label>
          <input type="number" id="sueldo" name="sueldo" class="form-control form-control-sm @error('sueldo') is-invalid @enderror" value="{{ old('sueldo', $nomina->sueldo) }}">
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Activo</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" id="status" name="status" {{ old('status', $nomina->status) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="status"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2">
          <label for="centro_costos">Centro de Costos</label>
          <select class="form-control form-control-sm @error('centro_costos') is-invalid @enderror" name="centro_costos" id="centro_costos">
            <option disabled selected>Selecciona uno...</option>
            @foreach ($ccostos as $item)
            <option value="{{ $item->id }}" {{ old('centro_costos', $nomina->centro_costos) == $item->id ? 'selected' : '' }}>{{ $item->nombre }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-12 col-md-2">
          <label for="ingreso_iess">Ingreso Iess</label>
          <input type="date" name="ingreso_iess" id="ingreso_iess" class="form-control form-control-sm @error('ingreso_iess') is-invalid @enderror" value="{{ old('ingreso_iess', $nomina->ingreso_iess) ?? date('Y-m-d') }}">
        </div>
        <div class="form-group col-3 col-md-2 text-center">
          <label for="statusDiv">Iess Asumido por el Empleador</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('iess_asumido_empleador') is-invalid @enderror" id="iess_asumido_empleador" name="iess_asumido_empleador" {{ old('iess_asumido_empleador', $nomina->iess_asumido_empleador) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="iess_asumido_empleador"></label>
          </div>
        </div>
        <div class="form-group col-3 col-md-2 text-center">
          <label for="statusDiv">Liquidación Mensual</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('liquidacion_mensual') is-invalid @enderror" id="liquidacion_mensual" name="liquidacion_mensual" {{ old('liquidacion_mensual', $nomina->liquidacion_mensual) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="liquidacion_mensual"></label>
          </div>
        </div>
        <div class="form-group col-3 col-md-2 text-center">
          <label for="statusDiv">Trabajo por Horas</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('Txhoras') is-invalid @enderror" id="Txhoras" name="Txhoras" {{ old('Txhoras', $nomina->Txhoras) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="Txhoras"></label>
          </div>
        </div>
        <div class="col-4"></div>
        <div class="form-group col-12 col-md-2">
          <label for="horario_id">Horario</label>
          <select class="form-control form-control-sm @error('horario_id') is-invalid @enderror" name="horario_id" id="horario_id" data-tags="true">
            <option disabled selected>Selecciona uno...</option>
            @foreach ($horarios as $item)
            <option value="{{ $item->id }}" {{ old('horario_id', $nomina->horario_id) == $item->id ? 'selected' : '' }}>{{ $item->nombre }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-12 col-md-10">
          <label for="observaciones">Observaciones</label>
          <textarea class="form-control form-control-sm @error('observaciones') is-invalid @enderror" name="observaciones" id="observaciones" rows="1">{{ old('observaciones', $nomina->observaciones) }}</textarea>
        </div>
        <div class="form-group col-12 col-md-2">
          <label for="banco_id">Banco</label>
          <select class="form-control form-control-sm @error('banco_id') is-invalid @enderror" name="banco_id" id="banco_id" data-tags="true" disabled>
            <option disabled selected>Selecciona uno...</option>
            {{-- <option value="" {{ old('banco_id', $nomina->banco_id) == '' ? 'selected' : '' }}></option> --}}
          </select>
        </div>
        <div class="form-group col-12 col-md-2">
          <label for="tipo_cuenta_bancaria">Tipo Cuenta</label>
          <select class="form-control form-control-sm @error('tipo_cuenta_bancaria') is-invalid @enderror" name="tipo_cuenta_bancaria" id="tipo_cuenta_bancaria" data-tags="true" disabled>
            <option disabled selected>Selecciona uno...</option>
            <option value="1" {{ old('tipo_cuenta_bancaria', $nomina->tipo_cuenta_bancaria) == '1' ? 'selected' : '' }}>Ahorros</option>
            <option value="2" {{ old('tipo_cuenta_bancaria', $nomina->tipo_cuenta_bancaria) == '' ? 'selected' : '' }}>Corriente</option>
          </select>
        </div>
        <div class="form-group col-12 col-md-2">
          <label for="numero_cuenta_bancaria">Número Cuenta</label>
          <input type="text" id="numero_cuenta_bancaria" name="numero_cuenta_bancaria" class="form-control form-control-sm @error('numero_cuenta_bancaria') is-invalid @enderror" value="{{ old('numero_cuenta_bancaria', $nomina->numero_cuenta_bancaria) }}">
        </div>
      </div>
    </section>

    <hr style="border-width: 3px;">

    <section id="documento">
      <h6 class="font-weight-bold">Documentos entregados</h6>
      <hr>
      <div class="form-row">
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Aviso Entrada</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('aviso_entrada') is-invalid @enderror" id="aviso_entrada" name="aviso_entrada" {{ old('aviso_entrada', $nomina->aviso_entrada) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="aviso_entrada"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Contrato Trabajo</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('contrato_trabajo') is-invalid @enderror" id="contrato_trabajo" name="contrato_trabajo" {{ old('contrato_trabajo', $nomina->contrato_trabajo) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="contrato_trabajo"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Solicitud Empleo</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('solicitud_empleo') is-invalid @enderror" id="solicitud_empleo" name="solicitud_empleo" {{ old('solicitud_empleo', $nomina->solicitud_empleo) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="solicitud_empleo"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Curriculum Vitae</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('curriculum_vitae') is-invalid @enderror" id="curriculum_vitae" name="curriculum_vitae" {{ old('curriculum_vitae', $nomina->curriculum_vitae) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="curriculum_vitae"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Cedula Identidad</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('cedula_identidad') is-invalid @enderror" id="cedula_identidad" name="cedula_identidad" {{ old('cedula_identidad', $nomina->cedula_identidad) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="cedula_identidad"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Papeleta Votacion</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('papeleta_votacion') is-invalid @enderror" id="papeleta_votacion" name="papeleta_votacion" {{ old('papeleta_votacion', $nomina->papeleta_votacion) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="papeleta_votacion"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Record Policial</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('record_policial') is-invalid @enderror" id="record_policial" name="record_policial" {{ old('record_policial', $nomina->record_policial) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="record_policial"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Libreta Militar</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('libreta_militar') is-invalid @enderror" id="libreta_militar" name="libreta_militar" {{ old('libreta_militar', $nomina->libreta_militar) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="libreta_militar"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Certificado Escolar</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('certificado_escolar') is-invalid @enderror" id="certificado_escolar" name="certificado_escolar" {{ old('certificado_escolar', $nomina->certificado_escolar) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="certificado_escolar"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Certificado Colegio</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('certificado_colegio') is-invalid @enderror" id="certificado_colegio" name="certificado_colegio" {{ old('certificado_colegio', $nomina->certificado_colegio) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="certificado_colegio"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Certificado Universitario</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('certificado_universitario') is-invalid @enderror" id="certificado_universitario" name="certificado_universitario" {{ old('certificado_universitario', $nomina->certificado_universitario) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="certificado_universitario"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Certificado Otros</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('certificado_otros') is-invalid @enderror" id="certificado_otros" name="certificado_otros" {{ old('certificado_otros', $nomina->certificado_otros) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="certificado_otros"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Referencia Empleos</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('referencia_empleos') is-invalid @enderror" id="referencia_empleos" name="referencia_empleos" {{ old('referencia_empleos', $nomina->referencia_empleos) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="referencia_empleos"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Referencia Personales</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('referencia_personales') is-invalid @enderror" id="referencia_personales" name="referencia_personales" {{ old('referencia_personales', $nomina->referencia_personales) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="referencia_personales"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Certificado Medico</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('certificado_medico') is-invalid @enderror" id="certificado_medico" name="certificado_medico" {{ old('certificado_medico', $nomina->certificado_medico) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="certificado_medico"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Aviso Salida</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('aviso_salida') is-invalid @enderror" id="aviso_salida" name="aviso_salida" {{ old('aviso_salida', $nomina->aviso_salida) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="aviso_salida"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Acta Finiquito</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('acta_finiquito') is-invalid @enderror" id="acta_finiquito" name="acta_finiquito" {{ old('acta_finiquito', $nomina->acta_finiquito) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="acta_finiquito"></label>
          </div>
        </div>
        <div class="form-group col-12 col-md-2 text-center">
          <label for="statusDiv">Recibo Pago Acta Fini</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
            <input type="checkbox" class="custom-control-input @error('recibo_pago_acta_fini') is-invalid @enderror" id="recibo_pago_acta_fini" name="recibo_pago_acta_fini" {{ old('recibo_pago_acta_fini', $nomina->recibo_pago_acta_fini) == '1' ? 'checked':'' }} value='1'>
            <label class="custom-control-label" for="recibo_pago_acta_fini"></label>
          </div>
        </div>
      </div>
    </section>

    <hr style="border-width: 3px;">

    <section id="educacion">
      <h6 class="font-weight-bold">Educación</h6>
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

    <section id="referencia">
      <h6 class="font-weight-bold">Referencias Laborales</h6>
      <hr>
      <div class="table-responsive">
        <table id="table-referencia" class="table table-sm">
          <thead>
            <tr>
              <th scope="col" class="crudCol"><i id="addReferencia" class="fas fa-plus"></i></th>
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
      <h6 class="font-weight-bold">Dotación Enregada</h6>
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

    <hr style="border-width: 3px;">

    <section id="datos-medicos" class="mt-3">
      <h6 class="font-weight-bold">Datos Médicos</h6>
      <hr>
      <div class="form-row">
        <div class="form-group col-12 col-md-6">
          <label for="contacto_emergencia_nombre">Contacto Emergencia Nombre</label>
          <input type="text" id="contacto_emergencia_nombre" name="contacto_emergencia_nombre" class="form-control form-control-sm @error('contacto_emergencia_nombre') is-invalid @enderror" value="{{ old('contacto_emergencia_nombre', $nomina->contacto_emergencia_nombre) }}">
        </div>
        <div class="form-group col-12 col-md-2">
          <label for="contacto_emergencia_domicilio">Domicilio</label>
          <input type="text" id="contacto_emergencia_domicilio" name="contacto_emergencia_domicilio" class="form-control form-control-sm @error('contacto_emergencia_domicilio') is-invalid @enderror" value="{{ old('contacto_emergencia_domicilio', $nomina->contacto_emergencia_domicilio) }}" placeholder="2222222">
        </div>
        <div class="form-group col-12 col-md-2">
          <label for="contacto_emergencia_celular">Celular</label>
          <input type="text" id="contacto_emergencia_celular" name="contacto_emergencia_celular" class="form-control form-control-sm @error('contacto_emergencia_celular') is-invalid @enderror" value="{{ old('contacto_emergencia_celular', $nomina->contacto_emergencia_celular) }}" placeholder="0999999999">
        </div>
        <div class="form-group col-12 col-md-2">
          <label for="contacto_emergencia_oficina">Oficina</label>
          <input type="text" id="contacto_emergencia_oficina" name="contacto_emergencia_oficina" class="form-control form-control-sm @error('contacto_emergencia_oficina') is-invalid @enderror" value="{{ old('contacto_emergencia_oficina', $nomina->contacto_emergencia_oficina) }}" placeholder="2222222">
        </div>
        <div class="form-group col-12 col-md-2">
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
          <textarea class="form-control form-control-sm @error('padecimientos_medicos') is-invalid @enderror" name="padecimientos_medicos" id="padecimientos_medicos" rows="1">{{ old('padecimientos_medicos', $nomina->padecimientos_medicos) }}</textarea>
        </div>
        <div class="form-group col-12 col-md-5">
          <label for="alergias">Alergias</label>
          <textarea class="form-control form-control-sm @error('alergias') is-invalid @enderror" name="alergias" id="alergias" rows="1">{{ old('alergias', $nomina->padecimientos_medicos) }}</textarea>
        </div>
      </div>
    </section>

    <hr style="border-width: 3px;">

    <section id="familia">
      <h6 class="font-weight-bold">Familiares</h6>
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

  </form>
</x-blueBoard>
@endsection

@section('scripts')
<script>

  //FAMILIARES
  var index_familia = 0;
  var ivas_opts = '';
  $('#addFamilia').click(function(){
    let table = $('#table-familia > tbody');

    let button = $('<i />', {'type': 'button', 'class':'fas fa-times removeRow', 'name': 'remove', 'id':'familia-'+index_familia});

    let relacion = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm', 'name': 'relacion[]', 'id': 'relacion_'+index_familia});

    let nombre = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name': 'nombre_fam[]', 'id': 'nombre_fam_'+index_familia});

    let fecha_nacimiento = $('<input />', {'type': 'date', 'class': 'form-control form-control-sm', 'name': 'fecha_nacimiento_fam[]', 'id': 'fecha_nacimiento_fam_'+index_familia});

    let ocupacion = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name': 'ocupacion[]', 'id': 'ocupacion_'+index_familia});

    let telefono = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm', 'name': 'telefono_fam[]', 'id': 'telefono_fam_'+index_familia, 'max': '9999999'});

    let celular = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm', 'name': 'celular_fam[]', 'id': 'celular_fam_'+index_familia, 'max': '0999999999'});

    newRow(table, [button, relacion, nombre, fecha_nacimiento, ocupacion, telefono, celular], 'row-familia-'+index_familia);
    index_familia++;
  });

  //EDUCACION
  var index_educacion = 0;
  $('#addEducacion').click(function(){
    let table = $('#table-educacion > tbody');

    let button = $('<i />', {'type': 'button', 'class':'fas fa-times removeRow', 'name': 'remove', 'id':'educacion-'+index_educacion});

    let nivel = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name': 'nivel_educ[]', 'id': 'nivel_educ_'+index_educacion});

    let institucion = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name': 'nombre_institucion[]', 'id': 'nombre_institucion_'+index_educacion});

    let desde = $('<input />', {'type': 'date', 'class': 'form-control form-control-sm', 'name': 'inicio[]', 'id': 'inicio_'+index_educacion});

    let hasta = $('<input />', {'type': 'date', 'class': 'form-control form-control-sm', 'name': 'fin[]', 'id': 'fin_'+index_educacion});

    let titulo = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name': 'titulo[]', 'id': 'titulo_'+index_educacion});

    newRow(table, [button, nivel, institucion, desde, hasta, titulo], 'row-educacion-'+index_educacion);
    index_educacion++;
  });

  //REFERENCIAS
  var index_referencia = 0;
  $('#addReferencia').click(function(){
    let table = $('#table-referencia > tbody');

    let button = $('<i />', {'type': 'button', 'class':'fas fa-times removeRow', 'name': 'remove', 'id':'referencia-'+index_referencia});

    let tipo = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name': 'tipo_refer[]', 'id': 'tipo_refer_'+index_referencia});

    let empresa = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name': 'empresa[]', 'id': 'empresa_'+index_referencia});

    let contacto = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name': 'contacto[]', 'id': 'contacto_'+index_referencia});

    let telefono = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name': 'telefono_refer[]', 'id': 'telefono_refer_'+index_referencia});

    let afinidad = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name': 'afinidad[]', 'id': 'afinidad_'+index_referencia});

    let inicio_laboral = $('<input />', {'type': 'date', 'class': 'form-control form-control-sm', 'name': 'inicio_laboral_refer[]', 'id': 'inicio_laboral_refer_'+index_referencia});

    let fin_laboral = $('<input />', {'type': 'date', 'class': 'form-control form-control-sm', 'name': 'fin_laboral_refer[]', 'id': 'fin_laboral_refer_'+index_referencia});

    let cargo = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name': 'cargo_refer[]', 'id': 'cargo_refer_'+index_referencia});

    let razon_separacion = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name': 'razon_separacion[]', 'id': 'razon_separacion_'+index_referencia});

    newRow(table, [button, tipo, empresa, contacto, telefono, afinidad, inicio_laboral, fin_laboral, cargo, razon_separacion], 'row-referencia-'+index_referencia);
    index_referencia++;
  });

  //DOTACION
  var index_dotacion = 0;
  $('#addDotacion').click(function(){
    let table = $('#table-dotacion > tbody');

    let button = $('<i />', {'type': 'button', 'class':'fas fa-times removeRow', 'name': 'remove', 'id':'dotacion-'+index_dotacion});

    let entrega = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name': 'entrega[]', 'id': 'entrega_'+index_dotacion});

    let articulo = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name': 'dotacion_id[]', 'id': 'dotacion_id_'+index_dotacion});

    newRow(table, [button, entrega, articulo], 'row-dotacion-'+index_dotacion);
    index_dotacion++;
  });

  $('#formSubmit').click(function(){
    $('#form').submit();
  });
</script>
@endsection
