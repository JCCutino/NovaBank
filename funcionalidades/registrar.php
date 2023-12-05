<?php
include 'conexion.php';
session_start();

$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$dni = $_POST["dni"];
$pais = $_POST["pais"];
$correoElectronico = $_POST["correo_register"];
$contrasena = password_hash($_POST["contrasena_register"], PASSWORD_DEFAULT);


$consultaCorreo = $conn->prepare("SELECT * FROM Persona WHERE Correo_Electronico = ?");
$consultaCorreo->bind_param("s", $correoElectronico);
$consultaCorreo->execute();
$resultadoCorreo = $consultaCorreo->get_result();

if ($resultadoCorreo->num_rows > 0) {
    $_SESSION['correoExistente'] = true;
    header("location: ../index.php");
} else {
    $insertUsuario = $conn->prepare("INSERT INTO Persona (Nombre, Apellidos, DNI, Pais, Correo_Electronico, Contrasena, Url_Foto) VALUES (?, ?, ?, ?, ?, ?, '')");
$insertUsuario->bind_param("ssssss", $nombre, $apellidos, $dni, $pais, $correoElectronico, $contrasena);

    if ($insertUsuario->execute()) {
        $result = $conn->prepare("SELECT Id_Persona FROM Persona WHERE Correo_Electronico = ?");
        $result->bind_param("s", $correoElectronico);
        $result->execute();
        $row = $result->get_result()->fetch_assoc();

        $Id_Persona = $row["Id_Persona"];

        $IBAN = generarIBAN($nombre, $conn);
        $fecha = obtenerFecha();
        $saldo = 0;

        $insertCuenta = $conn->prepare("INSERT INTO Cuenta (IBAN, Saldo, Fecha_Apertura, Id_Persona) VALUES (?, ?, ?, ?)");
        $insertCuenta->bind_param("sdsi", $IBAN, $saldo, $fecha, $Id_Persona);

        if ($insertCuenta->execute()) {
            header("location: ../index.php");
        } else {
            echo "Error al insertar cuenta: " . $conn->error;
        }
    } else {
        echo "Error al insertar usuario: " . $conn->error;
    }
}




    function generarIBAN($nombre, $conn) {

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
 do{
        $consultaIBAN = $conn->prepare("SELECT IBAN FROM Cuenta WHERE IBAN = ?");
        $consultaIBAN->bind_param("s", $cadenaBinaria);
        $consultaIBAN->execute();
        $resultadoIBAN = $consultaIBAN->get_result();
    
        if ($resultadoIBAN->num_rows > 0) {
            $cadenaBinaria = $cadenaBinaria . "1";
        }
    } while ($resultadoIBAN->num_rows > 0);

    return $cadenaBinaria;
    }

    function obtenerFecha() {
        return date('Y-m-d');
    }

   
    $conn->close();
?>