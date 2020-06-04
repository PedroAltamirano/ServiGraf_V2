<template>
  <div class="row">
      <h5 class="text-muted col-4">Modulos del perfil</h5>
      <h6 class="text-muted col-2 d-flex justify-content-end">
        <i class="fas fa-eye"></i>&nbsp;
        <span class="d-none d-md-inline">Ver</span>
      </h6>
      <h6 class="text-muted col-2 d-flex justify-content-end">
        <i class="fas fa-plus"></i>&nbsp;
        <span class="d-none d-md-inline">Crear</span>
      </h6>
      <h6 class="text-muted col-2 d-flex justify-content-end">
        <i class="fas fa-edit"></i>&nbsp;
        <span class="d-none d-md-inline">Modificar</span>
      </h6>
      <h6 class="text-muted col-2 d-flex justify-content-end">
        <i class="fas fa-times"></i>&nbsp;
        <span class="d-none d-md-inline">Eliminar</span>
      </h6>
    </div>

    <div class="form-row d-flex align-items-center">
      <h6 :class="col-4 m-0 {{ item.principal?'':'pl-4' }}">{{ item.nombre }}</h6>
      <div class="custom-control custom-switch col-2 d-flex justify-content-end">
        <input type="checkbox" class="custom-control-input" id="{{ item.id }}-1">
        <label class="custom-control-label" for="{{ item.id }}-1"></label>
      </div>
      <div class="custom-control custom-switch col-2 d-flex justify-content-end">
        <input type="checkbox" class="custom-control-input" id="{{ item.id }}-2">
        <label class="custom-control-label" for="{{ item.id }}-2"></label>
      </div>
      <div class="custom-control custom-switch col-2 d-flex justify-content-end">
        <input type="checkbox" class="custom-control-input" id="{{ item.id }}-3">
        <label class="custom-control-label" for="{{ item.id }}-3"></label>
      </div>
      <div class="custom-control custom-switch col-2 d-flex justify-content-end">
        <input type="checkbox" class="custom-control-input" id="{{ item.id }}-4">
        <label class="custom-control-label" for="{{ item.id }}-4"></label>
      </div>
    </div>
</template>

<script>
  $('.custom-control-input').change(function(){
    var id = this.id.split('-');
    if($(this).is(":checked")){
      for(var i=1; i<id[1]; i++){
        var sw = '#' + id[0].toString() + '-' + i.toString();
        $(sw).prop("checked", true);
      }
    } else {
      for(var i=4; i>id[1]; i--){
        var sw = '#' + id[0].toString() + '-' + i.toString();
        $(sw).prop("checked", false);
      }
    }
  });
</script>