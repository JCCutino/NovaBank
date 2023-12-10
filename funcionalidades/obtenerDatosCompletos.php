<?php

include 'conexion.php';

    $correoElectronico = $_SESSION['correoElectronico'];
   
    $consultaNombreApellido = "SELECT Nombre, Apellidos, DNI, Fecha_nacimiento, Direccion, CP, Ciudad, Provincia, Pais, Correo_Electronico, Contrasena, Url_Foto FROM Persona WHERE Correo_Electronico = '$correoElectronico'";
    $resultado = $conn->query($consultaNombreApellido);
    
    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        
      
        function obtenerValor($valor) {
            return $valor !== null ? $valor : 'Dato inexistente';
        }
    
        $nombre = obtenerValor($row['Nombre']);
        $apellidos = obtenerValor($row['Apellidos']);
        $dni = obtenerValor($row['DNI']);
        $fechaNacimiento = obtenerValor($row['Fecha_nacimiento']);
        $direccion = obtenerValor($row['Direccion']);
        $codigoPostal = obtenerValor($row['CP']);
        $ciudad = obtenerValor($row['Ciudad']);
        $provincia = obtenerValor($row['Provincia']);
        $pais = obtenerValor($row['Pais']);
        $correoElectronico = obtenerValor($row['Correo_Electronico']);
        $contrasena = obtenerValor($row['Contrasena']);
        $urlFoto = obtenerValor($row['Url_Foto']);
    } else {
      
        $nombre = $apellidos = $dni = $fechaNacimiento = $direccion = $codigoPostal = $ciudad = $provincia = $pais = $correoElectronico = $contrasena = $urlFoto = '';
    }
    


$conn->close();

?>