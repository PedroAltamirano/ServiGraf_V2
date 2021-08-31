require("./bootstrap");
require("jquery");
import "popper.js";
import "animate.css";

require("select2/dist/js/select2.min.js");
$.fn.select2.defaults.set("theme", "bootstrap4");

require("dropify/dist/js/dropify.min.js");

require("chart.js/dist/Chart.js");

window.Swal = require('sweetalert2');
window.swal = function(title, mssg, icon){
  Swal.fire({
    title: title,
    text: mssg,
    icon: icon,
    width: '25em'
  })
}

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
// require("../../resources/js/helpers.js");

