<?php
include 'conexion.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$idUsuarioActual = isset($_SESSION['Id_Persona']) ? $_SESSION['Id_Persona'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['seleccionarUsuario'])) {
    $_SESSION['IdChat'] = $_POST['seleccionarUsuario'];
    header("location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

$result = $conn->query("SELECT ID_Persona, Nombre, Apellidos FROM Persona");

if ($result->num_rows > 0) {
    echo "<h2 class='mt-3'>Lista de Usuarios</h2>";
    echo "<form method='post' action='../funcionalidades/chatAdmin.php'>";
    echo "<div id='containerUsuarios' class='p-3 border rounded d-flex flex-column'>";
    while ($row = $result->fetch_assoc()) {
        $nombreChat = $row['Nombre'] . ' ' . $row['Apellidos'];

        if ($row['ID_Persona'] != $idUsuarioActual) {
            echo "<button type='submit' class='btn btn-success m-1 usuarioButton' name='seleccionarUsuario' value='" . $row['ID_Persona'] . "'>" . $nombreChat . "</button>";
        }
    }
    echo "</div>";
    echo "</form>";
} else {
    echo "<p class='mt-3'>No hay más usuarios.</p>";
}

$conn->close();
?>
