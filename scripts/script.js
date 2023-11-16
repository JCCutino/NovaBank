 // Mostrar la card de Inicio de Sesión al cargar la página
 document.getElementById('loginCard').style.display = 'block';

 // Función para mostrar la card de Registro y ocultar la de Inicio de Sesión
 function mostrarRegistro() {
     document.getElementById('loginCard').style.display = 'none';
     document.getElementById('registroCard').style.display = 'block';
 }

 // Función para mostrar la card de Inicio de Sesión y ocultar la de Registro
 function mostrarInicioSesion() {
     document.getElementById('registroCard').style.display = 'none';
     document.getElementById('loginCard').style.display = 'block';
 }

