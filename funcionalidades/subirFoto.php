<?php
include 'conexion.php';
session_start(); 


function procesarFormularioFoto($conn) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_FILES['foto'])) {
            $carpeta_destino = '../img/fp/';
            $nombre_archivo = $carpeta_destino . basename($_FILES['foto']['name']);

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $nombre_archivo)) {
                
                $nombre_archivo_db = $_FILES['foto']['name'];

                subirRutaFotoABaseDeDatos($nombre_archivo_db, $conn);

                return "La foto se ha subido y registrado en la base de datos.";
            } else {
                return "Error al subir la foto.";
            }
        } else {
            return "No se ha seleccionado ningún archivo.";
        }
    } else {
        return "Acceso no autorizado.";
    }
}

function subirRutaFotoABaseDeDatos( $nombre_archivo_db, $conn) {
    
    $idPersona = $_SESSION['Id_Persona']; 

    $stmt = $conn->prepare("UPDATE Persona SET Url_Foto = ? WHERE ID_Persona = ?");
    $stmt->bind_param("si", $nombre_archivo_db, $idPersona);

    $stmt->execute();

    $stmt->close();
    $conn->close();
}



$resultado = procesarFormularioFoto($conn);
echo $resultado;



?>



