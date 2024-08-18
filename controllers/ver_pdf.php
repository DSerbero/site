<?php
include '../config/db.php';

$file_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT nombre, tipo_archivo, contenido FROM archivos WHERE id_archivo = ?";
$stmt = mysqli_prepare($conectar, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $file_id);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $file_name, $file_type, $file_content);
    mysqli_stmt_fetch($stmt);

    mysqli_stmt_close($stmt);

    if ($file_type === 'application/pdf') {
        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename=\"" . $file_name . "\"");
        echo $file_content;
    } else {
        echo "El archivo no es un PDF.";
    }
} else {
    echo "Error en la preparación de la consulta: " . mysqli_error($conectar);
}

// Cerrar la conexión
mysqli_close($conectar);
?>