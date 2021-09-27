require("./bootstrap");

require("owl.carousel");

window.Swal = require("sweetalert2");
window.swal = (title, mssg, icon) => {
  Swal.fire({
    title: title,
    text: mssg,
    icon: icon,
    width: "25em"
  });
};
