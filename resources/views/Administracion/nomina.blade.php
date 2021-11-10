@extends('layouts.app')

@section('desktop-content')
  <x-path
    :items="[ ['text' => 'Nomina', 'current' => false, 'href' => route('nomina')], ['text' => $text, 'current' => true, 'href' => '#'] ]" />

  <x-blue-board :title=$text
    :foot="[ ['text'=>$action, 'href'=>'#', 'id'=>'formSubmit', 'tipo'=>'link'], ['text' => 'fas fa-print', 'href' => '#', 'id' => 'print', 'tipo' => 'button', 'print-target' => 'form']]">
    <form action="{{ $path }}" method="POST" id="form" enctype="multipart/form-data">
      @csrf
      @method($method)
      @include('Administracion._personales')
      @include('Administracion._domiciliarios')
      @include('Administracion._empresariales')

      <hr style="border-width: 3px;">

      @include('Administracion._documentos')

      <hr style="border-width: 3px;">

      <section id="educacion">
        <h6 class="font-weight-bold">Educación</h6>
        <hr>
        <div class="table-responsive">
          <table id="table-educacion" class="table table-sm">
            <thead>
              <tr>
                <th scope="col" class="w-2"><i id="addEducacion" class="fas fa-plus"></i></th>
                <th scope="col">Nivel de Educacion</th>
                <th scope="col">Institución</th>
                <th scope="col" class="w-10">Desde</th>
                <th scope="col" class="w-10">Hasta</th>
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
        <h6 class="font-weight-bold">Referencias</h6>
        <hr>
        <div class="table-responsive">
          <table id="table-referencia" class="table table-sm">
            <thead>
              <tr>
                <th scope="col" class="w-2"><i id="addReferencia" class="fas fa-plus"></i></th>
                <th scope="col">Tipo</th>
                <th scope="col">Empresa</th>
                <th scope="col">Contacto</th>
                <th scope="col" class="w-10">Teléfono</th>
                <th scope="col">Afinidad</th>
                <th scope="col" class="w-10">Inicio Laboral</th>
                <th scope="col" class="w-10">Fin Laboral</th>
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
                <th scope="col" class="w-2"><i id="addDotacion" class="fas fa-plus"></i></th>
                <th scope="col" class="w-10">Entrega</th>
                <th scope="col">Articulo</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </section>

      <hr style="border-width: 3px;">

      @include('Administracion._medicos')

      <hr style="border-width: 3px;">

      <section id="familia">
        <h6 class="font-weight-bold">Familiares</h6>
        <hr>
        <div class="table-responsive">
          <table id="table-familia" class="table table-sm">
            <thead>
              <tr>
                <th scope="col" class="w-2"><i id="addFamilia" class="fas fa-plus"></i></th>
                <th scope="col" class="w-10">Relación</th>
                <th scope="col">Nombre</th>
                <th scope="col" class="w-10">Fecha de Nacimiento</th>
                <th scope="col">Ocupación</th>
                <th scope="col" class="w-10">Teléfono</th>
                <th scope="col" class="w-10">Celular</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </section>
    </form>
  </x-blue-board>
  @php
  // EDUCACION
  $opts_educacion = '<option disabled selected>Selecciona uno...</option>';
  foreach (config('nomina.educacion') ?? [] as $key => $value) {
      $opts_educacion .= "<option value='$key'>$value</option>";
  }
  $old_educacion = $nomina->educacion;
  if ($cnt = count(old('nivel_educ') ?? [])) {
      $old_educacion = [];
      for ($i = 0; $i < $cnt; $i++) {
          $model = new \stdClass();
          $model->nivel_educ = old('nivel_educ')[$i];
          $model->nombre_institucion = old('nombre_institucion')[$i];
          $model->inicio = old('inicio')[$i];
          $model->fin = old('fin')[$i];
          $model->titulo = old('titulo')[$i];
          $old_educacion[] = $model;
      }
  }

  // REFERENCIAS
  $opts_refs = '<option disabled selected>Selecciona uno...</option>';
  foreach (config('nomina.referencias') ?? [] as $key => $value) {
      $opts_refs .= "<option value='$key'>$value</option>";
  }
  $old_refs = $nomina->referencias;
  if ($cnt = count(old('tipo_refer') ?? [])) {
      $old_refs = [];
      for ($i = 0; $i < $cnt; $i++) {
          $model = new \stdClass();
          $model->tipo_refer = old('tipo_refer')[$i];
          $model->empresa = old('empresa')[$i];
          $model->contacto = old('contacto')[$i];
          $model->telefono_refer = old('telefono_refer')[$i];
          $model->afinidad = old('afinidad')[$i];
          $model->inicio_labor_refer = old('inicio_labor_refer')[$i];
          $model->fin_labor_refer = old('fin_labor_refer')[$i];
          $model->cargo_refer = old('cargo_refer')[$i];
          $model->razon_separacion = old('razon_separacion')[$i];
          $old_refs[] = $model;
      }
  }

  // DOTACION
  $opts_dotacion = '<option disabled>Selecciona uno...</option>';
  foreach ($dotacion as $item) {
      $opts_dotacion .= "<option value='$item->id'>$item->dotacion</option>";
  }
  $old_dotacion = $nomina->dotacion;
  if ($cnt = count(old('dotacion_id') ?? [])) {
      $old_dotacion = [];
      for ($i = 0; $i < $cnt; $i++) {
          $model = new \stdClass();
          $model->entrega = old('entrega')[$i];
          $model->dotacion_id = old('dotacion_id')[$i];
          $old_dotacion[] = $model;
      }
  }

  // FAMILIARES
  $opts_relaciones = '<option disabled selected>Selecciona uno...</option>';
  foreach (config('nomina.relaciones') ?? [] as $key => $value) {
      $opts_relaciones .= "<option value='$key'>$value</option>";
  }
  $old_familiares = $nomina->familiares;
  if ($cnt = count(old('relacion') ?? [])) {
      $old_familiares = [];
      for ($i = 0; $i < $cnt; $i++) {
          $model = new \stdClass();
          $model->relacion = old('relacion')[$i];
          $model->nombre_fam = old('nombre_fam')[$i];
          $model->fecha_nacimiento_fam = old('fecha_nacimiento_fam')[$i];
          $model->ocupacion = old('ocupacion')[$i];
          $model->telefono_fam = old('telefono_fam')[$i];
          $model->celular_fam = old('celular_fam')[$i];
          $old_familiares[] = $model;
      }
  }
  @endphp
@endsection

@section('scripts')
  <script>
    // EDUCACION
    var index_educacion = 0;
    const niveles = `@json($opts_educacion)`;
    const old_educacion = JSON.parse(`@json($old_educacion)`);
    const add_educacion = (nivel_val = null, institucion_val = null, desde_val = null, hasta_val = null, titulo_val =
      null) => {
      let table = $('#table-educacion > tbody');

      let button = $('<i />', {
        'type': 'button',
        'class': 'fas fa-times removeRow',
        'name': 'remove',
        'id': `educacion-${index_educacion}`
      });

      let nivel = $('<select />', {
        'class': 'form-control form-control-sm',
        'name': 'nivel_educ[]',
        'id': `nivel_educ_${index_educacion}`
      }).append(niveles);
      if (nivel_val) nivel.val(nivel_val);

      let institucion = $('<input />', {
        'type': 'text',
        'class': 'form-control form-control-sm',
        'name': 'nombre_institucion[]',
        'id': `nombre_institucion_${index_educacion}`,
        'value': institucion_val
      });

      let desde = $('<input />', {
        'type': 'date',
        'class': 'form-control form-control-sm',
        'name': 'inicio[]',
        'id': `inicio_${index_educacion}`,
        'value': desde_val
      });

      let hasta = $('<input />', {
        'type': 'date',
        'class': 'form-control form-control-sm',
        'name': 'fin[]',
        'id': `fin_${index_educacion}`,
        'value': hasta_val
      });

      let titulo = $('<input />', {
        'type': 'text',
        'class': 'form-control form-control-sm',
        'name': 'titulo[]',
        'id': `titulo_${index_educacion}`,
        'value': titulo_val
      });

      newRow(table, [button, nivel, institucion, desde, hasta, titulo], `row-educacion-${index_educacion}`);
      index_educacion++;
    };
    $('#addEducacion').click(() => add_educacion());
    if (old_educacion != []) {
      old_educacion.map(item => {
        add_educacion(item.nivel_educ, item.nombre_institucion, item.inicio, item.fin, item.titulo);
      });
    }


    // REFERENCIAS
    var index_referencia = 0;
    const referencias = `@json($opts_refs)`;
    const old_refs = JSON.parse(`@json($old_refs)`);
    const add_referencia = (tipo_refer_val = null, empresa_val = null, contacto_val = null, telefono_refer_val = null,
      afinidad_val = null, inicio_labor_refer_val = null, fin_labor_refer_val = null, cargo_refer_val = null,
      razon_separacion_val = null) => {
      let table = $('#table-referencia > tbody');

      let button = $('<i />', {
        'type': 'button',
        'class': 'fas fa-times removeRow',
        'name': 'remove',
        'id': `referencia-${index_referencia}`
      });

      let tipo = $('<select />', {
        'type': 'text',
        'class': 'form-control form-control-sm',
        'name': 'tipo_refer[]',
        'id': `tipo_refer_${index_referencia}`
      }).append(referencias);
      if (tipo_refer_val) tipo.val(tipo_refer_val);

      let empresa = $('<input />', {
        'type': 'text',
        'class': 'form-control form-control-sm',
        'name': 'empresa[]',
        'id': `empresa_${index_referencia}`,
        'value': empresa_val
      });

      let contacto = $('<input />', {
        'type': 'text',
        'class': 'form-control form-control-sm',
        'name': 'contacto[]',
        'id': `contacto_${index_referencia}`,
        'value': contacto_val
      });

      let telefono = $('<input />', {
        'type': 'text',
        'class': 'form-control form-control-sm',
        'name': 'telefono_refer[]',
        'id': `telefono_refer_${index_referencia}`,
        'value': telefono_refer_val
      });

      let afinidad = $('<input />', {
        'type': 'text',
        'class': 'form-control form-control-sm',
        'name': 'afinidad[]',
        'id': `afinidad_${index_referencia}`,
        'value': afinidad_val
      });

      let inicio_laboral = $('<input />', {
        'type': 'date',
        'class': 'form-control form-control-sm',
        'name': 'inicio_labor_refer[]',
        'id': `inicio_labor_refer_${index_referencia}`,
        'value': inicio_labor_refer_val
      });

      let fin_laboral = $('<input />', {
        'type': 'date',
        'class': 'form-control form-control-sm',
        'name': 'fin_labor_refer[]',
        'id': `fin_labor_refer_${index_referencia}`,
        'value': fin_labor_refer_val
      });

      let cargo = $('<input />', {
        'type': 'text',
        'class': 'form-control form-control-sm',
        'name': 'cargo_refer[]',
        'id': `cargo_refer_${index_referencia}`,
        'value': cargo_refer_val
      });

      let razon_separacion = $('<input />', {
        'type': 'text',
        'class': 'form-control form-control-sm',
        'name': 'razon_separacion[]',
        'id': `razon_separacion_${index_referencia}`,
        'value': razon_separacion_val
      });

      newRow(table, [button, tipo, empresa, contacto, telefono, afinidad, inicio_laboral, fin_laboral, cargo,
        razon_separacion
      ], `row-referencia-${index_referencia}`);
      index_referencia++;
    };
    $('#addReferencia').click(() => add_referencia());
    if (old_refs != []) {
      old_refs.map(item => {
        console.log(item);
        add_referencia(item.tipo_refer, item.empresa, item.contacto, item.telefono_refer, item.afinidad, item
          .inicio_labor_refer, item.fin_labor_refer, item.cargo_refer, item.razon_separacion);
      });
    }


    // DOTACION
    var index_dotacion = 0;
    const articulos = `@json($opts_dotacion)`;
    const old_dotacion = JSON.parse(`@json($old_dotacion)`);
    const add_dotacion = (entrega_val, dotacion_id_val) => {
      let table = $('#table-dotacion > tbody');

      let button = $('<i />', {
        'type': 'button',
        'class': 'fas fa-times removeRow',
        'name': 'remove',
        'id': `dotacion-${index_dotacion}`
      });

      let entrega = $('<input />', {
        'type': 'date',
        'class': 'form-control form-control-sm',
        'name': 'entrega[]',
        'id': `entrega_${index_dotacion}`,
        'value': entrega_val
      });

      let articulo = $('<select />', {
        'type': 'number',
        'class': 'form-control form-control-sm select2Class',
        'name': `dotacion_id[${index_dotacion}][]`,
        'id': `dotacion_id_${index_dotacion}`,
        'multiple': 'multiple'
      }).append(articulos);
      if (dotacion_id_val) articulo.val(dotacion_id_val);

      newRow(table, [button, entrega, articulo], `row-dotacion-${index_dotacion}`);
      $('.select2Class').select2();
      index_dotacion++;
    };
    $('#addDotacion').click(() => add_dotacion());
    if (old_dotacion != []) {
      old_dotacion.map(item => {
        add_dotacion(item.entrega, JSON.parse(item.dotacion_id));
      });
    }


    // FAMILIARES
    var index_familia = 0;
    const relaciones = `@json($opts_relaciones)`;
    const old_familiares = JSON.parse(`@json($old_familiares)`);
    const add_familia = (relacion_val = null, nombre_fam_val = null, fecha_nacimiento_fam_val = null, ocupacion_val =
      null, telefono_fam_val = null, celular_fam_val = null) => {
      let table = $('#table-familia > tbody');

      let button = $('<i />', {
        'type': 'button',
        'class': 'fas fa-times removeRow',
        'name': 'remove',
        'id': `familia-${index_familia}`
      });

      let relacion = $('<select />', {
        'type': 'number',
        'class': 'form-control form-control-sm',
        'name': 'relacion[]',
        'id': `relacion_${index_familia}`
      }).append(relaciones);
      if (relacion_val) relacion.val(relacion_val);

      let nombre = $('<input />', {
        'type': 'text',
        'class': 'form-control form-control-sm',
        'name': 'nombre_fam[]',
        'id': `nombre_fam_${index_familia}`,
        'value': nombre_fam_val
      });

      let fecha_nacimiento = $('<input />', {
        'type': 'date',
        'class': 'form-control form-control-sm',
        'name': 'fecha_nacimiento_fam[]',
        'id': `fecha_nacimiento_fam_${index_familia}`,
        'value': fecha_nacimiento_fam_val
      });

      let ocupacion = $('<input />', {
        'type': 'text',
        'class': 'form-control form-control-sm',
        'name': 'ocupacion[]',
        'id': `ocupacion_${index_familia}`,
        'value': ocupacion_val
      });

      let telefono = $('<input />', {
        'type': 'number',
        'class': 'form-control form-control-sm',
        'name': 'telefono_fam[]',
        'id': `telefono_fam_${index_familia}`,
        'max': '9999999',
        'value': telefono_fam_val
      });

      let celular = $('<input />', {
        'type': 'number',
        'class': 'form-control form-control-sm',
        'name': 'celular_fam[]',
        'id': `celular_fam_${index_familia}`,
        'max': '0999999999',
        'value': celular_fam_val
      });

      newRow(table, [button, relacion, nombre, fecha_nacimiento, ocupacion, telefono, celular],
        `row-familia-${index_familia}`);
      index_familia++;
    };
    $('#addFamilia').click(() => add_familia());
    if (old_familiares != []) {
      old_familiares.map(item => {
        add_familia(item.relacion, item.nombre_fam, item.fecha_nacimiento_fam, item.ocupacion, item.telefono_fam, item
          .celular_fam);
      });
    }
  </script>
@endsection
