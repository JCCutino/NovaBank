<?php
include 'conexion.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['IdChat']) && $_SESSION['IdChat'] !== null) {
   
    $idUsuarioActual = $_SESSION['Id_Persona'];
    $idUsuarioChat = $_SESSION['IdChat'];

    
    $query = "SELECT * FROM Mensajes WHERE (idEmisor = $idUsuarioActual AND idReceptor = $idUsuarioChat) OR (idEmisor = $idUsuarioChat AND idReceptor = $idUsuarioActual) ORDER BY id ASC";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
      
        echo "<div class='chat-container'>";
        while ($row = $result->fetch_assoc()) {
            $emisor = ($row['idEmisor'] == $idUsuarioActual) ? 'Tú' : 'Usuario ' . $row['idEmisor'];
            echo "<div class='mensaje'>$emisor: " . $row['mensaje'] . "</div>";
        }
        echo "</div>";
        
    } else {
        echo "<p>No hay mensajes aún.</p>";
    }
} else {
    echo "<p class='mt-3'>No se ha seleccionado ningún usuario para chatear.</p>";
}

   // Formulario para enviar mensajes
   echo "<form method='post' action='../funcionalidades/enviarMensaje.php'>";
   echo "<div class='mb-3'>";
   echo "<label for='mensaje' class='form-label'>Introducir mensaje:</label>";
   echo "<input type='text' class='form-control' name='mensaje' id='mensaje' placeholder='Introducir mensaje' required>";
   echo "</div>";
   echo "<button type='submit' class='btn btn-primary'>Enviar mensaje</button>";
   echo "</form>";
$conn->close();
?>