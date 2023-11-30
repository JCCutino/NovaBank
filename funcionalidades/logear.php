<?php
include 'conexion.php';
session_start(); 
$correoElectronico = $_POST["correo_login"];
$contrasena = $_POST["contrasena_login"];

$query = "SELECT Id_Persona, Contrasena FROM Persona WHERE Correo_Electronico = '$correoElectronico'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row["Contrasena"];
  
    if (password_verify($contrasena, $hashedPassword)) {
     header ("location: ../pagina_principal.php");
     $_SESSION['correoElectronico'] = $correoElectronico;
    } else {
        header ("location: ../index.php");
    }
} else {
    echo "Usuario no existe";
}


$conn->close();
?>