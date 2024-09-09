<?php
    session_start(); //Se inicia la sesión
    
    session_destroy(); //Se destruye la sesión
    header("location: ../login.php"); //Redirige al login