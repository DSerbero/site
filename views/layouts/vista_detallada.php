<?php
include '../../config/db.php'; // Se incluye el archivo de configuración de la base de datos
include '../../controllers/sesion.php'; // Se incluye el archivo para manejar la sesión
$id_solicitud = $_GET['id']; // Se obtiene el ID de la solicitud desde la URL
$sql = "SELECT * FROM pqrss WHERE id_solicitud = '$id_solicitud'"; // Consulta SQL para obtener los datos de la solicitud
$result = mysqli_query($conectar, $sql); // Se ejecuta la consulta y se almacena el resultado

if (isset($_SESSION['usuario'])) { // Verifica si la sesión está activa
?>
    <!doctype html>
    <html>

    <head>
        <title>Vista detallada</title>
        <link rel="stylesheet" href="../../assets/css/vista_detallada.css" /> <!-- Se cargan los estilos -->
        <link rel="icon" href="../../assets/img/iebs.png"> <!-- Se establece el favicon -->
    </head>

    <body>
        <div class="preloader"> <!-- Preloader -->
            <div class="preloader-logo">
                <a class="brand" href="index1.html">
                    <img class="brand-logo-dark" src="../../assets/img/iebs.png" alt="" width="245" height="250" />
                </a>
            </div>
            <div class="preloader-body">
                <div class="cssload-container">
                    <div class="cssload-speeding-wheel"></div>
                </div>
            </div>
        </div>
        <header>
            <?php include '../../models/header_4.php'; ?> <!-- Se incluye el header -->
        </header>
        <main>
            <div class='contenedor_prin'>
                <h2>Información de la Solicitud</h2>
                <?php
                foreach ($result as $datos) { // Se recorre cada fila del resultado de la consulta
                ?>
                    <p><b>Nombres:</b> <?php echo $datos['nombres']; ?></p> <!-- Muestra los nombres -->
                    <p><b>Apellidos:</b> <?php echo $datos['apellidos']; ?></p> <!-- Muestra los apellidos -->
                    <p><b>
                            <?php
                            $tipo_doc = $datos['tipo_documento']; // Obtiene el tipo de documento
                            $sql_tipodoc = "SELECT tipo FROM tipos_doc WHERE id_documento='$tipo_doc'"; // Consulta para obtener el tipo de documento
                            $result_tipodoc = mysqli_query($conectar, $sql_tipodoc); // Ejecuta la consulta
                            foreach ($result_tipodoc as $typedoc_show) { // Recorre los resultados
                                echo $typedoc_show['tipo'], ":"; // Muestra el tipo de documento
                            }
                            ?>
                        </b>
                        <?php echo $datos['numero_doc']; ?></p> <!-- Muestra el número de documento -->
                    <p><b>E-mail:</b> <?php echo $datos['email']; ?></p> <!-- Muestra el email -->
                    <p><b>Cargo:</b>
                        <?php
                        $cargo = $datos['cargo']; // Obtiene el cargo
                        $sql_cargo = "SELECT cargo FROM cargos WHERE id_cargo='$cargo'"; // Consulta para obtener el cargo
                        $result_cargo = mysqli_query($conectar, $sql_cargo); // Ejecuta la consulta
                        foreach ($result_cargo as $cargo_show) {
                            echo $cargo_show['cargo']; // Muestra el cargo
                        }
                        ?>
                    </p>
                    <p><b>Tipo:</b>
                        <?php
                        $tipo_pqrs = $datos['tipo_pqrs']; // Obtiene el tipo de PQRS
                        $sql_pqrs = "SELECT tipo FROM tipos_pqrs WHERE id_tipopqrs='$tipo_pqrs'"; // Consulta para obtener el tipo de PQRS
                        $result_pqrs = mysqli_query($conectar, $sql_pqrs); // Ejecuta la consulta
                        foreach ($result_pqrs as $pqrs_show) {
                            echo $pqrs_show['tipo']; // Muestra el tipo de PQRS
                        }
                        ?>
                    </p>
                    <p><b>Fecha de creación:</b>
                        <?php
                        $fecha = $datos['fecha_cre']; // Obtiene la fecha de creación
                        $fecha = date("d/m/Y", strtotime($fecha)); // Formatea la fecha
                        echo $fecha; // Muestra la fecha de creación
                        ?>
                    </p>
                    <p class='description'>
                        <b>Descripción:</b>
                        <?php echo $datos['descripcion']; ?> <!-- Muestra la descripción -->
                    </p>
                    <?php
                    if ($datos['id_archivo'] != null) { // Verifica si hay un archivo asociado
                        $sql_archivo = "SELECT nombre, tipo_archivo, contenido FROM archivos WHERE id_archivo = ?"; // Consulta para obtener los detalles del archivo
                        $stmt = mysqli_prepare($conectar, $sql_archivo); // Prepara la consulta
                        $id_archivo = $datos['id_archivo']; // Obtiene el ID del archivo
                        if ($stmt) {
                            mysqli_stmt_bind_param($stmt, 'i', $id_archivo); // Asigna el ID del archivo al parámetro

                            mysqli_stmt_execute($stmt); // Ejecuta la consulta

                            mysqli_stmt_bind_result($stmt, $file_name, $file_type, $file_content); // Asigna los resultados a variables
                            mysqli_stmt_fetch($stmt); // Obtiene los resultados

                            mysqli_stmt_close($stmt); // Cierra la declaración
                            if (strpos($file_type, 'image/') !== false) { // Verifica si el archivo es una imagen
                                $base64 = base64_encode($file_content); // Codifica el contenido en base64
                                echo '<img src="data:' . $file_type . ';base64,' . $base64 . '" alt="' . $file_name . '">'; // Muestra la imagen
                            } else if ($file_type === 'application/pdf') { // Verifica si el archivo es un PDF
                                $escaped_file_name = htmlspecialchars($file_name, ENT_QUOTES, 'UTF-8'); // Escapa el nombre del archivo
                                echo '<iframe src="../../controllers/ver_pdf.php?id=' . urlencode($id_archivo) . '" frameborder="0"></iframe>'; // Muestra el PDF en un iframe
                            }
                        }
                    }
                    ?>
                    <?php
                    $estado = $datos['estado']; // Obtiene el estado de la solicitud
                    if ($estado == 1 || $estado == 2) { // Verifica si el estado es Pendiente o En Proceso
                    ?>
                        <p>Días restantes: <b><?php
                                                $fecha_now = new DateTime(); // Obtiene la fecha actual
                                                $fecha_new = new DateTime($datos['fecha_cre']); // Crea un objeto DateTime con la fecha de creación
                                                $dias = 11; // Días para completar la solicitud
                                                $fecha_new->modify("+$dias days"); // Suma los días a la fecha de creación
                                                $fecha_new->format('Y-m-d'); // Formatea la fecha
                                                $diferencia = $fecha_new->diff($fecha_now); // Calcula la diferencia entre las fechas
                                                $dias_restantes = $diferencia->days; // Obtiene el número de días restantes
                                                echo $dias_restantes; // Muestra los días restantes
                                                ?></b></p>
                    <?php
                    }
                    ?>
                    <div class="cuadro_estado">
                        <div id='estado'>
                            <?php
                            $sql_estado = "SELECT estado FROM estado WHERE id_estado='$estado'"; // Consulta para obtener el estado
                            $result_estado = mysqli_query($conectar, $sql_estado); // Ejecuta la consulta
                            foreach ($result_estado as $valor_show) {
                            ?>
                                <p id="estado_actual" class="<?php echo $valor_show['estado'] ?>">
                                    <?php echo $valor_show['estado']; // Muestra el estado actual 
                                    ?>
                                </p>
                            <?php } ?>
                            <div id="formulario_container" style="display:none;">
                                <form action='../../controllers/actualizar_estado.php?id=<?php echo $id_solicitud; ?>' method='post'>
                                    <select name='select' class="select_de">
                                        <option value="1">Pendiente</option>
                                        <option value="2">En proceso</option>
                                        <option value="3">Respondido</option>
                                    </select>
                                    <input type="submit" class="enviar_btn" value="Guardar">
                                </form>
                            </div>
                        </div>
                        <input type='button' value='Cambiar estado' id='cambiar_estado'>
                    </div>
                <?php
                }
                ?>
            </div>
        </main>
        <footer>
            <?php include '../../models/footer_1.php'; ?> <!-- Se incluye el footer -->
        </footer>
        <script src="../../assets/js/scroll.js"></script> <!-- Script para el scroll -->
        <script src="../../assets/js/animation.js"></script> <!-- Script para animaciones -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cambiar_estado = document.getElementById('cambiar_estado'); // Botón para cambiar estado
                const formulario_container = document.getElementById('formulario_container'); // Contenedor del formulario
                const estado_actual = document

                    .getElementById('estado_actual'); // Estado actual

                cambiar_estado.addEventListener('click', function() { // Evento click para mostrar el formulario
                    formulario_container.style.display = 'block';
                    cambiar_estado.style.display = 'none';
                    estado_actual.style.display = 'none';
                });

                formulario_container.querySelector('form').addEventListener('submit', function() { // Evento submit para ocultar el formulario
                    formulario_container.style.display = 'none';
                });
            });
        </script>

    </html>

<?php
} else {
    header("Location: ./admin_view.php"); // Redirige si no hay sesión activa
}
?>
