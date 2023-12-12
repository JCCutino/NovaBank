<?php

    if (isset($_SESSION['correoElectronico'])) {
      
        header("location: " . $_SERVER['HTTP_REFERER']);
        
        exit();
    } else {
      
        header("location: ../index.php");
        exit();
    }



?>