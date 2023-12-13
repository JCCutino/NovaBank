<?php
session_start(); 
include 'conexion.php';

function obtenerRutaFoto($conn) {
    $correoElectronico = $_SESSION['correoElectronico'];
    
    if (isset($_SESSION['correoElectronico'])) {
        $consultaRutaFoto = "SELECT Url_Foto FROM Persona WHERE Correo_Electronico = '$correoElectronico'";
        $resultado = $conn->query($consultaRutaFoto);

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $rutaFoto = $row['Url_Foto'];
            return $rutaFoto;
        } else {
            return "foto_perfil.webp";
        }
    } else {
        return "foto_perfil.webp"; 
    }
}


function obtenerNombreCompleto($conn) {
    $correoElectronico = $_SESSION['correoElectronico'];
    if (isset($_SESSION['correoElectronico'])) {
        

       
        $consultaNombreApellido = "SELECT Nombre, Apellidos FROM Persona WHERE Correo_Electronico = '$correoElectronico'";
        $resultado = $conn->query($consultaNombreApellido);

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $nombre = $row['Nombre'];
            $apellidos = $row['Apellidos'];
            return "$nombre $apellidos";
        } else {
            return null;
        }
    } else {
        return null;
    }
}

function obtenerSaldo($conn) {
    $correoElectronico = $_SESSION['correoElectronico'];

    $resultado = $conn->query("SELECT Id_Persona FROM Persona WHERE Correo_Electronico = '$correoElectronico'");

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $Id_Persona = $row["Id_Persona"];

      
        $consultaSaldo = "SELECT Saldo FROM Cuenta WHERE Id_Persona = '$Id_Persona'";
        $resultadoSaldo = $conn->query($consultaSaldo);

        if ($resultadoSaldo->num_rows > 0) {
            $rowSaldo = $resultadoSaldo->fetch_assoc();
            $saldoCuenta = $rowSaldo["Saldo"];

            $_SESSION['Id_Persona'] = $Id_Persona;
            $_SESSION['saldoCuenta'] = $saldoCuenta;
            
           return $saldoCuenta;
        } else {
            return null; 
        }
    } else {
        return null; 
    }
} 

function obtenerIBAN($conn) {
    $Id_Persona = $_SESSION['Id_Persona'];

        $consultaIBAN= "SELECT IBAN FROM Cuenta WHERE Id_Persona = '$Id_Persona'";
        $resultadoIBAN = $conn->query($consultaIBAN);

        if ($resultadoIBAN->num_rows > 0) {
            $rowIBAN = $resultadoIBAN->fetch_assoc();
            $IBAN = $rowIBAN["IBAN"];

            $_SESSION['IBAN'] = $IBAN;

            
           return $IBAN;
        } else {
            return null; 
        }
}

function obtenerNombreSimple($conn) {
    
    $correoElectronico = $_SESSION['correoElectronico'];

        $consultaNombre = "SELECT Nombre FROM Persona WHERE Correo_Electronico = '$correoElectronico'";
        $resultado = $conn->query($consultaNombre);

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $nombre = $row['Nombre'];
            $nombre = strtoupper($nombre);
            return "$nombre";
        } else {
            return null;
        }
    } 

function obtenerFecha(){

$local = 'es_ES';
$fmt = new IntlDateFormatter($local, IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'UTC');

$fechaActual = new DateTime();
$fechaDia = $fmt->format($fechaActual);

return $fechaDia;
}
    




$nombreCompleto = obtenerNombreCompleto($conn);
$saldo = obtenerSaldo($conn);
$IBAN = obtenerIBAN($conn);
$nombreSimple = obtenerNombreSimple($conn);
$fecha = obtenerFecha();
$ruta = obtenerRutaFoto($conn);
$conn->close();

?>