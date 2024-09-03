<?php

include '../config/db.php';

function validar($dato) {
    return htmlspecialchars(stripslashes(trim($dato)));
}

$nombre = validar($_POST['nombre']);
$apellido = validar($_POST['apellido']);
$tipo_doc = validar($_POST['tipo_documento']);
$documento = validar($_POST['documento']);
$email = validar($_POST['email']);
$cargo = validar($_POST['cargo']);
$tipo_pqrs = validar($_POST['tipo_pqrs']);
$descripcion = validar($_POST['descripcion']);
$fecha_cre = date('Y-m-d');
$estado = 1;

if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
    if (in_array($_FILES['file']['type'], $allowed_types)) {
        if ($_FILES['file']['size'] <= 2097152) {
            $file_name = $_FILES['file']['name'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_size = $_FILES['file']['size'];
            $file_type = $_FILES['file']['type'];
            $file_content = file_get_contents($file_tmp);

            $sql = "INSERT INTO archivos (nombre, tipo_archivo, tamaño, contenido) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conectar, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'ssis', $file_name, $file_type, $file_size, $file_content);
                if (mysqli_stmt_execute($stmt)) {
                    $ultimo_id = mysqli_insert_id($conectar);
                    $sql1 = "INSERT INTO pqrss (nombres, apellidos, tipo_documento, numero_doc, email, cargo, tipo_pqrs, descripcion, id_archivo, fecha_cre, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ? , ?, ?)";
                    $stmt1 = mysqli_prepare($conectar, $sql1);

                    if ($stmt1) {
                        mysqli_stmt_bind_param($stmt1, 'ssiisiisisi', $nombre, $apellido, $tipo_doc, $documento, $email, $cargo, $tipo_pqrs, $descripcion, $ultimo_id, $fecha_cre, $estado);
                        if (mysqli_stmt_execute($stmt1)) {
                            if ($tipo_pqrs != 5) {
                                header("Location: ../views/layouts/crear_pqrs.php?datos=enviados");
                            } else {
                                header("Location: ../views/layouts/crear_pqrs.php?datos=enviados5");
                            }
                        } else {
                            header("Location: ../views/layouts/crear_pqrs.php?datos=error");
                        }
                        mysqli_stmt_close($stmt1);
                    } else {
                        header("Location: ../views/layouts/crear_pqrs.php?datos=error");
                    }
                } else {
                    echo "Error al guardar el archivo.";
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Error en la preparación de la consulta.";
            }
        } else {
            header("Location: ../views/layouts/crear_pqrs.php?datos=error1");
        }
    } else {
        echo "Tipo de archivo no permitido. Solo se permiten JPG, PNG y PDF.";
    }
} else {
    $sql = "INSERT INTO pqrss (nombres, apellidos, tipo_documento, numero_doc, email, cargo, tipo_pqrs, descripcion, fecha_cre, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conectar, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssiisiissi', $nombre, $apellido, $tipo_doc, $documento, $email, $cargo, $tipo_pqrs, $descripcion, $fecha_cre, $estado);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../views/layouts/crear_pqrs.php?datos=enviados");
        } else {
            header("Location: ../views/layouts/crear_pqrs.php?datos=error");
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../views/layouts/crear_pqrs.php?datos=error");
    }
}

mysqli_close($conectar);
?>
