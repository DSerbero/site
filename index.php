<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>P.Q.R.S</title>
        <link rel="icon" href="./assets/img/iebs.png">
        <link rel="stylesheet" href="./assets/css/s-academico.css">
        <link rel="stylesheet" href="./assets/css/layout.css">
        <script src="https://kit.fontawesome.com/a22bc65f86.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,700;1,400&display=swap"
              rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
        <script src="./assets/js/scroll.js"></script>
        <script src="./assets/js/animation.js"></script>
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

                    <a href="./views/layouts/crear_pqrs.php">
                        <div class="option">
                            <i class="fa-sharp fa-solid fa-eye"></i>
                            <h4>Crear P.Q.R.S</h4>
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
                <div class="izquierda_a">
                    <a href="#inicio"><img src="./assets/img/iebs.png" alt=""></a>
                    <h2 class="inicio_a">P.Q.R.S</h2>
                </div>
                <div class="derecha_a">
                    <h2>
                        Preguntas, Quejas, Reclamos y Sugerencias de la comunidad
                    </h2>
                </div>
            </div>
            <div class="slider-frame">
                <ul>
                    <li>
                        <h6 class="letras">PQRS Que Significa P</h6>
                        <h2 class="letras">PETICION: se refiere a una solicitud formal o informal que alguien hace a otra persona, grupo, o entidad para obtener algo.</h2>
                        <img src="./assets/img/descarga.jpeg" alt="">
                    </li>
                    <li>
                        <h6 class="letras">PQRS Que Significa P</h6>
                        <h2 class="letras">PETICION: se refiere a una solicitud formal o informal que alguien hace a otra persona, grupo, o entidad para obtener algo.</h2>
                        <img src="./assets/img/descarga1.jpeg" alt="">

                    </li>
                    <li>
                        <h6 class="letras">PQRS Que Significa P</h6>
                        <h2 class="letras">PETICION: se refiere a una solicitud formal o informal que alguien hace a otra persona, grupo, o entidad para obtener algo.</h2>
                        <img src="./assets/img/descarga2.jpeg" alt="">
                    </li>
                    <li>
                        <h6 class="letras">PQRS Que Significa P</h6>
                        <h2 class="letras">PETICION: se refiere a una solicitud formal o informal que alguien hace a otra persona, grupo, o entidad para obtener algo.</h2>
                        <img src="./assets/img/descarga3.jpeg" alt="">
                    </li>
                </ul>
                <button id="prevButton"><img src="./assets/img/atras.png" alt=""></button>
                <button id="nextButton"><img src="./assets/img/atras.png" alt=""></button>
            </div>

        </header>

        <main>
            <section class="services.contenedor" id="servicio">
                <h2 class="subtitulo">Nuestro servicio</h2>
                <a href="./views/layouts/crear_pqrs.php" class="button_pqrs">Crear P.Q.R.S</a>
                <div class="contenedor-servicio">
                    <img src="./assets/img/3462a3214db3ff6573b28fea8861ec1d.jpg" alt="">
                    <div class="checklist-servicio">
                        <div class="service">
                            <h3 class="n-service"><span class="number">1</span>Sevicio 1</h3>
                            <p>Explicación del servicio.</p>
                        </div>
                        <div class="service">
                            <h3 class="n-service"><span class="number">2</span>Sevicio 2
                            </h3>
                            <p>Explicación del servicio.</p>
                        </div>
                        <div class="service">
                            <h3 class="n-service"><span class="number">3</span>Sevicio 3</h3>
                            <p>Explicación del servicio.</p>
                        </div>
                        <div class="service">
                            <h3 class="n-service"><span class="number">4</span>Sevicio 4</h3>
                            <p>Explicación del servicio.</p>
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
            <?php include './models/footer.php'; ?>
        </footer>

        <script type="text/javascript" src="./assets/js/s-academico.js"></script>
        <script>
            const sliderFrame = document.querySelector('.slider-frame ul');
            const slides = document.querySelectorAll('.slider-frame li');
            let currentIndex = 0;
            const totalSlides = slides.length;

            document.getElementById('nextButton').addEventListener('click', () => {
                currentIndex++;
                if (currentIndex >= totalSlides) {
                    currentIndex = 0;
                }
                updateSliderPosition();
            });

            document.getElementById('prevButton').addEventListener('click', () => {
                currentIndex--;
                if (currentIndex < 0) {
                    currentIndex = totalSlides - 1;
                }
                updateSliderPosition();
            });

            function updateSliderPosition() {
                const translateX = -currentIndex * 100; // Asume que cada slide ocupa el 100% del ancho
                sliderFrame.style.transform = `translateX(${translateX}%)`;
            }
        </script>
    </body>

</html>