<?php

include '../config/db.php';

function validar($dato) { //Se crea la funcion para validar los datos
    return htmlspecialchars(stripslashes(trim($dato))); //Se purifican los datos para evitar errores con simbolos especiales, y demas inpedimentos
}

$nombre = validar($_POST['nombre']); //Se asigna la variable del nombre
$apellido = validar($_POST['apellido']); //Se asigna la variable del apellido
$tipo_doc = validar($_POST['tipo_documento']); //Se asigna la variable del tipo de documento
$documento = validar($_POST['documento']); //Se asigna la variable del numero de documento
$email = validar($_POST['email']); //Se asigna la variable del email
$cargo = validar($_POST['cargo']); //Se asigna la variable del cargo
$tipo_pqrs = validar($_POST['tipo_pqrs']); //Se asigna la variable del tipo de pqrs
$descripcion = validar($_POST['descripcion']); //Se asigna la variable de la descipción
$fecha_cre = date('Y-m-d'); //Se crea la fecha de creación
$estado = 1; //Se adsigna el estado por defecto (Pendiente)

if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) { // Se verifica si se ha cargado algún archivo sin errores
    $allowed_types = ['image/jpeg', 'image/png', 'application/pdf']; // Tipos de archivos admitidos
    if (in_array($_FILES['file']['type'], $allowed_types)) { //Se verifica si el archivo cargado esta entre los limites de lo permitido 
        if ($_FILES['file']['size'] <= 2097152) { // Tamaño máximo de 2MB
            $file_name = $_FILES['file']['name'];  //Se extrae el nombre del archivo 
            $file_tmp = $_FILES['file']['tmp_name'];  //Se extre la ubicación temporal del archivo
            $file_size = $_FILES['file']['size']; //Se obtiene el tamaño en Bytes del archivo
            $file_type = $_FILES['file']['type']; //Se obtiene el tipo de archivo o extensión
            $file_content = file_get_contents($file_tmp); //Obtiene el contenido del archivo

            $sql = "INSERT INTO archivos (nombre, tipo_archivo, tamaño, contenido) VALUES (?, ?, ?, ?)"; //Se crea la secuencia para ingresar el archivo
            $stmt = mysqli_prepare($conectar, $sql); //Se prepara la secuencia

            if ($stmt) { //Se verifica que exista la secuencia o que este preparada
                mysqli_stmt_bind_param($stmt, 'ssis', $file_name, $file_type, $file_size, $file_content); // Se asocian los parámetros
                if (mysqli_stmt_execute($stmt)) { //Se ejecuta la consulta
                    $ultimo_id = mysqli_insert_id($conectar); // Se obtiene el ID del archivo insertado
                    $sql1 = "INSERT INTO pqrss (nombres, apellidos, tipo_documento, numero_doc, email, cargo, tipo_pqrs, descripcion, id_archivo, fecha_cre, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; //Se crea la consulta para cargar los demas datos
                    $stmt1 = mysqli_prepare($conectar, $sql1); //Se prepara la conulta

                    if ($stmt1) { //Se verifica que exista la secuencia o que este preparada
                        mysqli_stmt_bind_param($stmt1, 'ssiisiisisi', $nombre, $apellido, $tipo_doc, $documento, $email, $cargo, $tipo_pqrs, $descripcion, $ultimo_id, $fecha_cre, $estado); //Se asocian los parámetros
                        if (mysqli_stmt_execute($stmt1)) { //Se ejecuta la consulta
                            if ($tipo_pqrs != 5) { // Redirige dependiendo del tipo de PQRS
                                header("Location: ../views/layouts/crear_pqrs.php?datos=enviados"); //Si el tipo de PQRS es diferente a una felicitación, este redirige para mostrar un mensaje
                            } else {
                                header("Location: ../views/layouts/crear_pqrs.php?datos=enviados5"); //De otra forma, redirige para mostrar otro mensaje
                            }
                        } else {
                            header("Location: ../views/layouts/crear_pqrs.php?datos=error"); //En caso de un error redirige, mostrando que hubo error
                        }
                        mysqli_stmt_close($stmt1); //Se cierra la conexión con la base de datos
                    } else {
                        header("Location: ../views/layouts/crear_pqrs.php?datos=error"); //En caso de un error redirige, mostrando que hubo error
                    }
                } else {
                    echo "Error al guardar el archivo."; //Escribe que hubo error y en que
                }
                mysqli_stmt_close($stmt); //Se cierra la conexión con la base de datos
            } else {
                echo "Error en la preparación de la consulta."; //Muestra qye hubo error al preparar la secuencia 
            }
        } else {
            header("Location: ../views/layouts/crear_pqrs.php?datos=error1"); // Error por tamaño de archivo
        }
    } else {
        echo "Tipo de archivo no permitido. Solo se permiten JPG, PNG y PDF."; //Si se carga un archivo diferente de los permitidos
    }
} else {
    // Si no se carga un archivo, se inserta el PQRS sin archivo
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
