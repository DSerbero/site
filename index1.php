<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P.Q.R.S</title>
    <link rel="icon" href="./assets/img/logoprimesaber.png">
    <link rel="stylesheet" href="./assets/css/s-academico.css">
    <link rel="stylesheet" href="./assets/css/layout.css">
    <script src="https://kit.fontawesome.com/a22bc65f86.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,700;1,400&display=swap"
        rel="stylesheet">
    <script src="./assets/js/scroll.js"></script>
    <script>
        window.addEventListener('load', function () {
            setTimeout(function () {
                var preloader = document.querySelectorAll(".preloader");
                preloader.forEach(function (element) {
                    element.classList.add("loaded");
                });
            }, 300);
        });
        window.addEventListener('beforeunload', function (event) {
            var preloader = document.querySelectorAll(".preloader");
            preloader.forEach(function (element) {
                element.classList.remove("loaded");
            });
        });
    </script>
</head>

<body>
    <div class="preloader">
        <div class="preloader-logo"><a class="brand" href="index1.html"><img class="brand-logo-dark"
                    src="./assets/img/iebs.png" alt="" width="245" height="250" /></a>
        </div>
        <div class="preloader-body">
            <div class="cssload-container">
                <div class="cssload-speeding-wheel"></div>
            </div>
        </div>
    </div>
    <header class="header" id="inicio">
        <img src="./assets/img/hamburguesa.svg" alt="" class="hamburguer">
        <nav class="menu-navegacion">
            <div class="options__menu">
                <!-- <div class="cerrar">X</div> -->
                <a href="./Vista/principal.php?control=ingresar">
                    <div class="option">
                        <i class="fa-solid fa-key"></i>
                        <h4>Ingresar</h4>
                    </div>
                </a>

                <a href="pqrs.html">
                    <div class="option">
                        <i class="fa-sharp fa-solid fa-eye"></i>
                        <h4>Crear  P.Q.R.S</h4>
                    </div>
                </a>
                <a href="#contacto">
                    <div class="option">
                        <i class="fa-solid fa-address-card"></i>
                        <h4>Contacto</h4>
                    </div>
                </a>
            </div>
        </nav>
        <div class="header-nav ">
            <img src="./assets/img/iebs.png" alt="">
            <h2>P.Q.R.S</h2>
        </div>
        <div class="slider-frame">
            <ul>
                <li><img src="./assets/img/descarga.jpeg" alt="">
                </li>
                <li><img src="./assets/img/descarga1.jpeg" alt="">
                </li>
                <li><img src="./assets/img/descarga2.jpeg" alt="">
                </li>
                <li><img src="./assets/img/descarga3.jpeg" alt="">
                </li>
            </ul>
        </div>
    </header>

    <main>
        <section class="services.contenedor" id="servicio">
            <h2 class="subtitulo">Nuestro servicio</h2>
            <div class="contenedor-servicio">
                <img src="./assets/img/3462a3214db3ff6573b28fea8861ec1d.jpg" alt="">
                <div class="checklist-servicio">
                    <div class="service">
                        <h3 class="n-service"><span class="number">1</span>Fortalecimiento de capacidades</h3>
                        <p>Fortalecer en los jóvenes sus habilidades sociales, y académicas como la identificación y
                            ejercicio de sus derechos.</p>
                    </div>
                    <div class="service">
                        <h3 class="n-service"><span class="number">2</span>Posicionamiento del espíritu emprendedor
                        </h3>
                        <p>Ofrecer actividades de capacitacion a líderes y maestros con el propósito de promover el
                            espíritu emprendedor en los estudiantes.</p>
                    </div>
                    <div class="service">
                        <h3 class="n-service"><span class="number">3</span>Implementación de proyectos de
                            emprendimiento
                            social y académico</h3>
                        <p>Promover el emprendimiento en los estudiantes, por medio del desarrollo de proyectos
                            mediante
                            el desarrollo individual y colectivo.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="imagen-Light">
            <img src="./assets/img/close.svg" alt="" class="close">
            <img src="" alt="" class="agregar-imagen">
        </section>
        <br>
        <br>
        <br>
        <section>
            <div class="contenedor-video">
                <h2 class="subtitulo">Vídeos</h2>
                <center><iframe width="560" height="315" src="https://www.youtube.com/embed/7hcontrols=0"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe></center>
            </div>
        </section>
    </main>
    <footer id="contacto">
        <?php include("./views/layouts/footer.php") ?>
    </footer>

    <script type="text/javascript" src="./assets/js/s-academico.js"></script>
</body>

</html>