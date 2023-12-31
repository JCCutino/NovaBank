<?php session_start(); 
            $errorContrasena = json_encode(isset($_SESSION['contrasenaIncorrecta']) && $_SESSION['contrasenaIncorrecta']); 

            $errorCorreo = json_encode(isset($_SESSION['correoExistente']) && $_SESSION['correoExistente']); 
            ?>
<!doctype html>
<html lang="en">

<head>
  <title>NovaBank</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles_inicio.css">
    <script src="scripts/script.js"></script>
</head>

<body class="body_inicio">
  <header>
    <!-- place navbar here -->
  </header>
  <main>

  <div class="modal" tabindex="-1" role="dialog" id="contrasenaErrorModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error de inicio de sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Contraseña incorrecta. Inténtalo de nuevo.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="correoErrorModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error al registrar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Correo ya existente, parece que ya tienes una cuenta.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
    </div>

<!-- Card de Inicio de Sesión -->
<div id="loginCard" class="card">
    <img src="img/Logo_NovaBank_Blanco.png" alt="Logo de la empresa" class="logo">
    <form action="funcionalidades/logear.php" method="post">
    <div class="form-group form-group2">
        <input type="email" id="email" name="correo_login" placeholder=" ">
        <label for="email">Correo electrónico</label>
    </div>
    <div class="form-group">
        <input type="password" id="password" name="contrasena_login" placeholder=" ">
        <label for="password">Contraseña</label>
    </div>
    <button  type="submit" class="button">Iniciar sesión</button>
    </form>
    <p class="login-text"><a href="#" onclick="mostrarRegistro()">¿Aún no tienes cuenta? Regístrate</a></p>
</div>

<!-- Card de Registro -->
<div id="registroCard" class="card">
    <img src="img/Logo_NovaBank_Blanco.png" alt="Logo de la empresa" class="logo">
    <form action="funcionalidades/registrar.php" method="post">
        <div class="form-group">
            <input type="text" name="nombre" placeholder=" "  required>
            <label for="nombre">Nombre</label>
        </div>
        <div class="form-group">
            <input type="text" name="apellidos" placeholder=" "  required>
            <label for="apellidos">Apellidos</label>
        </div>
        <div class="form-group">
            <input type="text" name="dni" placeholder=" "  required>
            <label for="dni">DNI</label>
        </div>
        <div class="form-group">
            <input type="text" name="pais" placeholder=" "  required>
            <label for="pais">Pais</label>
        </div>
        <div class="form-group">
            <input type="email" name="correo_register" placeholder=" "required>
            <label for="email">Correo electrónico</label>

        </div>
        <div class="form-group">
            <input type="password" name="contrasena_register" placeholder=" "required>
            <label for="password">Contraseña</label>
        </div>
        <button type="submit" class="button">Registrarse</button>
    </form>
    <p class="login-text"><a href="#" onclick="mostrarInicioSesion()">¿Tienes cuenta? Iniciar sesión</a></p>
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

<script>
        document.addEventListener('DOMContentLoaded', function () {
           
            const contrasenaIncorrecta = <?php echo $errorContrasena; ?>;
            
            if (contrasenaIncorrecta) {
                var contrasenaModal = new bootstrap.Modal(document.getElementById('contrasenaErrorModal'));
                contrasenaModal.show();
                <?php 
                $_SESSION['contrasenaIncorrecta'] = false;
                ?>
            }
        });
    </script>

<script>
        document.addEventListener('DOMContentLoaded', function () {
           
            const correoExistente = <?php echo $errorCorreo; ?>;
            
            if (correoExistente) {
                var correoModal = new bootstrap.Modal(document.getElementById('correoErrorModal'));
                correoModal.show();
                <?php 
                $_SESSION['correoExistente'] = false;
                ?>
            }
        });
    </script>


</body>

</html>