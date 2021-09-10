require("./bootstrap");
require("jquery");
require("popper.js");

window.moment = require("moment");

require("owl.carousel");

window.Swal = require("sweetalert2");
window.swal = (title, mssg, icon) => {
  Swal.fire({
    title: title,
    text: mssg,
    icon: icon,
    width: '25em'
  })
}

require("select2")
$.fn.select2.defaults.set("theme", "bootstrap");

require("dropify");

require("chart.js");

// import "jszip";
// import "pdfmake";
require("datatables.net-bs4");
// import "datatables.net-keytable-bs4";
// import "datatables.net-rowgroup-bs4";
require("datatables.net-responsive-bs4");
// import "datatables.net-fixedheader-bs4";
// import "datatables.net-buttons-bs4";
// import "datatables.net-buttons/js/buttons.html5.js";
// import "datatables.net-buttons/js/buttons.print.js";

require("../../resources/js/sb-admin-2.min.js");

$('.confirmModal').click(() => {
  let button = $(this);
  $('#confirmForm').attr('action', button.data('route'));
});

$('.deleteModal').click(() => {
  let button = $(this);
  $('#deleteText').html(button.data('text'));
  $('#deleteForm').attr('action', button.data('route'));
});
