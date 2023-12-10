<?php
include 'conexion.php';
session_start(); 

function actualizarNombre($conn, $nuevoNombre) {
    $correoElectronico = $_SESSION['correoElectronico'];
    $consultaUpdateNombre = "UPDATE Persona SET Nombre = '$nuevoNombre' WHERE Correo_Electronico = '$correoElectronico'";
    $resultadoUpdateNombre = $conn->query($consultaUpdateNombre);

    return $resultadoUpdateNombre;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["accion"])) {
        $accion = $_POST["accion"];

        switch ($accion) {
            case "actualizarNombre":
                if (isset($_POST["nuevoNombre"])) {
                    $nuevoNombre = $_POST["nuevoNombre"];
                    $resultado = actualizarNombre($conn, $nuevoNombre);

                    if ($resultado) {
                        header("Location: ../pagina_datos.php");
                        exit(); 
                    } else {
                        echo "Error al actualizar el nombre";
                    }
                } else {
                    echo "Parámetros insuficientes para la acción actualizarNombre";
                }
                break;
        }
    } else {
        echo "Acción no especificada";
    }
} else {
    echo "Solicitud no válida";
}

$conn->close();
?>
