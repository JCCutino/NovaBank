<?php
session_start(); 
include 'conexion.php';

function actualizarSaldo($conn, $nuevoSaldo) {
    $Id_Persona = $_SESSION['Id_Persona'];

    
    $consultaActualizarSaldo = "UPDATE Cuenta SET Saldo = '$nuevoSaldo' WHERE Id_Persona = '$Id_Persona'";
    $resultadoActualizarSaldo = $conn->query($consultaActualizarSaldo);

   
    if ($resultadoActualizarSaldo) {
        return true; 
    } else {
        return false; 
    }
}

$nuevoSaldoModal = $_POST['cantidadIngreso']; 

$saldoActual = $_SESSION['saldoCuenta'];
$nuevoSaldo = $saldoActual + $nuevoSaldoModal;


$resultadoActualizacion = actualizarSaldo($conn, $nuevoSaldo);

if ($resultadoActualizacion) {
    header ("location: ../pagina_principal.php");
} else {
    echo "Error al actualizar el saldo.";
}

?>