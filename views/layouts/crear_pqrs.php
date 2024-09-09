<html>

    <head>
        <title>Crear P.Q.R.S</title>
        <!--Stilos de la página-->
        <link rel="stylesheet" href="../../assets/css/layout.css" />
        <link rel="stylesheet" href="../../assets/css/s-academico.css" />
        <link rel="stylesheet" href="../../assets/css/crearpqrs.css" />
        <link rel="stylesheet" href="../../assets/css/mensaje.css" />
        <link rel="stylesheet" href="../../assets/css/crear_pqrs.css" />
        <link rel="icon" href="../../assets/img/iebs.png">
        <script src="../../assets/js/animation.js"></script> <!--script del preloader-->
    </head>

    <body>
        <div class="preloader"> <!--Preloader-->
            <div class="preloader-logo"><a class="brand" href="index1.html"><img class="brand-logo-dark"
                                                                                 src="../../assets/img/iebs.png" alt="" width="245" height="250" /></a>
            </div>
            <div class="preloader-body">
                <div class="cssload-container">
                    <div class="cssload-speeding-wheel"></div>
                </div>
            </div>
        </div>
        <header> <!--Header-->
            <?php include '../../models/header_1.php'; ?><!--Se incluye el header-->
        </header>
        <main> <!--Mensaje al mandar el pqrs-->
            <div id="mensaje">
            </div>
            <?php include '../../models/formulario.php'; ?> <!--Se incluye el formulario-->
        </main>
        <footer>
            <?php include '../../models/footer_1.php'; ?> <!--Se incluye el footer-->
        </footer>
        <script src="../../assets/js/previsualizacion.js">//Se llama el script de la previsualización de la imagen o enlace de pdf</script> 
        <script src="../../assets/js/aceptar_con.js">//mensaje para verificar que se hayan aceptado las condiciones</script>
        <script src="../../assets/js/scroll.js">//Para cambiar el header al hacer scroll</script>
        <script src="../../assets/js/mensaje.js">//Para mostral el mensaje al haber enviado la pqrs o al haber tenido un error</script>
    </body>

</html>