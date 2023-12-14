<?php
include '../funcionalidades/obtenerDatos.php';
include '../funcionalidades/comprobarDatosAdmin.php';
 include '../funcionalidades/seguridadSesion.php';

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

  <link rel="stylesheet" href="../css/styles.css">

</head>

<body class="body_plantilla">
  <header>
    <!-- place navbar here -->
  </header>
  <main>

    <div class="modal fade" id="modalIngreso" tabindex="-1" aria-labelledby="tituloModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tituloModal">Ingresar Cantidad Monetaria</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="../funcionalidades/ingresarDinero.php" method="post">
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
        <img src="../img/Logo_NovaBank_Blanco.png" class="logo" alt="Logotipo">
        <button type="button" class="btn-close elemento-oculto flecha-cerrar" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">

        <div class="enlaces">
          <a href="pagina_principal_admin.php">Inicio</a>
          <a href="pagina_pagos_admin.php">Pagos</a>
          <a href="pagina_prestamos_admin.php">Préstamos</a>
          <a href="pagina_datos_admin.php"  class="morado">Datos</a>
          
          <a href="../funcionalidades/cerrarSesion.php" class="cerrar-sesion">Cerrar Sesión</a>

        </div>
      </div>
    </div>

    <div class="container-fluid ">
      <div class="row">


      <div class="col-lg-3 col-md-12  order-2 container-invisible" ></div>
      
        <div class="col-lg-6 col-md-12 main-content order-2"  id="container-responsive">

           <h2>Introduce la ID de la Persona</h2>

    <form action="../funcionalidades/obtenerDatosCompletosAdmin.php" method="post">
        <label for="idPersona">ID de Persona:</label>
        <input type="number" id="idPersona" name="idPersona" required>
        <br>
        <button type="submit">Buscar Persona</button>
    </form>

    
    <div class="container">
    <h2>Información de la Persona</h2>
    <?php if (isset($datosPersona)) : ?>
        <div class="table-responsive bg-white">
            <table class="table">
                <tr>
                    <td>Nombre:</td>
                    <td><?php echo $nombre; ?></td>
                </tr>
                <tr>
                    <td>Apellidos:</td>
                    <td><?php echo $apellidos; ?></td>
                </tr>
                <tr>
                    <td>DNI:</td>
                    <td><?php echo $dni; ?></td>
                </tr>
                <tr>
                    <td>Fecha de Nacimiento:</td>
                    <td><?php echo $fechaNacimiento; ?></td>
                </tr>
                <tr>
                    <td>Dirección:</td>
                    <td><?php echo $direccion; ?></td>
                </tr>
                <tr>
                    <td>Código Postal:</td>
                    <td><?php echo $codigoPostal; ?></td>
                </tr>
                <tr>
                    <td>Ciudad:</td>
                    <td><?php echo $ciudad; ?></td>
                </tr>
                <tr>
                    <td>Provincia:</td>
                    <td><?php echo $provincia; ?></td>
                </tr>
                <tr>
                    <td>País:</td>
                    <td><?php echo $pais; ?></td>
                </tr>
                <tr>
                    <td>Correo Electrónico:</td>
                    <td><?php echo $correoElectronico; ?></td>
                </tr>
                <tr>
                    <td>URL de Foto:</td>
                    <td><?php echo $urlFoto; ?></td>
                </tr>
            </table>
        </div>
    <?php else : ?>
        <p>Persona no encontrada</p>
    <?php endif; ?>

    <h2>Información de la Cuenta</h2>
<?php if (isset($datosCuenta)) : ?>
    <div class="table-responsive bg-white mt-3">
        <table class="table">
            <tr>
                <td>IBAN:</td>
                <td class="text-start"><?php echo $iban; ?></td>
            </tr>
            <tr>
                <td>Saldo:</td>
                <td class="text-start"><?php echo $saldo; ?></td>
            </tr>
            <tr>
                <td>Fecha de Apertura:</td>
                <td class="text-start"><?php echo $fechaApertura; ?></td>
            </tr>
            <tr>
                <td>ID de Persona (Cuenta):</td>
                <td class="text-start"><?php echo $idPersonaCuenta; ?></td>
            </tr>
        </table>
    </div>
<?php else : ?>
    <p>Cuenta no encontrada</p>
<?php endif; ?>
</div>


          
        </div>

        <div class="col-lg-3 col-md-12 sidebar order-1">
          <div class="container-fluid mt-3">
            <div class="row justify-content-center">
              <div class="col-2">
                <img src="../img/fp/foto_perfil.webp" alt="Imagen de perfil" class="rounded-circle img-fluid border imagen-perfil">
              </div>
              <div class="col-8 d-flex align-items-center">
                <h4 class="nombre-usuario"><?php echo $nombreCompleto; ?></h4>
              </div>
              <div class="col-2">
                <img src="../img/Campana.png" alt="Notificaciones" class="rounded-circle img-fluid imagen-pequena">
              </div>
            </div>

            <div class="row justify-content-center g-2 d-flex align-content-center align-items-center">
              <div class="col-lg-12 col-md-6 offset-lg-0 offset-md-3 mx-auto justify-content-center align-items-center d-flex" id="saltoSeccion1">
                <section class="saldo_cuenta_card">
                  <div class="titulo-card">Saldo de Cuenta</div>
                  <div class="saldo-card"><?php echo $saldo; ?> </div>
                  <button class="boton-recargar" data-bs-toggle="modal" data-bs-target="#modalIngreso">Recargar</button>
                </section>
              </div>

              <div class="col-lg-12 col-md-6 offset-lg-0 offset-md-3 mx-auto justify-content-center d-flex mt-3" id="saltoSeccion2">

                <div class="rotating-card" onclick="rotateCard(this)">
                  <img id="cardImage" src="../img/Tarjeta_Anverso.PNG" alt="Imagen de la tarjeta" class="img-fluid">
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../scripts/script_plantilla_admin.js"></script>
  <script src="../scripts/script_grafica.js"></script>
</body>

</html>