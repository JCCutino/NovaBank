<?php

include 'conexion.php';

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

function aceptarPrestamo($idPrestamo, $tasaInteres, $plazoPagar, $fechaAprobacion, $fechaPago) {
    global $conn;

    $sql = "UPDATE Prestamo SET Estado_Prestamo = 'Aceptado', Tasa_Interes = ?, Plazo_Prestamo = ?, Fecha_Aprobacion = ?, Fecha_Pago = ? WHERE ID_Prestamo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("diisi", $tasaInteres, $plazoPagar, $fechaAprobacion, $fechaPago, $idPrestamo);

    if ($stmt->execute()) {
        return true;
    } else {
        return false; 
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["idPrestamo"]) && isset($_POST["tipoInteres"]) && isset($_POST["plazoPagar"]) && isset($_POST["decision"])) {
        $idPrestamo = $_POST["idPrestamo"];
        $tipoInteres = $_POST["tipoInteres"];
        $plazoPagar = $_POST["plazoPagar"];
        $decision = $_POST["decision"];

        if ($decision === "aceptar") {
           
            $fechaAprobacion = date("Y-m-d"); 
            $fechaPago = date("Y-m-d"); 

            if (aceptarPrestamo($idPrestamo, $tipoInteres, $plazoPagar, $fechaAprobacion, $fechaPago)) {
                echo "Préstamo aceptado con éxito.";
            } else {
                echo "Error al aceptar el préstamo.";
            }
        } elseif ($decision === "rechazar") {
            if (rechazarPrestamo($idPrestamo)) {
                echo "Préstamo rechazado con éxito.";
            } else {
                echo "Error al rechazar el préstamo.";
            }
        }
    }
}

// Cerrar la conexión después de usarla
$conn->close();
?>
