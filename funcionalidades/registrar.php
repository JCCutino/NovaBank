<?php
include 'conexion.php';

$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$correoElectronico = $_POST["correo_register"];
$contrasena = password_hash($_POST["contrasena_register"], PASSWORD_DEFAULT);


$consultaCorreo = "SELECT * FROM Persona WHERE Correo_Electronico = '$correoElectronico'";
$resultadoCorreo = $conn->query($consultaCorreo);

if ($resultadoCorreo->num_rows > 0) {
  
    echo "Error: El correo electrónico ya está registrado.";
} else {
  
    $insertUsuario = "INSERT INTO Persona (Nombre, Apellidos, Correo_Electronico, Contrasena, Url_Foto) 
                VALUES ('$nombre', '$apellidos', '$correoElectronico', '$contrasena', '')";

    if ($conn->query($insertUsuario) === TRUE) {
        $result = $conn->query("SELECT Id_Persona FROM Persona WHERE Correo_Electronico = '$correoElectronico'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $Id_Persona = $row["Id_Persona"];
            
            
            $IBAN = generarIBAN($nombre);
            $fecha = obtenerFecha();
            $saldo = 0;
            $insertCuenta = "INSERT INTO Cuenta (IBAN, Saldo, Fecha_Apertura, Id_Persona) 
                             VALUES ('$IBAN', '$saldo', '$fecha' , '$Id_Persona')";
            
            if ($conn->query($insertCuenta) === TRUE) {
                header ("location: ../index.php");
            } else {
                header ("location: ../index.php");
            }
        } else {
            echo "Error: No se pudo encontrar la Id_Persona.";
        }
    } else {
        echo "Error al insertar usuario: " . $conn->error;
    }
}


    function generarIBAN($nombre) {

        $nombre = str_pad($nombre , 4 , "z");
    
        $primerasLetras = substr($nombre, 0, 4);
        $abecedario = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
        $cadenaBinaria = "";
      
        for ($i=0; $i <strlen($primerasLetras) ; $i++) { 
           $letra = strtolower($primerasLetras[$i]);
           $valorASCII = ord($letra);
          
          
           $posicion = $valorASCII - ord('a') + 1;
           
           $valorBinario = decbin($posicion);
           $cadenaBinaria = $cadenaBinaria.$valorBinario;
        }
    
        return $cadenaBinaria;
    }

    function obtenerFecha() {
        return date('Y-m-d');
    }

   
    $conn->close();
?>