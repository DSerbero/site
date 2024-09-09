<?php
include '../../config/db.php'; //Conexión a base de datos
include '../../controllers/sesion.php'; //Se incluye la sesión
if (isset($_SESSION['usuario'])) {
    
    $sql = "SELECT * FROM pqrss ORDER BY id_solicitud DESC"; //Se crea la secuencia para mostrar las solicitudes
    $result = mysqli_query($conectar, $sql); //Se ejecuta la secuencia
    $filas = mysqli_num_rows($result); //Se verifica el número de filas 
    
    
    ?>
    <!doctype html>
    <html>
        <head>
            <link rel="stylesheet" href="../../assets/css/admin.css"/>
            <link rel="icon" href="../../assets/img/iebs.png">
            <title>Registro P.Q.R.S</title>
        </head>
        <body>
            <script>
                document.addEventListener('change', e => {
                    if (e.target.matches('#filtro')) {
                        const seleccionado = e.target.value;
                        document.querySelectorAll('.peticion_box').forEach(card => {
                            switch (seleccionado) {
                                case '':
                                    // Mostrar todas las tarjetas
                                    card.classList.remove('quitar');
                                    card.style.display = ''; 
                                    break;
                                case 'pendientes':
                                    //Mostrar solo las pendientes
                                    if (card.classList.contains('pendientes')) {
                                        card.classList.remove('quitar');
                                        card.style.display = ''; 
                                    } else {
                                        card.classList.add('quitar');
                                        card.style.display = 'none';
                                    }
                                    break;
                                case 'en_proceso':
                                    //Mostrar solo las que estan en proceso
                                    if (card.classList.contains('en_proceso')) {
                                        card.classList.remove('quitar');
                                        card.style.display = ''; 
                                    } else {
                                        card.classList.add('quitar');
                                        card.style.display = 'none'; 
                                    }
                                    break;
                                case 'respondido':
                                    //Mostrar solo las respondidas
                                    if (card.classList.contains('respondido')) {
                                        card.classList.remove('quitar');
                                        card.style.display = ''; 
                                    } else {
                                        card.classList.add('quitar');
                                        card.style.display = 'none'; 
                                    }
                                    break;
                            }
                        });
                    }
                });
            </script>
            <header>
                <?php
                include '../../models/header_3.php';
                ?>
            </header>
            <main>
                <div class="content">
                    <h2>Registro de PQRS</h2>
                    <select class="filtro" id="filtro">
                        <option value="">Todas</option>
                        <option value="pendientes">Pendientes</option>
                        <option value="en_proceso">En proceso</option>
                        <option value="respondido">Respondidas</option>
                    </select>
                    <div class="pqrs" id="pqrs">
                        <?php
                        if (!($filas > 0)) { //se verifica que existan PQRS
                        ?>
                        <div class="no_encontrado" id="no_encontrado">
                            <p>
                                No se han encontrado nuevas PQRS.
                            </p>
                        </div>
                        <?php
                        } else {
                            foreach ($result as $datos) {//Se muestran las pqrs
                                if ($datos['estado'] == 1) { //Se muestran solo las pendientes
                                    ?>
                                    <div class="pendientes peticion_box" id="pendientes">
                                        <div class="info_peticion">
                                            <p class="info_prin">
                                                <span class="nombres"><?php echo $datos['nombres']," ", $datos['apellidos'] //Se muestran los nombres y apellidos?></span> 
                                                <span class="cargo">
                                                    <?php
                                                    $cargo = $datos['cargo']; //Se obtiene el cargo
                                                    $sql_cargo = "SELECT cargo FROM cargos WHERE id_cargo='$cargo'"; //Se escribe la secuencia que trae el cargo
                                                    $result_cargo = mysqli_query($conectar, $sql_cargo); //Se ejecuta la secuencia
                                                    foreach ($result_cargo as $cargo_show) {
                                                        echo $cargo_show['cargo']; //Se muestra el cargo
                                                    }
                                                    ?>
                                                </span>
                                                <span class='tipo_pqrss'>
                                                    <?php
                                                    $tipo_pqrs = $datos['tipo_pqrs']; //Se obtiene el tipo de PQRS
                                                    $sql_pqrs = "SELECT tipo FROM tipos_pqrs WHERE id_tipopqrs='$tipo_pqrs'"; //Se escribe la secuencia que trae el tipo
                                                    $result_pqrs = mysqli_query($conectar, $sql_pqrs);//Se ejecuta la secuencia
                                                    foreach ($result_pqrs as $pqrs_show) {
                                                        echo $pqrs_show['tipo']; //Se muestra el cargo
                                                    }
                                                    ?>
                                                </span>
                                                <span class="fecha">
                                                    <?php  
                                                    $fecha = $datos['fecha_cre']; //Se trae la fecha
                                                    $fecha = date("d/m/Y", strtotime($fecha)); //Se le da formato
                                                    echo $fecha;  //Se muestra la fecha
                                                    ?>
                                                </span>
                                            </p>
                                            <p class="descrip">
                                                <?php
                                                echo $datos['descripcion']; //Se muetra la decripcion
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
                                                Dias restantes: <b>
                                                <?php
                                                $fecha_now = new DateTime(); //Se crea la fecha actual
                                                $fecha_new = new DateTime($datos['fecha_cre']); //Se llama la fecha de creación
                                                $dias = 11; //Se asignan los días de plazo
                                                $fecha_new->modify("+$dias days"); //Se le suman los dias de plazo a la fecha de creación
                                                $fecha_new->format('Y-m-d'); // Se le da fortato
                                                $diferencia = $fecha_new->diff($fecha_now); //Se calcula la diferencia
                                                $dias_restantes = $diferencia->days; //Se llaman los dias restantes
                                                echo $dias_restantes; //Se muestran los días restantes
                                                ?>
                                                    </b>
                                            </p>
                                            <?php 
                                            $id = $datos['id_solicitud']; //Se trae el id de la solicitud
                                            ?>
                                            <a href="./vista_detallada.php?id=<?php echo $id; ?>" class="btn-revisar">Revisar</a>
                                            <!-- Se muestra el boton de revisar -->
                                        </div>
                                        <?php
                                        if ($datos['id_archivo'] != null){ //Se verifica que exista un archivo
                                            $sql = "SELECT nombre, tipo_archivo, contenido FROM archivos WHERE id_archivo = ?"; //Se crea la secuencia para traer e archivo
                                            $stmt = mysqli_prepare($conectar, $sql); //Se prepara l asecuencia
                                            $id_archivo = $datos['id_archivo']; //Se crea la variable con el valor de la ID de la petición
                                            if ($stmt) { //Se verifica que la consulta este creada o preparandose
                                                mysqli_stmt_bind_param($stmt, 'i', $id_archivo); //Se asigna el valor del ID a traer

                                                mysqli_stmt_execute($stmt); //Se ejecuta la secuencia

                                                mysqli_stmt_bind_result($stmt, $file_name, $file_type, $file_content); //Se enlazan los resultados a las variables correspondientes
                                                mysqli_stmt_fetch($stmt); //Se obtiene el resultado de la consulta

                                                mysqli_stmt_close($stmt); //SE cierra la consulta
                                                if (strpos($file_type, 'image/') !== false) { //Se verifica si es una imagen
                                                    $base64 = base64_encode($file_content); //Se codifican en archivos base 64
                                                    echo '<img src="data:' . $file_type . ';base64,' . $base64 . '" alt="' . $file_name . '">'; //Se muestra la imagen
                                                } else if ($file_type === 'application/pdf') { //Se verifica si es pdf
                                                    echo '<a href="../../controllers/ver_pdf.php?id=' . $id_archivo . '" target="_blank">Ver PDF: ' . htmlspecialchars($file_name) . '</a>'; //Se muestra el enlace al archivo
                                                }
                                            }
                                        } else {
                                            echo "<p class='sin_imagen'>No se ha subido imagen o archivo.</p>"; //Se muestra mensaje en caso de que no se halla subido archiuvo
                                        }
                                        ?>
                                    </div>
                                    <?php
                                } else if ($datos['estado'] == 2) { //Se verifica y muestra en caso de ser peticiones en proceso
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
                                                <span class='tipo_pqrss'>
                                                    <?php
                                                    $tipo_pqrs = $datos['tipo_pqrs'];
                                                    $sql_pqrs = "SELECT tipo FROM tipos_pqrs WHERE id_tipopqrs='$tipo_pqrs'";
                                                    $result_pqrs = mysqli_query($conectar, $sql_pqrs);
                                                    foreach ($result_pqrs as $pqrs_show) {
                                                        echo $pqrs_show['tipo'];
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
                                                Dias restantes: <b>
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
                                            <?php 
                                            $id = $datos['id_solicitud'];
                                            ?>
                                            <a href="./vista_detallada.php?id=<?php echo $id; ?>" class="btn-revisar">Revisar</a>
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
                                } else if ($datos['estado'] == 3) { //Se verifica y se muestra en caso de ser peticiones respondidas
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
                                                <span class='tipo_pqrss'>
                                                    <?php
                                                    $tipo_pqrs = $datos['tipo_pqrs'];
                                                    $sql_pqrs = "SELECT tipo FROM tipos_pqrs WHERE id_tipopqrs='$tipo_pqrs'";
                                                    $result_pqrs = mysqli_query($conectar, $sql_pqrs);
                                                    foreach ($result_pqrs as $pqrs_show) {
                                                        echo $pqrs_show['tipo'];
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
                                            <?php 
                                            $id = $datos['id_solicitud'];
                                            ?>
                                            <a href="./vista_detallada.php?id=<?php echo $id; ?>" class="btn-revisar">Revisar</a>
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
                include '../../models/footer_1.php'; //Se incluye el footer
                ?>
            </footer>
            <!-- Preloader -->
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
            <!-- Se llama el script para que cambie el header al hacer scroll -->
            <script src="../../assets/js/scroll.js"></script> 
            <!-- Se llama el scrip para el preloader -->
            <script src="../../assets/js/animation.js"></script>
            
        </body>
    </html>

    <?php
} else {
    header("Location: ../../login.php");
}
?>
