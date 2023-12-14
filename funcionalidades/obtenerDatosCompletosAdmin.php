<?php

include 'conexion.php';

session_start();

function obtenerDatosPersona($idPersonaDatos, $conn) {
    $consultaPersona = "SELECT Nombre, Apellidos, DNI, Fecha_nacimiento, Direccion, CP, Ciudad, Provincia, Pais, Correo_Electronico, Contrasena, Url_Foto FROM Persona WHERE ID_Persona = ?";

    $statement = $conn->prepare($consultaPersona);
    $statement->bind_param('i', $idPersonaDatos); 
    $statement->execute();

    $resultado = $statement->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $datosPersona = array(
            'Nombre' => obtenerValor($row['Nombre']),
            'Apellidos' => obtenerValor($row['Apellidos']),
            'DNI' => obtenerValor($row['DNI']),
            'Fecha_nacimiento' => obtenerValor($row['Fecha_nacimiento']),
            'Direccion' => obtenerValor($row['Direccion']),
            'CP' => obtenerValor($row['CP']),
            'Ciudad' => obtenerValor($row['Ciudad']),
            'Provincia' => obtenerValor($row['Provincia']),
            'Pais' => obtenerValor($row['Pais']),
            'Correo_Electronico' => obtenerValor($row['Correo_Electronico']),
            'Contrasena' => obtenerValor($row['Contrasena']),
            'Url_Foto' => obtenerValor($row['Url_Foto']),
        );

        return $datosPersona;
    } else {
        return false; 
    }

    $statement->close();
}

function obtenerDatosCuenta($idPersonaDatos, $conn) {
    $consultaCuenta = "SELECT IBAN, Saldo, Fecha_Apertura, ID_Persona FROM Cuenta WHERE ID_Persona = ?";

    $statement = $conn->prepare($consultaCuenta);
    $statement->bind_param('i', $idPersonaDatos); 
    $statement->execute();

    $resultado = $statement->get_result();

    if ($resultado) {
        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $datosCuenta = array(
                'IBAN' => obtenerValor($row['IBAN']),
                'Saldo' => obtenerValor($row['Saldo']),
                'Fecha_Apertura' => obtenerValor($row['Fecha_Apertura']),
                'ID_Persona' => obtenerValor($row['ID_Persona']),
            );

            return $datosCuenta;
        } else {
            return false; 
        }
    } else {
        die('Error en la consulta SQL: ' . $conn->error);
    }

    $statement->close();
}

function obtenerValor($valor) {
    return $valor !== null ? $valor : 'Dato inexistente';
}

if (isset($_POST['idPersona'])) {
    $idPersonaDatos = $_POST['idPersona'];
    
    $datosPersona = obtenerDatosPersona($idPersonaDatos, $conn);
    $datosCuenta = obtenerDatosCuenta($idPersonaDatos, $conn);

    if ($datosPersona && $datosCuenta) {
        $_SESSION['datosPersona'] = $datosPersona;
        $_SESSION['datosCuenta'] = $datosCuenta;
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['datosPersona'] = null;
        $_SESSION['datosCuenta'] = null;
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
} else {
    $_SESSION['datosPersona'] = null;
    $_SESSION['datosCuenta'] = null;
    header("location: " . $_SERVER['HTTP_REFERER']);
}

$conn->close();
?>
