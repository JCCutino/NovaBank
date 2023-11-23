var anchoLimite = 600; 
var accionSuperiorEjecutada = false; 
var accionInferiorEjecutada = false; 

function abrirOffcanvas() {
    
    var offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasScrolling'));
  
    offcanvas.show();
  }


window.addEventListener('resize', function() {
    var anchoVentana = window.innerWidth;

    if (anchoVentana <= anchoLimite && !accionSuperiorEjecutada) {
        
        accionSuperiorEjecutada = true;
        accionInferiorEjecutada = false;
    } else if (anchoVentana > anchoLimite && !accionInferiorEjecutada) {
        

        abrirOffcanvas();
        accionInferiorEjecutada = true;
        accionSuperiorEjecutada = false;
    }
});

