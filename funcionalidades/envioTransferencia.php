<?php
session_start(); 
include 'conexion.php';

function realizarTransferencia($conn, $monto, $IBAN_destinatario) {
    $Id_Persona = $_SESSION['Id_Persona'];

  
    $consultaIBAN_remitente = $conn->prepare("SELECT IBAN, Saldo FROM Cuenta WHERE Id_Persona = ?");
    $consultaIBAN_remitente->bind_param("s", $Id_Persona);
    $consultaIBAN_remitente->execute();
    $resultadoIBAN_remitente = $consultaIBAN_remitente->get_result();

    if ($resultadoIBAN_remitente) {
        $filaIBAN_remitente = $resultadoIBAN_remitente->fetch_assoc();
        $IBAN_remitente = $filaIBAN_remitente['IBAN'];
        $saldo_remitente = $filaIBAN_remitente['Saldo'];

     
        if ($saldo_remitente < $monto) {
            return false; 
        }

      
        $nuevoSaldo_remitente = $saldo_remitente - $monto;
        $consultaActualizarSaldo_remitente = $conn->prepare("UPDATE Cuenta SET Saldo = ? WHERE Id_Persona = ?");
        $consultaActualizarSaldo_remitente->bind_param("ds", $nuevoSaldo_remitente, $Id_Persona);
        $resultadoActualizarSaldo_remitente = $consultaActualizarSaldo_remitente->execute();

   
        if ($resultadoActualizarSaldo_remitente) {
           
            $consultaIBAN_destinatario = $conn->prepare("SELECT Saldo FROM Cuenta WHERE IBAN = ?");
            $consultaIBAN_destinatario->bind_param("s", $IBAN_destinatario);
            $consultaIBAN_destinatario->execute();
            $resultadoIBAN_destinatario = $consultaIBAN_destinatario->get_result();

            if ($resultadoIBAN_destinatario) {
                $filaIBAN_destinatario = $resultadoIBAN_destinatario->fetch_assoc();
                $saldo_destinatario = $filaIBAN_destinatario['Saldo'];

              
                $nuevoSaldo_destinatario = $saldo_destinatario + $monto;
                $consultaActualizarSaldo_destinatario = $conn->prepare("UPDATE Cuenta SET Saldo = ? WHERE IBAN = ?");
                $consultaActualizarSaldo_destinatario->bind_param("ds", $nuevoSaldo_destinatario, $IBAN_destinatario);
                $resultadoActualizarSaldo_destinatario = $consultaActualizarSaldo_destinatario->execute();

             
                if ($resultadoActualizarSaldo_destinatario) {
                    return true; 
                } else {
                    return false;
                }
            } else {
                return false; 
            }
        } else {
            return false; 
        }
    } else {
        return false; 
    }
}


function realizarTransaccionCompleta($conn, $monto, $ibanDestinatario = null) {
    $tipoTransaccionRemitente = "Envio Dinero";
    $tipoTransaccionDestinatario = "Ingreso";

  
    $ibanRemitente = $_SESSION['IBAN'];

  
    $fechaHora = date("Y-m-d H:i:s");

    $consultaTransaccionRemitente = $conn->prepare("INSERT INTO Transaccion (Tipo_Transaccion, Cantidad, Fecha_Hora, IBAN) VALUES (?, ?, ?, ?)");
        $consultaTransaccionRemitente->bind_param("ssss", $tipoTransaccionRemitente, $monto, $fechaHora, $ibanRemitente);
        $consultaTransaccionRemitente->execute();

       
        if (!is_null($ibanDestinatario)) {
            $consultaTransaccionDestinatario = $conn->prepare("INSERT INTO Transaccion (Tipo_Transaccion, Cantidad, Fecha_Hora, IBAN) VALUES (?, ?, ?, ?)");
            $consultaTransaccionDestinatario->bind_param("ssss", $tipoTransaccionDestinatario, $monto, $fechaHora, $ibanDestinatario);
            $consultaTransaccionDestinatario->execute();

        return true; 
    }

}

$cantidadIngreso = $_POST['cantidadTransferencia']; 
$iban =  $_POST['ibanReceptor']; 


$resultadoActualizacion = realizarTransferencia($conn, $cantidadIngreso, $iban);


if ($resultadoActualizacion) {
    realizarTransaccionCompleta($conn, $cantidadIngreso, $iban);
    header ("location: ../pagina_pagos.php");
} else {
    echo "Error al actualizar el saldo.";
}


$conn->close();


?>