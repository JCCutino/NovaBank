<?php
include 'conexion.php';
function mostrarPrestamosPendientes($conn){
    $query = "SELECT * FROM Prestamo WHERE Estado_Prestamo = 'Pendiente'";

    $result = $conn->query($query);

    if ($result) {
        echo '<div class="table-responsive">';
        echo '<table class="table bg-white">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Cantidad</th>';
        echo '<th>Concepto</th>';
        echo '<th>Fecha Solicitud</th>';
        echo '<th>ID Persona</th>';
        echo '<th>IBAN</th>';
        echo '<th>Acciones</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['ID_Prestamo'] . '</td>';
            echo '<td>' . $row['Cantidad'] . '</td>';
            echo '<td>' . $row['Concepto'] . '</td>';
            echo '<td>' . $row['Fecha_Solicitud'] . '</td>';
            echo '<td>' . $row['ID_Persona'] . '</td>';
            echo '<td>' . $row['IBAN'] . '</td>';
            echo '<td><button class="btn btn-primary" onclick="mostrarDetalles(' . $row['ID_Prestamo'] . ')" data-bs-toggle="modal" data-bs-target="#detalleModal" data-id="' . $row['ID_Prestamo'] . '" data-cantidad="' . $row['Cantidad'] . '" data-concepto="' . $row['Concepto'] . '" data-fecha="' . $row['Fecha_Solicitud'] . '" data-idpersona="' . $row['ID_Persona'] . '" data-iban="' . $row['IBAN'] . '">Mostrar Detalles</button></td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';

        if ($result->num_rows == 0) {
            echo '<p class="text-center">No hay préstamos pendientes.</p>';
        }
    } else {
        echo 'Error al ejecutar la consulta: ' . $conn->error;
    }
}


function mostrarPrestamosAceptados($conn){
    $query = "SELECT ID_Prestamo, Cantidad, Concepto, Tasa_Interes, Plazo_Prestamo, Estado_Prestamo, Fecha_Solicitud, Fecha_Aprobacion, Fecha_Pago, Deuda, ID_Persona, IBAN FROM Prestamo WHERE Estado_Prestamo = 'Aceptado'";

    $result = $conn->query($query);

    if ($result) {
        echo '<div class="table-responsive">';
        echo '<table class="table bg-white">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Cantidad</th>';
        echo '<th>Concepto</th>';
        echo '<th>Tasa de Interés</th>';
        echo '<th>Plazo del Préstamo</th>';
        echo '<th>Estado</th>';
        echo '<th>Fecha Solicitud</th>';
        echo '<th>Fecha Aprobación</th>';
        echo '<th>Fecha Pago</th>';
        echo '<th>Deuda</th>';
        echo '<th>ID Persona</th>';
        echo '<th>IBAN</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['Cantidad'] . '</td>';
            echo '<td>' . $row['Concepto'] . '</td>';
            echo '<td>' . $row['Tasa_Interes'] . '</td>';
            echo '<td>' . $row['Plazo_Prestamo'] . '</td>';
            echo '<td>' . $row['Estado_Prestamo'] . '</td>';
            echo '<td>' . $row['Fecha_Solicitud'] . '</td>';
            echo '<td>' . $row['Fecha_Aprobacion'] . '</td>';
            echo '<td>' . $row['Fecha_Pago'] . '</td>';
            echo '<td>' . $row['Deuda'] . '</td>';
            echo '<td>' . $row['ID_Persona'] . '</td>';
            echo '<td>' . $row['IBAN'] . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';

        if ($result->num_rows == 0) {
            echo '<p class="text-center">No hay préstamos aceptados.</p>';
        }
    } else {
        echo 'Error al ejecutar la consulta: ' . $conn->error;
    }
}




?>