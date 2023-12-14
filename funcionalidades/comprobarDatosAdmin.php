<?php
if (isset($_SESSION['datosPersona']) && isset($_SESSION['datosCuenta'])) {
    $datosPersona = $_SESSION['datosPersona'];
    $datosCuenta = $_SESSION['datosCuenta'];

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

    $iban = $datosCuenta['IBAN'];
    $saldoDatos = $datosCuenta['Saldo'];
    $fechaApertura = $datosCuenta['Fecha_Apertura'];
    $idPersonaCuenta = $datosCuenta['ID_Persona'];
} 
?>

?>