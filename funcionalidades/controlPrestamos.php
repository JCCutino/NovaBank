<?php

include 'conexion.php';
session_start(); 

function rechazarPrestamo($idPrestamo) {
    global $conn;

    $sql = "UPDATE Prestamo SET Estado_Prestamo = 'Rechazado' WHERE ID_Prestamo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idPrestamo);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function realizarTransaccion($cantidad, $iban) {
    global $conn;

    $fechaHora = date("Y-m-d H:i:s");
    $tipoTransaccion = "Prestamo Aceptado";

    $consultaInsertarTransaccion = $conn->prepare("INSERT INTO Transaccion (Tipo_Transaccion, Cantidad, Fecha_Hora, IBAN) 
                                                   VALUES (?, ?, ?, ?)");
    
    $consultaInsertarTransaccion->bind_param("ssss", $tipoTransaccion, $cantidad, $fechaHora, $iban);

    $resultadoInsertarTransaccion = $consultaInsertarTransaccion->execute();

}

function aceptarPrestamo($idPrestamo, $tasaInteres, $plazoPagar, $iban, $cantidad) {
    global $conn;
  
    $fechaActual = date("Y-m-d");

    $fechaPago = date("Y-m-d", strtotime("+" . $plazoPagar . " years", strtotime($fechaActual)));

    $conn->begin_transaction();

    try {
        $deuda = $cantidad + ($cantidad * $tasaInteres);


        $sqlUpdatePrestamo = "UPDATE Prestamo SET Estado_Prestamo = 'Aceptado', Tasa_Interes = ?, Plazo_Prestamo = ?, Fecha_Aprobacion = ?, Fecha_Pago = ?, Deuda = ? WHERE ID_Prestamo = ?";
        $stmtUpdatePrestamo = $conn->prepare($sqlUpdatePrestamo);
        $stmtUpdatePrestamo->bind_param("dissdi", $tasaInteres, $plazoPagar, $fechaActual, $fechaPago, $deuda, $idPrestamo);

        if (!$stmtUpdatePrestamo->execute()) {
            throw new Exception("Error al actualizar el préstamo.");
        }

        $sqlSaldoActual = "SELECT Saldo FROM Cuenta WHERE IBAN = ?";
        $stmtSaldoActual = $conn->prepare($sqlSaldoActual);
        $stmtSaldoActual->bind_param("s", $iban);
        $stmtSaldoActual->execute();
        $resultSaldo = $stmtSaldoActual->get_result();

        if ($resultSaldo->num_rows > 0) {
            $filaSaldo = $resultSaldo->fetch_assoc();
            $saldoActual = $filaSaldo['Saldo'];

            $nuevoSaldo = $saldoActual + $cantidad;

            $sqlUpdateSaldo = "UPDATE Cuenta SET Saldo = ? WHERE IBAN = ?";
            $stmtUpdateSaldo = $conn->prepare($sqlUpdateSaldo);
            $stmtUpdateSaldo->bind_param("ds", $nuevoSaldo, $iban);

            if (!$stmtUpdateSaldo->execute()) {
                throw new Exception("Error al actualizar el saldo de la cuenta.");
            }
            realizarTransaccion($cantidad, $iban);

            $conn->commit();
            return true;
        } else {
            throw new Exception("No se encontró la cuenta asociada al IBAN proporcionado.");
        }
    } catch (Exception $e) {
        $conn->rollback();
        return false;
    }
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["idPrestamo"]) && isset($_POST["tipoInteres"]) && isset($_POST["plazoPagar"]) && isset($_POST["decision"]) && isset($_POST["iban"]) && isset($_POST["cantidad"])) {
        $idPrestamo = $_POST["idPrestamo"];
        $tipoInteres = $_POST["tipoInteres"];
        $plazoPagar = $_POST["plazoPagar"];
        $decision = $_POST["decision"];
        $iban = $_POST["iban"];
        $cantidad = $_POST["cantidad"];

        if ($decision === "aceptar") {
            if (aceptarPrestamo($idPrestamo, $tipoInteres, $plazoPagar, $iban, $cantidad)) {
                $_SESSION['resultadoPrestamoAdmin'] = "aceptarExito";
                header("location: " . $_SERVER['HTTP_REFERER']);
            } else {
                $_SESSION['resultadoPrestamoAdmin'] = "aceptarFallo";
                header("location: " . $_SERVER['HTTP_REFERER']);
            }
        } elseif ($decision === "rechazar") {
            if (rechazarPrestamo($idPrestamo)) {
                $_SESSION['resultadoPrestamoAdmin'] = "rechazarExito";
                header("location: " . $_SERVER['HTTP_REFERER']);
            } else {
                $_SESSION['resultadoPrestamoAdmin'] = "rechazarFallo";
                header("location: " . $_SERVER['HTTP_REFERER']);
            }
        }
    }
}


 $conn->close();
?>
