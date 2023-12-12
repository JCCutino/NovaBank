<?php
session_start(); 
include('conexion.php');

function obtenerIBAN($idPersona, $conn) {
 
    $queryIBAN = "SELECT IBAN FROM Cuenta WHERE ID_Persona = '$idPersona'";
    $resultadoIBAN = $conn->query($queryIBAN);

    if ($resultadoIBAN && $resultadoIBAN->num_rows > 0) {
        $filaIBAN = $resultadoIBAN->fetch_assoc();
        return $filaIBAN['IBAN'];
    } else {
        return false; // Manejo de errores si es necesario
    }
}

function validarSolicitudPrestamo($conceptoPrestamo, $cantidadSolicitada, $idPersona, $conn) {
  
    $iban = obtenerIBAN($idPersona, $conn);

    if (!$iban) {
        return "Error al obtener el IBAN asociado a la Id_Persona.";
    }

   
    if ($cantidadSolicitada <= 0) {
        return "La cantidad solicitada debe ser mayor que 0.";
    }

 
    $querySaldo = "SELECT Saldo FROM Cuenta WHERE IBAN = '$iban'";
    $resultadoSaldo = $conn->query($querySaldo);

    if ($resultadoSaldo && $resultadoSaldo->num_rows > 0) {
        $filaSaldo = $resultadoSaldo->fetch_assoc();
        $saldoActual = $filaSaldo['Saldo'];

       
        $porcentajeMinimo = 0.15;
        $cantidadMinimaEnCuenta = $cantidadSolicitada * $porcentajeMinimo;

        if ($saldoActual < $cantidadMinimaEnCuenta) {
            return "No tienes suficiente saldo en tu cuenta. Debes tener al menos el 15% de la cantidad solicitada en tu cuenta.";
        }
    } else {
        return "Error al obtener el saldo de la cuenta.";
    }

    $fechaSolicitud = date('Y-m-d');
    $estadoPrestamo = 'En Espera';
    $query = "INSERT INTO Prestamo (Cantidad, Concepto, Estado_Prestamo, Fecha_Solicitud, ID_Persona, IBAN) VALUES ('$cantidadSolicitada', '$conceptoPrestamo', '$estadoPrestamo', '$fechaSolicitud', '$idPersona', '$iban')";
    
  
    if ($conn->query($query)) {
        return "Solicitud de préstamo enviada con éxito.";
       
    } else {
        return "Error al enviar la solicitud de préstamo: " . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $conceptoPrestamo = $_POST['conceptoPrestamo'];
    $cantidadSolicitada = $_POST['cantidadSolicitada'];

   
    $idPersona = $_SESSION['Id_Persona'];

   
    $resultadoValidacion = validarSolicitudPrestamo($conceptoPrestamo, $cantidadSolicitada, $idPersona, $conn);

   
    echo $resultadoValidacion;

  
    $conn->close();
}
?>
