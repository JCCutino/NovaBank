<?php
session_start(); 
include 'conexion.php';
function obtenerNombreApellidoUsuario($conn) {
    
    if (isset($_SESSION['correoElectronico'])) {
        $correoElectronico = $_SESSION['correoElectronico'];

       
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

           return $saldoCuenta;
        } else {
            return $saldoCuenta; 
        }
    } else {
        return null; 
    }
} 

$nombreCompleto = obtenerNombreApellidoUsuario($conn);
$saldo = obtenerSaldo($conn);

$conn->close();

?>