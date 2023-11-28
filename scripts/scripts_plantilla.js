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

  function añadirClase() {
    var elemento = document.getElementById("saltoSeccion1");
    var elemento2 = document.getElementById("saltoSeccion2");
    if (!elemento) {
      console.error("Elemento no encontrado con ID: " + "saltoSeccion1");
      return;
  }
    elemento.classList.remove("col-lg-6");
    elemento2.classList.remove("col-lg-6");
    elemento.classList.add("col-lg-12");
    elemento2.classList.add("col-lg-12");
    
}

function quitarClase() {
  var elemento = document.getElementById("saltoSeccion1");
  var elemento2 = document.getElementById("saltoSeccion2");

  if (!elemento) {
    console.error("Elemento no encontrado con ID: " + "saltoSeccion1");
    return;
}
  elemento.classList.remove("col-lg-12");
  elemento2.classList.remove("col-lg-12");
  elemento.classList.add("col-lg-6");
  elemento2.classList.add("col-lg-6");
}

window.addEventListener('resize', function() {
    var anchoVentana = window.innerWidth;

    if (anchoVentana <= anchoLimite && !accionSuperiorEjecutada) {
        
        quitarClase();
        cerrarOffcanvas();
        accionSuperiorEjecutada = true;
        accionInferiorEjecutada = false;
    } else if (anchoVentana > anchoLimite && !accionInferiorEjecutada) {
       
      añadirClase();
      abrirOffcanvas();
        accionInferiorEjecutada = true;
        accionSuperiorEjecutada = false;
    }
});

function rotateCard(card) {
  const cardImage = document.getElementById('cardImage');
  
  card.classList.toggle('is-flipped');
  
  if (card.classList.contains('is-flipped')) {
      cardImage.src = 'img/Tarjeta_Reverso.PNG'; 
  } else {
      cardImage.src = 'img/Tarjeta_Anverso.PNG';  
  }
}

