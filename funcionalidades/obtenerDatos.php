<?php
session_start(); 
include 'conexion.php';
function obtenerNombreApellidoUsuario($conn) {
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
            return "$correoElectronico";
        }
    } else {
        return "$correoElectronico";
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



$nombreCompleto = obtenerNombreApellidoUsuario($conn);
$saldo = obtenerSaldo($conn);
$IBAN = obtenerIBAN($conn);
$conn->close();

?>