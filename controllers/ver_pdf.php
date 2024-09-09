<?php
include '../config/db.php'; //Se incluye la conexión a la base de datos

$file_id = isset($_GET['id']) ? (int)$_GET['id'] : 0; //Se verifica que exista el id, de otra forma se asigan 0

$sql = "SELECT nombre, tipo_archivo, contenido FROM archivos WHERE id_archivo = ?"; //Se crea la secuencia para llamar el archivo
$stmt = mysqli_prepare($conectar, $sql); //Se prepara la secuencia

if ($stmt) { //Se verifica que la Secuencia este creada o preparada
    mysqli_stmt_bind_param($stmt, 'i', $file_id); //Se asigna el valor a la secuencia

    mysqli_stmt_execute($stmt); //Se ejecuta la secuencia

    mysqli_stmt_bind_result($stmt, $file_name, $file_type, $file_content); //Asigna los resultados a las variables
    mysqli_stmt_fetch($stmt); // Obtiene los resultados

    mysqli_stmt_close($stmt);// Cierra la declaración

    if ($file_type === 'application/pdf') { //Se verifica si es un pdf
        header("Content-Type: application/pdf"); //Establece el tipo de documento como pdf
        header("Content-Disposition: inline; filename=\"" . $file_name . "\""); //Define que se mostrara en la linea no cargable
        echo $file_content; //Envia el contenido del documento al navegador
    } else {
        echo "El archivo no es un PDF."; //Se muestra el mensaje de error en caso de no ser un PDF
    }
} else {
    echo "Error en la preparación de la consulta: " . mysqli_error($conectar); //Error en caso de que falle la consulta
}

// Cerrar la conexión
mysqli_close($conectar); //Se cierra la conexión a la base de datos
?>