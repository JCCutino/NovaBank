<?php
session_start(); 
include 'conexion.php';
function realizarTransferencia($conn, $nuevoSaldo) {
    
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

$cantidadIngreso = $_POST['cantidadIngreso']; 

$saldoActual = $_SESSION['saldoCuenta'];
$nuevoSaldo = $saldoActual + $cantidadIngreso;


$resultadoActualizacion = actualizarSaldo($conn, $nuevoSaldo);
realizarTransaccion($conn, $cantidadIngreso);

if ($resultadoActualizacion) {
    header ("location: ../pagina_principal.php");
} else {
    echo "Error al actualizar el saldo.";
}


$conn->close();


?>