<?php
session_start(); 
include 'conexion.php';
function actualizarSaldo($conn, $nuevoSaldo) {
    
    $Id_Persona = $_SESSION['Id_Persona'];

    
    $consultaIBAN = "SELECT IBAN FROM Cuenta WHERE Id_Persona = '$Id_Persona'";
    $resultadoIBAN = $conn->query($consultaIBAN);

  
    if ($resultadoIBAN) {
        
        $filaIBAN = $resultadoIBAN->fetch_assoc();
        $IBAN = $filaIBAN['IBAN'];
        $_SESSION['IBAN'] = $IBAN;
      
        $consultaActualizarSaldo = "UPDATE Cuenta SET Saldo = '$nuevoSaldo' WHERE Id_Persona = '$Id_Persona'";
        $resultadoActualizarSaldo = $conn->query($consultaActualizarSaldo);

        
        if ($resultadoActualizarSaldo) {
          
            return true;
        } else {
           
            return false;
        }
    } else {
        
        return false;
    }
}

function realizarTransaccion($conn, $cantidad) {
    $fechaHora = date("Y-m-d H:i:s");
    $iban =  $_SESSION['IBAN'];
    $tipoTransaccion = "Ingreso";

    $consultaInsertarTransaccion = $conn->prepare("INSERT INTO Transaccion (Tipo_Transaccion, Cantidad, Fecha_Hora, IBAN) 
                                                   VALUES (?, ?, ?, ?)");
    
    $consultaInsertarTransaccion->bind_param("ssss", $tipoTransaccion, $cantidad, $fechaHora, $iban);

    $resultadoInsertarTransaccion = $consultaInsertarTransaccion->execute();

    if ($resultadoInsertarTransaccion) {
        return true;
    } else {
        return false;
    }
}
$referer = $_SERVER['HTTP_REFERER'];
$cantidadIngreso = $_POST['cantidadIngreso']; 

if($cantidadIngreso > 0){

$saldoActual = $_SESSION['saldoCuenta'];
$nuevoSaldo = $saldoActual + $cantidadIngreso;


$resultadoActualizacion = actualizarSaldo($conn, $nuevoSaldo);
realizarTransaccion($conn, $cantidadIngreso);

if ($resultadoActualizacion) {
    header("Location: $referer");
} else {
    header("Location: $referer");
}
}else{
    header("Location: $referer");
}

$conn->close();
?>