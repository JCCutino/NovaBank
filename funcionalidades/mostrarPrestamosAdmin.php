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




?>