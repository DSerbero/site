<?php

include('./controllers/login.php');
include './controllers/sesion.php';

if (isset($_SESSION['usuario'])) {
    header("location: ./views/layouts/admin_view.php");
} else {
    ?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar</title>
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="stylesheet" href="./assets/css/mensaje.css">
    <link rel="shortcut icon" href="./assets/img/escudo.png" type="image/x-icon">
    <script src="./assets/js/animation.js"></script>
</head>

<body>
    <div class="container">
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
        <header>
        <div class="header-nav ">
            <a href="index.php" class="btn__back">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20px"><path fill="#fd7e14" d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM215 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L392 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-214.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L103 273c-9.4-9.4-9.4-24.6 0-33.9L215 127z"/></svg>
            <h3>Volver</h3>
            </a>
            <img src="./assets/img/iebs.png" alt="">
            <h2>P.Q.R.S</h2>
            </div>
        </header>
        <div class="forms__container">
            <div id="mensaje">
            </div>
            <form action="" method="post" class="sign-in-form">
                <h2 class="title">Ingresar</h2>
                <div class="input__field">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20px" fill="#fff"><path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg>
                    <input type="text" name="txtuser" placeholder="Usuario">
                </div>
                <div id="ifield__clave" class="input__field">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20px" fill="#fff"><path d="M144 144l0 48 160 0 0-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192l0-48C80 64.5 144.5 0 224 0s144 64.5 144 144l0 48 16 0c35.3 0 64 28.7 64 64l0 192c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 256c0-35.3 28.7-64 64-64l16 0z"/></svg>
                    <input id="iclave" type="password" name="txtclave" placeholder="Contraseña">
                        <svg id="ieye" onclick="showHide()" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="#fff"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
                </div>
                <input type="submit" name="ingresar" value="Ingresar" class="btn solid" required>
            </form>
        </div>
        <footer>
            <div class="footer">
                <div class="footer__paragraph">
                    <h2>P.Q.R.S</h2>
                    <p>Institución Educativa Barrio Santander &copy;</p>
                </div>
                <div class="contacto">
                    <h3>Dirección</h3>
                    <p>Cra 78C #104F - 78</p>
                    <p>Barrio Santander</p>
                    <p>Medellín - Colombia</p>
                    <h3>Correo electrónico</h3>
                    <p>secretaria.iebs@colsantander.edu.co</p>
                    <h3>Teléfono</h3>
                    <p>304 629 7359</p>
                </div>
                <div class="footer__redes">
                    <a target="_blank" href="https://www.facebook.com/colegiosantandermedellin"><img src="./assets/img/facebook.svg" alt=""></svg></a>
                    <a target="_blank" href="https://www.instagram.com/iebarriosantandermedellin"><img src="./assets/img/instagram.svg" alt=""></a>
                    <a target="_blank" href="https://www.youtube.com/channel/UCWoeUyDf0EkK0m-NpCF9Now"><img src="./assets/img/youtube.svg" alt=""></a>
                </div>
            </div>
        </footer>
    </div>
    <script src="./assets/js/login.js"></script>
    <script src="./assets/js/scroll.js"></script>
    <script src="./assets/js/error_login.js"></script>
</body>

</html>
    <?php

}
?>
