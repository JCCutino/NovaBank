<?php
if (!isset($_SESSION['redireccion_hecha'])) {
  
    $_SESSION['redireccion_hecha'] = true;
    include '../funcionalidades/comprobarSesion.php';
  }
  ?>