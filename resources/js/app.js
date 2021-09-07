require("./bootstrap");
require("jquery");
import "popper.js";
import "animate.css";

require('owl.carousel/dist/owl.carousel');

window.Swal = require('sweetalert2');
window.swal = function(title, mssg, icon){
  Swal.fire({
    title: title,
    text: mssg,
    icon: icon,
    width: '25em'
  })
}
