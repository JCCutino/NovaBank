<?php
include 'conexion.php';

function obtenerTransaccionesPorIBAN($conn) {
    
    $IBAN = $_SESSION['IBAN'];

  
    $consultaTransacciones = $conn->prepare("SELECT ID_Transaccion, Tipo_Transaccion, Cantidad, Fecha_Hora FROM Transaccion WHERE IBAN = ?");
    $consultaTransacciones->bind_param("s", $IBAN);
    $consultaTransacciones->execute();
    $resultadoTransacciones = $consultaTransacciones->get_result();

   
    if ($resultadoTransacciones->num_rows > 0) {
       
        $transacciones = array();

       
        while ($fila = $resultadoTransacciones->fetch_assoc()) {
          
            $transacciones[] = $fila;
        }

      
        return $transacciones;
    } else {
        
        return array();
    }
}

$transacciones = obtenerTransaccionesPorIBAN($conn);

?>