<?php
include '../../config/db.php';
include '../../controllers/sesion.php';
if (isset($_SESSION['usuario'])) {
    
    $sql = "SELECT * FROM pqrss ORDER BY id_solicitud DESC";
    $result = mysqli_query($conectar, $sql);
    $filas = mysqli_num_rows($result);
    
    
    ?>
    <!doctype html>
    <html>
        <head>
            <link rel="stylesheet" href="../../assets/css/admin.css"/>
            <title>title</title>
        </head>
        <body>
            
            <header>
                <?php
                include '../../models/header_3.php';
                ?>
            </header>
            <main>
                <div class="content">
                    <h2>Registro de PQRS</h2>
                    <div class="pqrs" id="pqrs">
                        <?php
                        if (!($filas > 0)) {
                        ?>
                        <div class="no_encontrado" id="no_encontrado">
                            <p>
                                No se han encontrado nuevas PQRS.
                            </p>
                        </div>
                        <?php
                        } else {
                            foreach ($result as $datos) {
                                if ($datos['estado'] == 1) {
                                    ?>
                                    <div class="pendientes peticion_box" id="pendientes">
                                        <div class="info_peticion">
                                            <p class="info_prin">
                                                <span class="nombres"><?php echo $datos['nombres']," ", $datos['apellidos'] ?></span>
                                                <span class="cargo">
                                                    <?php
                                                    $cargo = $datos['cargo'];
                                                    $sql_cargo = "SELECT cargo FROM cargos WHERE id_cargo='$cargo'";
                                                    $result_cargo = mysqli_query($conectar, $sql_cargo);
                                                    foreach ($result_cargo as $cargo_show) {
                                                        echo $cargo_show['cargo'];
                                                    }
                                                    ?>
                                                </span>
                                                <span class="fecha">
                                                    <?php  
                                                    $fecha = $datos['fecha_cre'];
                                                    $fecha = date("d/m/Y", strtotime($fecha));
                                                    echo $fecha;    
                                                    ?>
                                                </span>
                                            </p>
                                            <p class="descrip">
                                                <?php
                                                echo $datos['descripcion'];
                                                ?>
                                            </p>
                                            <p class="estado">
                                                <?php
                                                $estado = $datos['estado'];
                                                $sql_estado = "SELECT estado FROM estado WHERE id_estado='$estado'";
                                                $result_estado = mysqli_query($conectar, $sql_estado);
                                                foreach ($result_estado as $valor_show) {
                                                    echo $valor_show['estado'];
                                                }
                                                ?>
                                            </p>
                                            <p class="restante">
                                                Dias restantes: 
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
                                            </p>
                                        </div>
                                        <?php
                                        if ($datos['id_archivo'] != null){
                                            $sql = "SELECT nombre, tipo_archivo, contenido FROM archivos WHERE id_archivo = ?";
                                            $stmt = mysqli_prepare($conectar, $sql);
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
                                                    echo '<a href="../../controllers/ver_pdf.php?id=' . $id_archivo . '" target="_blank">Ver PDF: ' . htmlspecialchars($file_name) . '</a>';
                                                }
                                            }
                                        } else {
                                            echo "<p class='sin_imagen'>No se ha subido imagen o archivo.</p>";
                                        }
                                        ?>
                                    </div>
                                    <?php
                                } else if ($datos['estado'] == 2) {
                                    ?>
                                    <div class="en_proceso peticion_box" id="en_proceso">
                                        <div class="info_peticion">
                                            <p class="info_prin">
                                                <span class="nombres"><?php echo $datos['nombres']," ", $datos['apellidos'] ?></span>
                                                <span class="cargo">
                                                <?php
                                                    $cargo = $datos['cargo'];
                                                    $sql_cargo = "SELECT cargo FROM cargos WHERE id_cargo='$cargo'";
                                                    $result_cargo = mysqli_query($conectar, $sql_cargo);
                                                    foreach ($result_cargo as $cargo_show) {
                                                        echo $cargo_show['cargo'];
                                                    }
                                                ?>
                                                </span>
                                                <span class="fecha">
                                                    <?php  
                                                    $fecha = $datos['fecha_cre'];
                                                    $fecha = date("d/m/Y", strtotime($fecha));
                                                    echo $fecha;    
                                                    ?>
                                                </span>
                                            </p>
                                            <p class="descrip">
                                                <?php
                                                echo $datos['descripcion'];
                                                ?>
                                            </p>
                                            <p class="estado">
                                                <?php
                                                $estado = $datos['estado'];
                                                $sql_estado = "SELECT estado FROM estado WHERE id_estado='$estado'";
                                                $result_estado = mysqli_query($conectar, $sql_estado);
                                                foreach ($result_estado as $valor_show) {
                                                    echo $valor_show['estado'];
                                                }
                                                ?>
                                            </p>
                                            <p class="restante">
                                                Dias restantes: 
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
                                            </p>
                                        </div>
                                        <?php
                                        if ($datos['id_archivo'] != null){
                                            $sql = "SELECT nombre, tipo_archivo, contenido FROM archivos WHERE id_archivo = ?";
                                            $stmt = mysqli_prepare($conectar, $sql);
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
                                                    echo '<a href="../../controllers/ver_pdf.php?id=' . $id_archivo . '" target="_blank">Ver PDF: ' . htmlspecialchars($file_name) . '</a>';
                                                }
                                            }
                                        } else {
                                            echo "<p class='sin_imagen'>No se ha subido imagen o archivo.</p>";
                                        }
                                        ?>
                                    </div>
                                    <?php
                                } else if ($datos['estado'] == 3) {
                                    ?>
                                    <div class="respondido peticion_box" id="respondido">
                                        <div class="info_peticion">
                                            <p class="info_prin">
                                                <span class="nombres"><?php echo $datos['nombres']," ", $datos['apellidos'] ?></span>
                                                <span class="cargo">
                                                    <?php
                                                    $cargo = $datos['cargo'];
                                                    $sql_cargo = "SELECT cargo FROM cargos WHERE id_cargo='$cargo'";
                                                    $result_cargo = mysqli_query($conectar, $sql_cargo);
                                                    foreach ($result_cargo as $cargo_show) {
                                                        echo $cargo_show['cargo'];
                                                    }
                                                    ?>
                                                </span>
                                                <span class="fecha">
                                                    <?php  
                                                    $fecha = $datos['fecha_cre'];
                                                    $fecha = date("d/m/Y", strtotime($fecha));
                                                    echo $fecha;    
                                                    ?>
                                                </span>
                                            </p>
                                            <p class="descrip">
                                                <?php
                                                echo $datos['descripcion'];
                                                ?>
                                            </p>
                                            <p class="estado">
                                                <?php
                                                $estado = $datos['estado'];
                                                $sql_estado = "SELECT estado FROM estado WHERE id_estado='$estado'";
                                                $result_estado = mysqli_query($conectar, $sql_estado);
                                                foreach ($result_estado as $valor_show) {
                                                    echo $valor_show['estado'];
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <?php
                                        if ($datos['id_archivo'] != null){
                                            $sql = "SELECT nombre, tipo_archivo, contenido FROM archivos WHERE id_archivo = ?";
                                            $stmt = mysqli_prepare($conectar, $sql);
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
                                                    echo '<a href="../../controllers/ver_pdf.php?id=' . $id_archivo . '" target="_blank">Ver PDF: ' . htmlspecialchars($file_name) . '</a>';
                                                }
                                            }
                                        } else {
                                            echo "<p class='sin_imagen'>No se ha subido imagen o archivo.</p>";
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </main>
            <footer>
                <?php
                include '../../models/footer_1.php';
                ?>
            </footer>
            <div class="preloader">
            <div class="preloader-logo"><a class="brand" href="index1.html"><img class="brand-logo-dark"
                        src="../../assets/img/iebs.png" alt="" width="245" height="250" /></a>
            </div>
            <div class="preloader-body">
                <div class="cssload-container">
                    <div class="cssload-speeding-wheel"></div>
                </div>
            </div>
            <script src="../../assets/js/scroll.js"></script>
            <script src="../../assets/js/animation.js"></script>
        </body>
    </html>

    <?php
} else {
    header("Location: ../../login.php");
}
?>
