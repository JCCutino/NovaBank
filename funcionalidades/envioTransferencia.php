<?php
session_start(); 
include 'conexion.php';
function realizarTransferencia($conn, $monto, $IBAN_receptor) {
    $Id_Persona = $_SESSION['Id_Persona'];

    if ($monto <= 0) {
        return 'cantidadInvalida';
    }

    // Verificar que el IBAN del emisor existe
    $consultaIBAN_emisor = $conn->prepare("SELECT IBAN, Saldo FROM Cuenta WHERE Id_Persona = ?");
    $consultaIBAN_emisor->bind_param("s", $Id_Persona);
    $consultaIBAN_emisor->execute();
    $resultadoIBAN_emisor = $consultaIBAN_emisor->get_result();

    if ($resultadoIBAN_emisor->num_rows <= 0) {
        return 'ibanNoEncontradoEmisor';
    }

    $filaIBAN_emisor = $resultadoIBAN_emisor->fetch_assoc();
    $IBAN_emisor = $filaIBAN_emisor['IBAN'];
    $saldo_emisor = $filaIBAN_emisor['Saldo'];

    // Verificar que el IBAN del receptor existe
    $consultaIBAN_receptor = $conn->prepare("SELECT Saldo FROM Cuenta WHERE IBAN = ?");
    $consultaIBAN_receptor->bind_param("s", $IBAN_receptor);
    $consultaIBAN_receptor->execute();
    $resultadoIBAN_receptor = $consultaIBAN_receptor->get_result();

    if ($resultadoIBAN_receptor->num_rows <= 0) {
        return 'ibanNoEncontradoReceptor';
    }

    // Verificar que el IBAN del emisor y receptor no sea el mismo
    if ($IBAN_emisor === $IBAN_receptor) {
        return 'ibanEmisorReceptorIguales';
    }

    // Verificar que el saldo del emisor sea suficiente
    if ($saldo_emisor < $monto) {
        return 'saldoInsuficiente';
    }

    // Realizar la transferencia
    $nuevoSaldo_emisor = $saldo_emisor - $monto;
    $consultaActualizarSaldo_emisor = $conn->prepare("UPDATE Cuenta SET Saldo = ? WHERE Id_Persona = ?");
    $consultaActualizarSaldo_emisor->bind_param("ds", $nuevoSaldo_emisor, $Id_Persona);
    $resultadoActualizarSaldo_emisor = $consultaActualizarSaldo_emisor->execute();

    if ($resultadoActualizarSaldo_emisor) {
        // Actualizar el saldo del receptor
        $filaIBAN_receptor = $resultadoIBAN_receptor->fetch_assoc();
        $saldo_receptor = $filaIBAN_receptor['Saldo'];

        $nuevoSaldo_receptor = $saldo_receptor + $monto;
        $consultaActualizarSaldo_receptor = $conn->prepare("UPDATE Cuenta SET Saldo = ? WHERE IBAN = ?");
        $consultaActualizarSaldo_receptor->bind_param("ds", $nuevoSaldo_receptor, $IBAN_receptor);
        $resultadoActualizarSaldo_receptor = $consultaActualizarSaldo_receptor->execute();

        if (!$resultadoActualizarSaldo_receptor) {
            return 'errorBaseDatosReceptor';
        }
    } else {
        return 'errorBaseDatosEmisor';
    }

    return ''; // Todo ha ido bien, no hay error
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

$resultadoTransferencia = realizarTransferencia($conn, $cantidadIngreso, $iban);


if ($resultadoTransferencia === '') { 
    realizarTransaccionCompleta($conn, $cantidadIngreso, $iban);
    $conn->close();
    $_SESSION['errorEnvioDinero'] = 'exito';

    header("Location: ../pagina_pagos.php");
    exit();

} else {
    $_SESSION['errorEnvioDinero'] = $resultadoTransferencia;
    header("Location: ../pagina_pagos.php");
    $conn->close();
    exit();
}


?>