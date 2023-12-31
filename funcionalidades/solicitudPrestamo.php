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

function obtenerEdad($fechaNacimiento) {
    $hoy = new DateTime();
    $fechaNacimiento = new DateTime($fechaNacimiento);
    $edad = $hoy->diff($fechaNacimiento)->y;
    return $edad;
}

function validarEdad($idPersona, $conn) {
    $queryFechaNacimiento = "SELECT Fecha_nacimiento FROM Persona WHERE ID_Persona = '$idPersona'";
    $resultadoFechaNacimiento = $conn->query($queryFechaNacimiento);

    if ($resultadoFechaNacimiento && $resultadoFechaNacimiento->num_rows > 0) {
        $filaFechaNacimiento = $resultadoFechaNacimiento->fetch_assoc();
        $fechaNacimiento = $filaFechaNacimiento['Fecha_nacimiento'];

        $edad = obtenerEdad($fechaNacimiento);

        if ($edad < 18) {
            return "errorMenorEdad";
        }
    } else {
        return "errorEdadDesconocida";
    }

    return "";  
}


function validarSolicitudPrestamo($conceptoPrestamo, $cantidadSolicitada, $idPersona, $conn) {
  

    $errorEdad = validarEdad($idPersona, $conn);
    if ($errorEdad !== "") {
        return $errorEdad;
    }

$queryPrestamoPendiente = "SELECT COUNT(*) as countPrestamos FROM Prestamo WHERE ID_Persona = '$idPersona' AND Estado_Prestamo = 'Pendiente'";
$resultadoPrestamoPendiente = $conn->query($queryPrestamoPendiente);

if ($resultadoPrestamoPendiente) {
    $filaPrestamoPendiente = $resultadoPrestamoPendiente->fetch_assoc();
    $prestamosPendientes = $filaPrestamoPendiente['countPrestamos'];

    if ($prestamosPendientes > 0) {
        return "prestamoPendiente";
    }
} else {
    return "errorBaseDatos";
}

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
    header("location: " . $_SERVER['HTTP_REFERER']);
    $conn->close();
    exit();
}
?>
