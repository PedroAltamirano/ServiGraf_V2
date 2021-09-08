/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/helpers.js":
/*!*********************************!*\
  !*** ./resources/js/helpers.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

if (document.querySelector(".dropify")) {
  $(".dropify").dropify({
    tpl: {
      wrap: '<div class="dropify-wrapper user"></div>',
      loader: '<div class="dropify-loader"></div>',
      message: '<div class="dropify-message"><span class="file-icon"></span> <p class="text-uppercase">Arrastra y suelta aquí para subir</p><button type="button" class="mt-3 cs-file-drop-btn btn btn-primary btn-sm">O seleccione archivo</button></div>',
      preview: '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message fs-12">Arrastra y suelta o haz clic para reemplazar</p></div></div></div>',
      filename: '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
      clearButton: '<button type="button" class="dropify-clear">Quitar</button>',
      errorLine: '<p class="dropify-error">{{ error }}</p>',
      errorsContainer: '<div class="dropify-errors-container"><ul></ul></div>'
    },
    error: {
      fileSize: "El tamaño del archivo es demasiado grande ({{ value }}B máximo).",
      minWidth: "El ancho de la imagen es demasiado pequeño ({{ value }}}px mínimo).",
      maxWidth: "El ancho de la imagen es demasiado grande ({{ value }}}px máximo).",
      minHeight: "La altura de la imagen es demasiado pequeña ({{ value }}}px mínimo).",
      maxHeight: "La altura de la imagen es demasiado grande ({{ value }}px máximo).",
      imageFormat: "El formato de imagen no está permitido ({{ value }} solamente)."
    },
    messages: {
      "default": "Arrastre y suelte un archivo aquí o haga clic en",
      replace: "Arrastra y suelta o haz clic para reemplazar",
      remove: "Eliminar",
      error: "Tenemos problemas con a imagen a cargar"
    }
  });
}

$(function () {
  return $('[data-toggle="tooltip"]').tooltip();
});
$(document).on("change", ".fixFloat", function () {
  $(this).val(parseFloat($(this).val()).toFixed(2));
});
$(document).on("click", ".removeRow", function () {
  var button_id = $(this).attr("id");
  $("#row-" + button_id + "").remove();
});

window.newRow = function newRow($table, cols, col_id) {
  $row = $("<tr/>", {
    id: col_id
  });

  for (var indx = 0; indx < cols.length; indx++) {
    $col = $("<td/>");
    $col.append(cols[indx]);
    $row.append($col);
  }

  $table.append($row);
};

$("#print").on("click", function (event) {
  // console.log("printing");
  var target = "#" + $("#print").data("target");
  $(".select2Class").select2("destroy");
  $(target).print();
  $(".select2Class").select2();
});
$("body").delegate("#printer", "click", function () {
  // console.log("printering");
  var target = "#" + $("#printer").data("target");
  $(target).print();
});
$(".select2Class").select2({
  width: '100%'
});

function getModal(pedido_id) {
  axios.post('/pedido/modal', {
    pedido_id: pedido_id
  }).then(function (res) {
    var data = res.data;
    console.log(data);
    $("#modalPedidoDiv").html(data);
    $("#tinta_tiro").select2({
      maximumSelectionLength: 4
    });
    $("#tinta_retiro").select2({
      maximumSelectionLength: 4
    });
    $("#modalPedido").modal("show");
  })["catch"](function (error) {
    console.log(error);
  });
}

$("body").delegate(".verPedido", "click", function () {
  // $(".verPedido").on("click", function() {
  var pedido_id = $(this).data("pedido_id");
  $("#modalPedidoDiv").empty(); // debugger;

  getModal(pedido_id);
});

window.add_error = function (mssg, type) {
  var alert = "<div class=\"alert alert-".concat(type, "\" role=\"alert\">\n      ").concat(mssg, "&nbsp&nbsp\n      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n      <span aria-hidden=\"true\">&times;</span></button>\n    </div>");
  $('#errorDiv').append(alert);
};

window.change_select = function (selector, val) {
  return $(selector).val(val).trigger("change.select2");
};

$('.modal').on('show.bs.modal', function () {
  $('.modal').modal('hide');
}); // Submit for blue board component

$('#formSubmit').click(function () {
  $('#form').submit();
}); // Submit for modals and others

$('.submitbtn').click(function () {
  var form = $(this).data('form');
  $(form).submit();
});

/***/ }),

/***/ 1:
/*!***************************************!*\
  !*** multi ./resources/js/helpers.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Volumes/Pedro/WORK/ServiGraf_V2/resources/js/helpers.js */"./resources/js/helpers.js");


/***/ })

/******/ });