<?php
include '../../config/db.php';
include '../../controllers/sesion.php';
$id_solicitud = $_GET['id'];
$sql = "SELECT * FROM pqrss WHERE id_solicitud = '$id_solicitud'";
$result = mysqli_query($conectar, $sql);

if (isset($_SESSION['usuario'])) {
    ?>
    <!doctype html>
    <html>
        <head>
            <title>Vista detallada</title>
            <link rel="stylesheet" href="../../assets/css/vista_detallada.css"/>
            <link rel="icon" href="../../assets/img/iebs.png">
        </head>
        <body>
            <div class="preloader">
                <div class="preloader-logo"><a class="brand" href="index1.html"><img class="brand-logo-dark"
                                                                                     src="../../assets/img/iebs.png" alt="" width="245" height="250" /></a>
                </div>
                <div class="preloader-body">
                    <div class="cssload-container">
                        <div class="cssload-speeding-wheel"></div>
                    </div>
                </div>
            </div>
            <header>
                <?php
                include '../../models/header_4.php';
                ?>
            </header
            <main>
                <div class='contenedor_prin'>
                    <h2>Información de la Solicitud</h2>
                    <?php
                    foreach ($result as $datos) {
                        ?>
                        <p><b>Nombres:</b> <?php echo $datos['nombres']; ?></p>
                        <p><b>Apellidos:</b> <?php echo $datos['apellidos']; ?></p>
                        <p><b><?php
                                $tipo_doc = $datos['tipo_documento'];
                                $sql_tipodoc = "SELECT tipo FROM tipos_doc WHERE id_documento='$tipo_doc'";
                                $result_tipodoc = mysqli_query($conectar, $sql_tipodoc);
                                foreach ($result_tipodoc as $typedoc_show) {
                                    echo $typedoc_show['tipo'], ":";
                                }
                                ?>
                            </b>
                            <?php echo $datos['numero_doc']; ?>
                        </p>
                        <p><b>E-mail:</b> <?php echo $datos['email']; ?></p>
                        <p><b>Cargo:</b> 
                            <?php
                            $cargo = $datos['cargo'];
                            $sql_cargo = "SELECT cargo FROM cargos WHERE id_cargo='$cargo'";
                            $result_cargo = mysqli_query($conectar, $sql_cargo);
                            foreach ($result_cargo as $cargo_show) {
                                echo $cargo_show['cargo'];
                            }
                            ?>
                        </p>
                        <p><b>Tipo:</b> 
                            <?php
                            $tipo_pqrs = $datos['tipo_pqrs'];
                            $sql_pqrs = "SELECT tipo FROM tipos_pqrs WHERE id_tipopqrs='$tipo_pqrs'";
                            $result_pqrs = mysqli_query($conectar, $sql_pqrs);
                            foreach ($result_pqrs as $pqrs_show) {
                                echo $pqrs_show['tipo'];
                            }
                            ?>
                        </p>
                        <p><b>Fecha de creación:</b>
                            <?php
                            $fecha = $datos['fecha_cre'];
                            $fecha = date("d/m/Y", strtotime($fecha));
                            echo $fecha;
                            ?>
                        </p>
                        <p class='description'>
                            <b>Descripción:</b>
                            <?php echo $datos['descripcion']; ?>
                        </p>
                        <?php
                        if ($datos['id_archivo'] != null) {
                            $sql_archivo = "SELECT nombre, tipo_archivo, contenido FROM archivos WHERE id_archivo = ?";
                            $stmt = mysqli_prepare($conectar, $sql_archivo);
                            $id_archivo = $datos['id_archivo'];
                            if ($stmt) {
                                mysqli_stmt_bind_param($stmt, 'i', $id_archivo);

                                mysqli_stmt_execute($stmt);

                                mysqli_stmt_bind_result($stmt, $file_name, $file_type, $file_content);
                                mysqli_stmt_fetch($stmt);

                                mysqli_stmt_close($stmt);
                                if (strpos($file_type, 'image/') !== false) {
                                    $base64 = base64_encode($file_content);
                                    echo '<img src="data:' . $file_type . ';base64,' . $base64 . '" alt="' . $file_name . '">';
                                } else if ($file_type === 'application/pdf') {
                                    $escaped_file_name = htmlspecialchars($file_name, ENT_QUOTES, 'UTF-8');
                                    echo '<iframe src="../../controllers/ver_pdf.php?id=' . urlencode($id_archivo) . '" frameborder="0"></iframe>';
                                }
                            }
                        }
                        ?>
                        <p>Dias restantes: 
                            <b>
                                <?php
                                $fecha_now = new DateTime();
                                $fecha_new = new DateTime($datos['fecha_cre']);
                                $dias = 11;
                                $fecha_new->modify("+$dias days");
                                $fecha_new->format('Y-m-d');
                                $diferencia = $fecha_new->diff($fecha_now);
                                $dias_restantes = $diferencia->days;
                                echo $dias_restantes;
                                ?>
                            </b>
                        </p>
                        <div class="cuadro_estado">
                            <div id='estado'>
                                <?php
                                $estado = $datos['estado'];
                                $sql_estado = "SELECT estado FROM estado WHERE id_estado='$estado'";
                                $result_estado = mysqli_query($conectar, $sql_estado);
                                foreach ($result_estado as $valor_show) {
                                    ?>
                                    <p id="estado_actual" class="<?php echo $valor_show['estado'] ?>">
                                        <?php
                                        echo $valor_show['estado'];
                                    }
                                    ?></p>
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
                <?php
                include '../../models/footer_1.php';
                ?>
            </footer>
            <script src="../../assets/js/scroll.js"></script>
            <script src="../../assets/js/animation.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const cambiar_estado = document.getElementById('cambiar_estado');
                    const formulario_container = document.getElementById('formulario_container');
                    const estado_actual = document.getElementById('estado_actual');

                    cambiar_estado.addEventListener('click', function () {
                        formulario_container.style.display = 'block';
                        cambiar_estado.style.display = 'none';
                        estado_actual.style.display = 'none';
                    });

                    formulario_container.querySelector('form').addEventListener('submit', function () {
                        formulario_container.style.display = 'none'; // Ocultar el formulario al enviar
                    });
                });
            </script>
    </html>

    <?php
} else {
    echo "NO";
}
?>