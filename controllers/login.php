<?php

include './config/db.php'; //Se incluye la conexión a la basse de datos

if (!empty($_POST["ingresar"])) { //Se verifica que se de click en el botón de ingresar
    session_start(); // Se inicia la sesión
    if (empty($_POST["txtuser"]) and empty($_POST["txtclave"])) { //Se verifica que esten los campos vacios
        header("location: ./login.php?error=user_and_password"); //En caso de eso redirige al login con mensaje de error
    } else
    if (empty($_POST["txtclave"])) { //Verifica que la clave este vacia 
        header("location: ./login.php?error=password"); //Redirige mostrando el error
    } else if (empty($_POST["txtuser"])) { // Vericfica que el usuario este vacio
        header("location: ./login.php?error=user"); //Redirige mostrando error
    } else { //De otra forma se empiezan a varificar los datos
        $user = $_POST["txtuser"]; //Se extrae el usuario mediante el metodo POST
        $pass = $_POST["txtclave"]; //Se extrae la contraseña
        $sql = $conectar->query("SELECT * FROM admin WHERE usuario='$user' AND `password`='$pass';"); // Se crea la secuencia para verificar los datos y se ejecuta
        if ($datos = $sql->fetch_object()) { //Se verifican los datos 
            $_SESSION["usuario"] = $user; //Se crea la sesión del usuario
            header("location: ./views/layouts/admin_view.php"); //Manda al inicio de administrador
        } else {
            header("location: ./login.php?error=no_existe"); //Manda al login con mnesaje de error
        }
    }
}