$(function () {
  /* ------------------------------------
  *1. Configuración de RdNavbar 
  -------------------------------------*/
  AOS.init();

  $(document).ready(function () {
    $("#example").DataTable();
  });

  rdNav = $(".rd-navbar");

  rdNav.RDNavbar({
    stickUpClone: false,
    stickUpOffset: 47,

    responsive: {
      0: {
        layout: "rd-navbar-fixed",
      },
      992: {
        layout: "rd-navbar-static",
      },
      1200: {
        layout: "rd-navbar-static",
      },
    },
  });

 
});
