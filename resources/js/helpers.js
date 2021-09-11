if (document.querySelector(".dropify")) {
  $(".dropify").dropify({
    tpl: {
      wrap: '<div class="dropify-wrapper user"></div>',
      loader: '<div class="dropify-loader"></div>',
      message:
        '<div class="dropify-message"><span class="file-icon"></span> <p class="text-uppercase">Arrastra y suelta aquí para subir</p><button type="button" class="mt-3 cs-file-drop-btn btn btn-primary btn-sm">O seleccione archivo</button></div>',
      preview:
        '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message fs-12">Arrastra y suelta o haz clic para reemplazar</p></div></div></div>',
      filename:
        '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
      clearButton:
        '<button type="button" class="dropify-clear">Quitar</button>',
      errorLine: '<p class="dropify-error">{{ error }}</p>',
      errorsContainer: '<div class="dropify-errors-container"><ul></ul></div>'
    },
    error: {
      fileSize:
        "El tamaño del archivo es demasiado grande ({{ value }}B máximo).",
      minWidth:
        "El ancho de la imagen es demasiado pequeño ({{ value }}}px mínimo).",
      maxWidth:
        "El ancho de la imagen es demasiado grande ({{ value }}}px máximo).",
      minHeight:
        "La altura de la imagen es demasiado pequeña ({{ value }}}px mínimo).",
      maxHeight:
        "La altura de la imagen es demasiado grande ({{ value }}px máximo).",
      imageFormat:
        "El formato de imagen no está permitido ({{ value }} solamente)."
    },
    messages: {
      default: "Arrastre y suelte un archivo aquí o haga clic en",
      replace: "Arrastra y suelta o haz clic para reemplazar",
      remove: "Eliminar",
      error: "Tenemos problemas con a imagen a cargar"
    }
  });
}

$(() => $('[data-toggle="tooltip"]').tooltip());

$(document).on("change", ".fixFloat", event => {
  $(event.target).val(parseFloat($(event.target).val()).toFixed(4));
});

$(document).on("click", ".removeRow", event => {
  var button_id = $(event.target).attr("id");
  $(`#row-${button_id}`).remove();
});

window.newRow = ($table, cols, col_id) => {
  $row = $("<tr/>", { id: col_id });
  for (let indx = 0; indx < cols.length; indx++) {
    $col = $("<td/>");
    $col.append(cols[indx]);
    $row.append($col);
  }
  $table.append($row);
};

$("#print").click(event => {
  let target = "#" + $("#print").data("target");
  $(".select2Class").select2("destroy");
  $(target).print();
  $(".select2Class").select2();
});

$("body").delegate("#printer", "click", () => {
  let target = "#" + $("#printer").data("target");
  $(target).print();
});

$(".select2Class").select2({
  width: '100%',
});

window.add_error = (mssg, type) => {
  let alert = `<div class="alert alert-${type}" role="alert">
      ${mssg}&nbsp&nbsp
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
    </div>`;
  $('#errorDiv').append(alert);
}

window.change_select = (selector, val) => $(selector).val(val).trigger("change.select2");

$('.modal').on('show.bs.modal', () => $('.modal').modal('hide'));

// Submit for blue board component
$('#formSubmit').click(() => $('#form').submit());

// Submit for modals and others
$('.submitbtn').click(event => {
  let form = $(event.target).data('form');
  $(form).submit();
});
