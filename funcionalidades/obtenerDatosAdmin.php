<?php
session_start(); 
include 'conexion.php';
function obtenerNombreCompleto($conn) {
    $correoElectronico = $_SESSION['correoElectronico'];
    if (isset($_SESSION['correoElectronico'])) {
        

       
        $consultaNombreApellido = "SELECT Nombre, Apellidos FROM Persona WHERE Correo_Electronico = '$correoElectronico'";
        $resultado = $conn->query($consultaNombreApellido);

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $nombre = $row['Nombre'];
            $apellidos = $row['Apellidos'];
            return "$nombre $apellidos";
        } else {
            return null;
        }
    } else {
        return null;
    }
}


function obtenerNombreSimple($conn) {
    
    $correoElectronico = $_SESSION['correoElectronico'];

        $consultaNombre = "SELECT Nombre FROM Persona WHERE Correo_Electronico = '$correoElectronico'";
        $resultado = $conn->query($consultaNombre);

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $nombre = $row['Nombre'];
            $nombre = strtoupper($nombre);
            return "$nombre";
        } else {
            return null;
        }
    } 

function obtenerFecha(){

$local = 'es_ES';
$fmt = new IntlDateFormatter($local, IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'UTC');

$fechaActual = new DateTime();
$fechaDia = $fmt->format($fechaActual);

return $fechaDia;
}
    
$nombreCompleto = obtenerNombreCompleto($conn);
$nombreSimple = obtenerNombreSimple($conn);
$fecha = obtenerFecha();
$conn->close();


?>