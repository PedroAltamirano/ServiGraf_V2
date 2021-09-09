require("./bootstrap");
require("jquery");
import "popper.js";
import "animate.css";

require('owl.carousel');

window.Swal = require('sweetalert2');
window.swal = function(title, mssg, icon){
  Swal.fire({
    title: title,
    text: mssg,
    icon: icon,
    width: '25em'
  })
}

require("select2/dist/js/select2.min.js");
$.fn.select2.defaults.set("theme", "bootstrap");

require("dropify/dist/js/dropify.min.js");

require("chart.js");

// import "jszip";
// import "pdfmake";
import "datatables.net-bs4";
// import "datatables.net-keytable-bs4";
// import "datatables.net-rowgroup-bs4";
import "datatables.net-responsive-bs4";
// import "datatables.net-fixedheader-bs4";
// import "datatables.net-buttons-bs4";
// import "datatables.net-buttons/js/buttons.html5.js";
// import "datatables.net-buttons/js/buttons.print.js";

require("../../resources/js/sb-admin-2.min.js");

$('.confirmModal').on('click', function(){
  let button = $(this);
  $('#confirmForm').attr('action', button.data('route'));
});

$('.deleteModal').on('click', function(){
  let button = $(this);
  $('#deleteText').html(button.data('text'));
  $('#deleteForm').attr('action', button.data('route'));
});
