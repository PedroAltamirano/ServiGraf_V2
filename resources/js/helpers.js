const { default: Swal } = require("sweetalert2");

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

$(document).on("change", ".fixFloat", function() {
  $(this).val(parseFloat($(this).val()).toFixed(2));
});

$(document).on("click", ".removeRow", function() {
  var button_id = $(this).attr("id");
  $("#row-" + button_id + "").remove();
});

window.newRow = function newRow($table, cols, col_id) {
  $row = $("<tr/>", { id: col_id });
  for (let indx = 0; indx < cols.length; indx++) {
    $col = $("<td/>");
    $col.append(cols[indx]);
    $row.append($col);
  }
  $table.append($row);
};

$("#print").on("click", event => {
  // console.log("printing");
  let target = "#" + $("#print").data("target");
  $(".select2Class").select2("destroy");
  $(target).print();
  $(".select2Class").select2();
});

$("body").delegate("#printer", "click", function() {
  // console.log("printering");
  let target = "#" + $("#printer").data("target");
  $(target).print();
});

$(".select2Class").select2({
  width: '100%',
});

function getModal(pedido_id) {
  axios.post('/pedido/modal', {
    pedido_id: pedido_id
  }).then(res => {
    let data = res.data;
    console.log(data);
    $("#modalPedidoDiv").html(data);
    $("#tinta_tiro").select2({
      maximumSelectionLength: 4
    });
    $("#tinta_retiro").select2({
      maximumSelectionLength: 4
    });
    $("#modalPedido").modal("show");
  }).catch((jqXhr, textStatus, errorThrown) => {
    console.log(errorThrown);
  })
}

$("body").delegate(".verPedido", "click", function() {
  // $(".verPedido").on("click", function() {
  let pedido_id = $(this).data("pedido_id");
  $("#modalPedidoDiv").empty();
  // debugger;
  getModal(pedido_id);
});

function swal(title, mssg, icon){
  Swal.fire({
    title: title,
    text: mssg,
    icon: icon,
    width: '25em'
  })
}
