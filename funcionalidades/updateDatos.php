<?php
include 'conexion.php';
session_start(); 

function actualizarNombre($conn, $nuevoNombre) {
    $correoElectronico = $_SESSION['correoElectronico'];
    $consultaUpdateNombre = "UPDATE Persona SET Nombre = '$nuevoNombre' WHERE Correo_Electronico = '$correoElectronico'";
    $resultadoUpdateNombre = $conn->query($consultaUpdateNombre);

    return $resultadoUpdateNombre;
}
function actualizarApellido($conn, $nuevoApellido) {
    $correoElectronico = $_SESSION['correoElectronico'];
    $consultaUpdateApellido = "UPDATE Persona SET Apellidos = '$nuevoApellido' WHERE Correo_Electronico = '$correoElectronico'";
    $resultadoUpdateApellido = $conn->query($consultaUpdateApellido);
    
    return $resultadoUpdateApellido;
}

function actualizarFechaNacimiento($conn, $nuevaFechaNacimiento) {
    $correoElectronico = $_SESSION['correoElectronico'];
    $consultaUpdateFechaNacimiento = "UPDATE Persona SET Fecha_nacimiento = '$nuevaFechaNacimiento' WHERE Correo_Electronico = '$correoElectronico'";
    $resultadoUpdateFechaNacimiento = $conn->query($consultaUpdateFechaNacimiento);

    return $resultadoUpdateFechaNacimiento;
}

function actualizarDireccion($conn, $nuevaDireccion) {
    $correoElectronico = $_SESSION['correoElectronico'];
    $consultaUpdateDireccion = "UPDATE Persona SET Direccion = '$nuevaDireccion' WHERE Correo_Electronico = '$correoElectronico'";
    $resultadoUpdateDireccion = $conn->query($consultaUpdateDireccion);

    return $resultadoUpdateDireccion;
}

function actualizarCodigoPostal($conn, $nuevoCodigoPostal) {
    $correoElectronico = $_SESSION['correoElectronico'];
    $consultaUpdateCodigoPostal = "UPDATE Persona SET CP = '$nuevoCodigoPostal' WHERE Correo_Electronico = '$correoElectronico'";
    $resultadoUpdateCodigoPostal = $conn->query($consultaUpdateCodigoPostal);

    return $resultadoUpdateCodigoPostal;
}

function actualizarCiudad($conn, $nuevaCiudad) {
    $correoElectronico = $_SESSION['correoElectronico'];
    $consultaUpdateCiudad = "UPDATE Persona SET Ciudad = '$nuevaCiudad' WHERE Correo_Electronico = '$correoElectronico'";
    $resultadoUpdateCiudad = $conn->query($consultaUpdateCiudad);

    return $resultadoUpdateCiudad;
}

function actualizarProvincia($conn, $nuevaProvincia) {
    $correoElectronico = $_SESSION['correoElectronico'];
    $consultaUpdateProvincia = "UPDATE Persona SET Provincia = '$nuevaProvincia' WHERE Correo_Electronico = '$correoElectronico'";
    $resultadoUpdateProvincia = $conn->query($consultaUpdateProvincia);

    return $resultadoUpdateProvincia;
}

function actualizarPais($conn, $nuevoPais) {
    $correoElectronico = $_SESSION['correoElectronico'];
    $consultaUpdatePais = "UPDATE Persona SET Pais = '$nuevoPais' WHERE Correo_Electronico = '$correoElectronico'";
    $resultadoUpdatePais = $conn->query($consultaUpdatePais);

    return $resultadoUpdatePais;
}
function actualizarContrasena($conn, $nuevaContrasena) {
    $correoElectronico = $_SESSION['correoElectronico'];
    $nuevaContrasenaHasheada = password_hash($nuevaContrasena, PASSWORD_DEFAULT);
    
    $consultaUpdateContrasena = $conn->prepare("UPDATE Persona SET Contrasena = ? WHERE Correo_Electronico = ?");
    $consultaUpdateContrasena->bind_param("ss", $nuevaContrasenaHasheada, $correoElectronico);
    
    if ($consultaUpdateContrasena->execute()) {
  
        session_regenerate_id(true);
        return true; 
    } else {
       
        echo "Error en la consulta: " . $conn->error;
        return false; 
    }
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
            
                case "actualizarApellido":
                    echo "PRUEBA";
                    if (isset($_POST["nuevoApellido"])) {
                        $nuevoApellido = $_POST["nuevoApellido"];
                        $resultado = actualizarApellido($conn, $nuevoApellido);
                
                        if ($resultado) {
                            header("Location: ../pagina_datos.php");
                            exit(); 
                        } else {
                            echo "Error al actualizar el apellido";
                        }
                    } else {
                        echo "Parámetros insuficientes para la acción actualizarApellido";
                    }
                    break;
                
             case "actualizarFechaNacimiento":
                if (isset($_POST["nuevaFechaNacimiento"])) {
                    $nuevaFechaNacimiento = $_POST["nuevaFechaNacimiento"];
                    $resultado = actualizarFechaNacimiento($conn, $nuevaFechaNacimiento);

                    if ($resultado) {
                        header("Location: ../pagina_datos.php");
                        exit(); 
                    } else {
                        echo "Error al actualizar la fecha de nacimiento";
                    }
                } else {
                    echo "Parámetros insuficientes para la acción actualizarFechaNacimiento";
                }
                break;
                
             case "actualizarDireccion":
                if (isset($_POST["nuevaDireccion"])) {
                    $nuevaDireccion = $_POST["nuevaDireccion"];
                    $resultado = actualizarDireccion($conn, $nuevaDireccion);

                    if ($resultado) {
                        header("Location: ../pagina_datos.php");
                        exit(); 
                    } else {
                        echo "Error al actualizar la dirección";
                    }
                } else {
                    echo "Parámetros insuficientes para la acción actualizarDireccion";
                }
                break;

                case "actualizarCodigoPostal":
                    if (isset($_POST["nuevoCodigoPostal"])) {
                        $nuevoCodigoPostal = $_POST["nuevoCodigoPostal"];
                        $resultado = actualizarCodigoPostal($conn, $nuevoCodigoPostal);
    
                        if ($resultado) {
                            header("Location: ../pagina_datos.php");
                            exit(); 
                        } else {
                            echo "Error al actualizar el código postal";
                        }
                    } else {
                        echo "Parámetros insuficientes para la acción actualizarCodigoPostal";
                    }
                    break;

                 case "actualizarCiudad":
                if (isset($_POST["nuevaCiudad"])) {
                    $nuevaCiudad = $_POST["nuevaCiudad"];
                    $resultado = actualizarCiudad($conn, $nuevaCiudad);

                    if ($resultado) {
                        header("Location: ../pagina_datos.php");
                        exit(); 
                    } else {
                        echo "Error al actualizar la ciudad";
                    }
                } else {
                    echo "Parámetros insuficientes para la acción actualizarCiudad";
                }
                break;

             case "actualizarProvincia":
                if (isset($_POST["nuevaProvincia"])) {
                    $nuevaProvincia = $_POST["nuevaProvincia"];
                    $resultado = actualizarProvincia($conn, $nuevaProvincia);

                    if ($resultado) {
                        header("Location: ../pagina_datos.php");
                        exit(); 
                    } else {
                        echo "Error al actualizar la provincia";
                    }
                } else {
                    echo "Parámetros insuficientes para la acción actualizarProvincia";
                }
                break;

            case "actualizarPais":
                if (isset($_POST["nuevoPais"])) {
                    $nuevoPais = $_POST["nuevoPais"];
                    $resultado = actualizarPais($conn, $nuevoPais);

                    if ($resultado) {
                        header("Location: ../pagina_datos.php");
                        exit(); 
                    } else {
                        echo "Error al actualizar el país";
                    }
                } else {
                    echo "Parámetros insuficientes para la acción actualizarPais";
                }
                break;

            case "actualizarContrasena":
                if (isset($_POST["nuevaContrasena"])) {
                    $nuevoPais = $_POST["nuevaContrasena"];


                    $resultado = actualizarContrasena($conn, $nuevaContrasena);

                    if ($resultado) {
                        header("Location: ../pagina_datos.php");
                        exit(); 
                    } else {
                        echo "Error al actualizar la contraseña";
                    }
                } else {
                    echo "Parámetros insuficientes para la acción actualizarContrasena";
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
