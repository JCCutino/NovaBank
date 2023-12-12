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
        return false; 
    }
}

function validarSolicitudPrestamo($conceptoPrestamo, $cantidadSolicitada, $idPersona, $conn) {
  
    $iban = obtenerIBAN($idPersona, $conn);

    if (!$iban) {
        return "errorIBAN";
    }

   
    if ($cantidadSolicitada <= 0) {
        return "cantidadInvalida";
    }

 
    $querySaldo = "SELECT Saldo FROM Cuenta WHERE IBAN = '$iban'";
    $resultadoSaldo = $conn->query($querySaldo);

    if ($resultadoSaldo && $resultadoSaldo->num_rows > 0) {
        $filaSaldo = $resultadoSaldo->fetch_assoc();
        $saldoActual = $filaSaldo['Saldo'];

       
        $porcentajeMinimo = 0.15;
        $cantidadMinimaEnCuenta = $cantidadSolicitada * $porcentajeMinimo;

        if ($saldoActual < $cantidadMinimaEnCuenta) {
            return "saldoInsuficiente";
        }
    } else {
        return "errorBaseDatos";
    }

    $fechaSolicitud = date('Y-m-d');
    $estadoPrestamo = 'Pendiente';
    $query = "INSERT INTO Prestamo (Cantidad, Concepto, Estado_Prestamo, Fecha_Solicitud, ID_Persona, IBAN) VALUES ('$cantidadSolicitada', '$conceptoPrestamo', '$estadoPrestamo', '$fechaSolicitud', '$idPersona', '$iban')";
    
  
    if ($conn->query($query)) {
        return "exito";
       
    } else {
        return "errorBaseDatos";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $conceptoPrestamo = $_POST['conceptoPrestamo'];
    $cantidadSolicitada = $_POST['cantidadSolicitada'];

   
    $idPersona = $_SESSION['Id_Persona'];

   
    $resultadoPrestamo = validarSolicitudPrestamo($conceptoPrestamo, $cantidadSolicitada, $idPersona, $conn);

    $_SESSION['resultadoPrestamo'] = $resultadoPrestamo;
    header("Location: ../pagina_prestamos.php");

    $conn->close();
    exit();
}
?>
