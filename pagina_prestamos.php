<?php
include 'funcionalidades/obtenerDatos.php';
include 'funcionalidades/mostrarPrestamosCliente.php';
$resultadoPrestamo = json_encode(isset($_SESSION['resultadoPrestamo']) && $_SESSION['resultadoPrestamo']);
$resultadoPagoDeuda = json_encode(isset($_SESSION['resultadoPagoDeuda']) && $_SESSION['resultadoPagoDeuda']);
?>

<!doctype html>
<html lang="en">

<head>
  <title>NovaBank - Inicio</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

  <link rel="stylesheet" href="css/styles.css">

</head>

<body class="body_plantilla">
  <header>
    <!-- place navbar here -->
  </header>
  <main>

  <?php include 'componentes/modales_errores_prestamos.php';?>
  <?php include 'componentes/modales_pago_prestamos.php';?>

   <!-- Modal Prestamo -->
<div class="modal fade" id="detalleModal" tabindex="-1" aria-labelledby="detalleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalleModalLabel">Detalles del Préstamo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detalleModalBody">

                
            </div>
            <div class="modal-footer">
               
              </div>
        </div>
    </div>
</div>

  <div class="modal fade" id="modalIngreso" tabindex="-1" aria-labelledby="tituloModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Ingresar Cantidad Monetaria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="funcionalidades/ingresarDinero.php" method="post">
          <div class="mb-3">
            <label for="cantidadIngreso" class="form-label">Cantidad Monetaria:</label>
            <input type="number" step="any" class="form-control" name="cantidadIngreso" id="cantidadIngreso" placeholder="Ingrese la cantidad" title="Ingrese un número con hasta dos decimales" required>
            <small id="cantidadHelp" class="form-text text-muted">Ingrese un número con hasta dos decimales.</small>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Aceptar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


    <div class="boton-fijo">
      <button class="btn btn-primary rounded-circle bg-color-morado" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
        <i class="bi bi-list"></i>
      </button>
    </div>




    <div class="offcanvas offcanvas-start show" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
      <div class="offcanvas-header">
        <img src="img/Logo_NovaBank_Blanco.png" class="logo" alt="Logotipo">
        <button type="button" class="btn-close elemento-oculto flecha-cerrar" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">

        <div class="enlaces">
          <a href="pagina_principal.php">Inicio</a>
          <a href="pagina_pagos.php">Pagos</a>
          <a href="pagina_transacciones.php">Transacciones</a>
          <a href="pagina_prestamos.php" class="morado">Préstamos</a>
          <a href="pagina_datos.php">Datos</a>
          <a href="pagina_chat.php">Chat</a>

          <a href="funcionalidades/cerrarSesion.php" class="cerrar-sesion">Cerrar Sesión</a>

        </div>
      </div>
    </div>

    <div class="container-fluid ">
      <div class="row">


      <div class="col-lg-3 col-md-12  order-2 container-invisible"></div>
      
        <div class="col-lg-6 col-md-12 main-content order-2"  id="container-responsive">
        <div class="max-width-pagos">
    <h1 class="mt-3">Solicitud de Préstamo</h1>

    <form action="funcionalidades/solicitudPrestamo.php" method="post" class="text-center">
        <div class="form-group">
            <label for="concepto">Concepto del Préstamo:</label>
            <input type="text" class="form-control" id="conceptoPrestamo" name="conceptoPrestamo" placeholder="Introduce el concepto del préstamo" required>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad Solicitada:</label>
            <input type="number" class="form-control" id="cantidadSolicitada" name="cantidadSolicitada" placeholder="Introduce la cantidad solicitada" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Enviar Solicitud</button>
    </form>
</div>


        <h1 class="mt-5">Prestamos Pendientes</h1>
        <?php mostrarPrestamosPendientes($conn); ?>
        
        <h1 class="mt-3">Prestamos Aceptados</h1>
        <?php mostrarPrestamosAceptados($conn)  ?>

        </div>

        <div class="col-lg-3 col-md-12 sidebar order-1">
          <div class="container-fluid mt-3">
            <div class="row justify-content-center">
              <div class="col-2">
                <img src="img/fp/<?php echo $ruta ?>" alt="Imagen de perfil" class="rounded-circle img-fluid border imagen-perfil">
              </div>
              <div class="col-8 d-flex align-items-center">
                <h4 class="nombre-usuario"><?php echo $nombreCompleto; ?></h4>
              </div>
              <div class="col-2">
                <img src="img/Campana.png" alt="Notificaciones" class="rounded-circle img-fluid imagen-pequena">
              </div>
            </div>

            <div class="row justify-content-center g-2 d-flex align-content-center align-items-center">
              <div class="col-lg-12 col-md-6 offset-lg-0 offset-md-3 mx-auto justify-content-center align-items-center d-flex" id="saltoSeccion1">
                <section class="saldo_cuenta_card">
                  <div class="titulo-card">Saldo de Cuenta</div>
                  <div class="saldo-card"><?php echo $saldo ?></div>
                  <button class="boton-recargar" data-bs-toggle="modal" data-bs-target="#modalIngreso">Recargar</button>
                </section>
              </div>

              <div class="col-lg-12 col-md-6 offset-lg-0 offset-md-3 mx-auto justify-content-center d-flex mt-3" id="saltoSeccion2">

                <div class="rotating-card" onclick="rotateCard(this)">
                  <img id="cardImage" src="img/Tarjeta_Anverso.PNG" alt="Imagen de la tarjeta" class="img-fluid">
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script src="scripts/scripts_plantilla.js"></script>

  <script>
function mostrarDetalles(idPrestamo) {
    var deuda = document.querySelector('[data-id="' + idPrestamo + '"]').getAttribute('data-deuda');
   
    document.getElementById('detalleModalLabel').innerHTML = 'Detalles del Préstamo ID: ' + idPrestamo;
    document.getElementById('detalleModalBody').innerHTML = `
        <form id="detalleForm"  method="post" action="funcionalidades/pagarPrestamo.php">
            <input type="hidden" id="idPrestamoInput" name="idPrestamo" value="${idPrestamo}">
            <input type="hidden" id="deudaInput" name="deuda" value="${deuda}">
            <p><strong>Deuda:</strong> ${deuda}</p>
            

            <div class="mb-3">
                <label for="cantidadPago" class="form-label">Cantidad a Pagar</label>
                <input type="number" class="form-control" id="cantidadPago" name="cantidadPago" required>
            </div>

          

            <!-- Agrega un botón de submit para enviar el formulario -->
            <button type="submit" class="btn btn-primary">Realizar Pago</button>
        </form>
    `;
}

  </script>

  <script>
document.addEventListener('DOMContentLoaded', function () {
    <?php
    $resultadoPrestamo = isset($_SESSION['resultadoPrestamo']) ? $_SESSION['resultadoPrestamo'] : '';
    ?>

    var resultadoPrestamo = "<?php echo $resultadoPrestamo; ?>";
    
   switch (resultadoPrestamo) {
    case 'errorIBAN':
        mostrarModal('errorIbanModal');
        break;
    case 'errorBaseDatos':
        mostrarModal('errorBaseDatosModal');
        break;
    case 'cantidadInvalida':
        mostrarModal('cantidadInvalidaModal');
        break;
    case 'saldoInsuficiente':
        mostrarModal('saldoInsuficienteModal');
        break;
    case 'prestamoPendiente':
        mostrarModal('prestamoPendienteModal');
        break;
    case 'errorMenorEdad':
        mostrarModal('errorMenorEdadModal');
        break;
    case 'errorEdadDesconocida':
        mostrarModal('errorEdadDesconocidaModal');
        break;
    case 'exito':
        mostrarModal('prestamoExitosoModal');
        break;
}
});


function mostrarModal(modalId) {
    var modal = new bootstrap.Modal(document.getElementById(modalId));
    modal.show();
    <?php $_SESSION['resultadoPrestamo'] = null; ?>
   
}

 </script>

 
<script>
document.addEventListener('DOMContentLoaded', function () {
    <?php
    $resultadoPagoDeuda = isset($_SESSION['resultadoPagoDeuda']) ? $_SESSION['resultadoPagoDeuda'] : '';
    ?>

    var resultadoPagoDeuda = "<?php echo $resultadoPagoDeuda; ?>";
    switch (resultadoPagoDeuda) {
    case 'cantidadInvalida':
        mostrarModal('cantidadInvalida');
        break;
    case 'prestamoNoEncontrado':
        mostrarModal('prestamoNoEncontradoModal');
        break;
    case 'deudaInsuficiente':
        mostrarModal('deudaInsuficienteModal');
        break;
    case 'ibanNoEncontrado':
        mostrarModal('ibanNoEncontradoModal');
        break;
    case 'saldoInsuficiente':
        mostrarModal('saldoInsuficienteModal');
        break;
    case 'errorBaseDatosPrestamo':
        mostrarModal('errorBaseDatosPrestamoModal');
        break;
    case 'exito':
        mostrarModal('exitoModal');
        break;
}
});


function mostrarModal(modalId) {
    var modal = new bootstrap.Modal(document.getElementById(modalId));
    modal.show();
    <?php $_SESSION['resultadoPagoDeuda'] = null; ?>
   
}

 </script>

</body>

</html>