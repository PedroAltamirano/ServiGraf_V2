<section id="documento">
  <h6 class="font-weight-bold">Documentos entregados</h6>
  <hr>
  <div class="form-row">

    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Solicitud Empleo</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('solicitud_empleo') is-invalid @enderror"
          id="solicitud_empleo" name="solicitud_empleo"
          {{ old('solicitud_empleo', $docs->solicitud_empleo) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="solicitud_empleo"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Curriculum Vitae</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('curriculum_vitae') is-invalid @enderror"
          id="curriculum_vitae" name="curriculum_vitae"
          {{ old('curriculum_vitae', $docs->curriculum_vitae) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="curriculum_vitae"></label>
      </div>
    </div>

    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Cedula Identidad</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('cedula_identidad') is-invalid @enderror"
          id="cedula_identidad" name="cedula_identidad"
          {{ old('cedula_identidad', $docs->cedula_identidad) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="cedula_identidad"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Papeleta Votacion</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('papeleta_votacion') is-invalid @enderror"
          id="papeleta_votacion" name="papeleta_votacion"
          {{ old('papeleta_votacion', $docs->papeleta_votacion) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="papeleta_votacion"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Record Policial</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('record_policial') is-invalid @enderror"
          id="record_policial" name="record_policial"
          {{ old('record_policial', $docs->record_policial) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="record_policial"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Libreta Militar</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('libreta_militar') is-invalid @enderror"
          id="libreta_militar" name="libreta_militar"
          {{ old('libreta_militar', $docs->libreta_militar) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="libreta_militar"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Certificado Escolar</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('certificado_escolar') is-invalid @enderror"
          id="certificado_escolar" name="certificado_escolar"
          {{ old('certificado_escolar', $docs->certificado_escolar) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="certificado_escolar"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Certificado Colegio</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('certificado_colegio') is-invalid @enderror"
          id="certificado_colegio" name="certificado_colegio"
          {{ old('certificado_colegio', $docs->certificado_colegio) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="certificado_colegio"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Certificado Universitario</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('certificado_universitario') is-invalid @enderror"
          id="certificado_universitario" name="certificado_universitario"
          {{ old('certificado_universitario', $docs->certificado_universitario) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="certificado_universitario"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Certificado Otros</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('certificado_otros') is-invalid @enderror"
          id="certificado_otros" name="certificado_otros"
          {{ old('certificado_otros', $docs->certificado_otros) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="certificado_otros"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Referencia Personales</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('referencia_personales') is-invalid @enderror"
          id="referencia_personales" name="referencia_personales"
          {{ old('referencia_personales', $docs->referencia_personales) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="referencia_personales"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Referencia Empleos</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('referencia_empleos') is-invalid @enderror"
          id="referencia_empleos" name="referencia_empleos"
          {{ old('referencia_empleos', $docs->referencia_empleos) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="referencia_empleos"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Certificado Medico</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('certificado_medico') is-invalid @enderror"
          id="certificado_medico" name="certificado_medico"
          {{ old('certificado_medico', $docs->certificado_medico) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="certificado_medico"></label>
      </div>
    </div>

    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Contrato Trabajo</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('contrato_trabajo') is-invalid @enderror"
          id="contrato_trabajo" name="contrato_trabajo"
          {{ old('contrato_trabajo', $docs->contrato_trabajo) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="contrato_trabajo"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Aviso Entrada</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('aviso_entrada') is-invalid @enderror"
          id="aviso_entrada" name="aviso_entrada"
          {{ old('aviso_entrada', $docs->aviso_entrada) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="aviso_entrada"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Aviso Salida</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('aviso_salida') is-invalid @enderror"
          id="aviso_salida" name="aviso_salida"
          {{ old('aviso_salida', $docs->aviso_salida) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="aviso_salida"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Acta Finiquito</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('acta_finiquito') is-invalid @enderror"
          id="acta_finiquito" name="acta_finiquito"
          {{ old('acta_finiquito', $docs->acta_finiquito) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="acta_finiquito"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Recibo Pago Acta Fini</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('recibo_pago_acta_fini') is-invalid @enderror"
          id="recibo_pago_acta_fini" name="recibo_pago_acta_fini"
          {{ old('recibo_pago_acta_fini', $docs->recibo_pago_acta_fini) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="recibo_pago_acta_fini"></label>
      </div>
    </div>
  </div>
</section>
