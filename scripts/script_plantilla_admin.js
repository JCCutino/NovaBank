let anchoLimite = 1600; 
let accionSuperiorEjecutada = false; 
let accionInferiorEjecutada = false; 

let offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasScrolling'));

function ocultarBotonFijo(ocultar) {
  let botonFijo = document.querySelector('.boton-fijo');

  if (ocultar) {
    botonFijo.style.display = 'none';
  } else {
    botonFijo.style.display = 'block';
  }
}
function abrirOffcanvas() {
    offcanvas.show();
  }

  function cerrarOffcanvas() {
    offcanvas.hide();
  }

  function añadirClase() {
    let elemento = document.getElementById("saltoSeccion1");
    let elemento2 = document.getElementById("saltoSeccion2");

    let elemento3 = document.getElementById("container-responsive");
    if (!elemento) {
      console.error("Elemento no encontrado con ID: " + "saltoSeccion1");
      return;
  }
    elemento.classList.remove("col-lg-6");
    elemento2.classList.remove("col-lg-6");
    elemento3.classList.remove("col-lg-12");

    elemento.classList.add("col-lg-12");
    elemento2.classList.add("col-lg-12");
    elemento3.classList.add("col-lg-6");
    
}

function quitarClase() {
  let elemento = document.getElementById("saltoSeccion1");
  let elemento2 = document.getElementById("saltoSeccion2");

  let elemento3 = document.getElementById("container-responsive");
  if (!elemento) {
    console.error("Elemento no encontrado con ID: " + "saltoSeccion1");
    return;
}
  elemento.classList.remove("col-lg-12");
  elemento2.classList.remove("col-lg-12");
  elemento3.classList.remove("col-lg-6");
  elemento.classList.add("col-lg-6");
  elemento2.classList.add("col-lg-6");
  elemento3.classList.add("col-lg-12");
}

function ajustarVentana() {
  let anchoVentana = window.innerWidth;

  if (anchoVentana <= anchoLimite && !accionSuperiorEjecutada) {
      quitarClase();
      cerrarOffcanvas();
      accionSuperiorEjecutada = true;
      accionInferiorEjecutada = false;
      ocultarBotonFijo(false);

  } else if (anchoVentana > anchoLimite && !accionInferiorEjecutada) {
      añadirClase();
      abrirOffcanvas();
      accionInferiorEjecutada = true;
      accionSuperiorEjecutada = false;
      ocultarBotonFijo(true);

  }
}


window.addEventListener('resize', ajustarVentana);


document.addEventListener('DOMContentLoaded', ajustarVentana);

function rotateCard(card) {
    const cardImage = document.getElementById('cardImage');
    
    card.classList.toggle('is-flipped');
    
    if (card.classList.contains('is-flipped')) {
        cardImage.src = '../img/Tarjeta_Reverso.PNG'; 
    } else {
        cardImage.src = '../img/Tarjeta_Anverso.PNG';  
    }
  }
  