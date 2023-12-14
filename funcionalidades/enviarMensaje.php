<?php

include 'conexion.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (isset($_SESSION['IdChat']) && $_SESSION['IdChat'] !== null) {

    $idUsuarioActual = $_SESSION['Id_Persona'];
    $idUsuarioChat = $_SESSION['IdChat'];

    $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';

    $query = "INSERT INTO Mensajes (mensaje, idEmisor, idReceptor) VALUES ('$mensaje', $idUsuarioActual, $idUsuarioChat)";
    $result = $conn->query($query);

    header("location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    header("location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

$conn->close();
?>
