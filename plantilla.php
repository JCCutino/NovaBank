<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="estilo/style_plantilla.css">
 
</head>

<body>
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
    <button type="button" class="btn-close d-lg-none flecha-cerrar" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">

    <div class="enlaces">
      <a href="#" class="morado">Inicio</a>
      <a href="#">Pagos</a>
      <a href="#">Transacciones</a>
      <a href="#">Préstamos</a>
      <a href="#">Datos</a>
      <a href="#">Ajustes</a>
      
    </div>
  </div>
</div>

 <div class="container-fluid">
    <div class="row">
     
    <div class="col-md-8 offset-md-2 main-content">
        <h1>Contenido Principal</h1>
        <p>Este es el contenido principal de la página.</p>
      </div>

    
      <div class="col-md-4 sidebar">
        <h2>Aside</h2>
        <p>Este es el contenido del aside en la derecha.</p>
      </div>
    </div>
  </div>

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script src="scripts/scripts_plantilla.js"></script>
</body>

</html>