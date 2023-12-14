<?php


if (isset($_SESSION['datosPersona'])) {

    $datosPersona = $_SESSION['datosPersona'];

    $nombre = $datosPersona['Nombre'];
    $apellidos = $datosPersona['Apellidos'];
    $dni = $datosPersona['DNI'];
    $fechaNacimiento = $datosPersona['Fecha_nacimiento'];
    $direccion = $datosPersona['Direccion'];
    $codigoPostal = $datosPersona['CP'];
    $ciudad = $datosPersona['Ciudad'];
    $provincia = $datosPersona['Provincia'];
    $pais = $datosPersona['Pais'];
    $correoElectronico = $datosPersona['Correo_Electronico'];
    $contrasena = $datosPersona['Contrasena'];
    $urlFoto = $datosPersona['Url_Foto'];
} 
?>