<?php
include 'conexion.php';
session_start(); 
function pagarPrestamo($conn, $idPrestamo, $cantidadPago) {
    $Id_Persona = $_SESSION['Id_Persona'];

    if ($cantidadPago <= 0) {
        return 'cantidadInvalida';
    }

    $consultaPrestamo = $conn->prepare("SELECT IBAN, Deuda FROM Prestamo WHERE ID_Prestamo = ? AND ID_Persona = ?");
    $consultaPrestamo->bind_param("is", $idPrestamo, $Id_Persona);
    $consultaPrestamo->execute();
    $resultadoPrestamo = $consultaPrestamo->get_result();

    if ($resultadoPrestamo->num_rows <= 0) {
        return 'prestamoNoEncontrado';
    }

    $filaPrestamo = $resultadoPrestamo->fetch_assoc();
    $IBAN = $filaPrestamo['IBAN'];
    $deuda = $filaPrestamo['Deuda'];

    if ($deuda < $cantidadPago) {
        return 'deudaInsuficiente';
    }
    
    $consultaSaldo = $conn->prepare("SELECT Saldo FROM Cuenta WHERE IBAN = ?");
    $consultaSaldo->bind_param("s", $IBAN);
    $consultaSaldo->execute();
    $resultadoSaldo = $consultaSaldo->get_result();

    if ($resultadoSaldo->num_rows <= 0) {
        return 'ibanNoEncontrado';
    }

    $filaSaldo = $resultadoSaldo->fetch_assoc();
    $saldo = $filaSaldo['Saldo'];

    if ($saldo < $cantidadPago) {
        return 'saldoInsuficiente';
    }

    $nuevaDeuda = $deuda - $cantidadPago;
    $consultaActualizarDeuda = $conn->prepare("UPDATE Prestamo SET Deuda = ? WHERE ID_Prestamo = ?");
    $consultaActualizarDeuda->bind_param("di", $nuevaDeuda, $idPrestamo);
    $resultadoActualizarDeuda = $consultaActualizarDeuda->execute();

    if (!$resultadoActualizarDeuda) {
        return 'errorBaseDatosPrestamo';
    }


    $nuevoSaldo = $saldo - $cantidadPago;
    $consultaActualizarSaldo = $conn->prepare("UPDATE Cuenta SET Saldo = ? WHERE IBAN = ?");
    $consultaActualizarSaldo->bind_param("ds", $nuevoSaldo, $IBAN);
    $resultadoActualizarSaldo = $consultaActualizarSaldo->execute();

    if (!$resultadoActualizarSaldo) {
        return 'errorBaseDatosPrestamo';
    }

    realizarTransaccionCompleta($conn, $cantidadPago, $IBAN);
    return 'exito';
}

function realizarTransaccionCompleta($conn, $cantidadPago, $IBAN) {
   
    $tipoTransaccion = "Pago Prestamo";

    $fechaHora = date("Y-m-d H:i:s");

    $consultaTransaccion = $conn->prepare("INSERT INTO Transaccion (Tipo_Transaccion, Cantidad, Fecha_Hora, IBAN) VALUES (?, ?, ?, ?)");
        $consultaTransaccion->bind_param("ssss", $tipoTransaccion, $cantidadPago, $fechaHora, $IBAN);
        $consultaTransaccion->execute();

        return true;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idPrestamo = isset($_POST['idPrestamo']) ? $_POST['idPrestamo'] : null;
    $deuda = isset($_POST['deuda']) ? $_POST['deuda'] : null;
    $cantidadPago = isset($_POST['cantidadPago']) ? $_POST['cantidadPago'] : null;

 
    if ($idPrestamo === null || $deuda === null || $cantidadPago === null || !is_numeric($idPrestamo) || !is_numeric($deuda) || !is_numeric($cantidadPago)) {
        $_SESSION['resultadoPagoDeuda'] = "falloDatos";
        header("location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

   $mensajePagoPrestamo = pagarPrestamo($conn, $idPrestamo, $cantidadPago);
   $_SESSION['resultadoPagoDeuda'] = $mensajePagoPrestamo;
   header("location: " . $_SERVER['HTTP_REFERER']);
   
} else {
  
    header("location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

?>
