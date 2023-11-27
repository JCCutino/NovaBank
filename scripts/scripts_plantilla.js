var anchoLimite = 1200; 
var accionSuperiorEjecutada = false; 
var accionInferiorEjecutada = false; 

var offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasScrolling'));

function abrirOffcanvas() {
    offcanvas.show();
  }

  function cerrarOffcanvas() {
    offcanvas.hide();
  }

window.addEventListener('resize', function() {
    var anchoVentana = window.innerWidth;

    if (anchoVentana <= anchoLimite && !accionSuperiorEjecutada) {
        
        cerrarOffcanvas();
        accionSuperiorEjecutada = true;
        accionInferiorEjecutada = false;
    } else if (anchoVentana > anchoLimite && !accionInferiorEjecutada) {
        

        abrirOffcanvas();
        accionInferiorEjecutada = true;
        accionSuperiorEjecutada = false;
    }
});

