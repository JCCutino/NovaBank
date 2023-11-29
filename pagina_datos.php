<!doctype html>
<html lang="en">

<head>
  <title>NovaBank - Datos</title>
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
          <a href="pagina_prestamos.php">Préstamos</a>
          <a href="pagina_datos.php" class="morado">Datos</a>
          <a href="pagina_ajustes.php">Ajustes</a>

        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row justify-content-center text-center">

        <div class="col-md-8 main-content order-2">
          <h1>Contenido Principal</h1>
          <p>Este es el contenido principal de la página.</p>
        </div>

        <div class="col-md-4 sidebar order-1">
          <div class="container-fluid mt-3">
            <div class="row justify-content-center">
              <div class="col-2">
                <img src="img/foto_perfil.webp" alt="Imagen de perfil" class="rounded-circle img-fluid border imagen-perfil">
              </div>
              <div class="col-8 d-flex align-items-center">
                <h4 class="nombre-usuario">Nombre</h4>
              </div>
              <div class="col-2">
                <img src="img/Campana.png" alt="Notificaciones" class="rounded-circle img-fluid imagen-pequena">
              </div>
            </div>

            <div class="row justify-content-center g-2 d-flex align-content-center align-items-center">
              <div class="col-lg-12 col-md-6 offset-lg-0 offset-md-3 mx-auto justify-content-center align-items-center d-flex" id="saltoSeccion1">
                <section class="saldo_cuenta_card">
                  <div class="titulo-card">Saldo de Cuenta</div>
                  <div class="saldo-card">$500.00</div>
                  <button class="boton-recargar">Recargar</button>
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
</body>

</html>