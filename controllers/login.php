<?php

include './config/db.php';

if (!empty($_POST["ingresar"])) {
    session_start();
    if (empty($_POST["txtuser"]) and empty($_POST["txtclave"])) {
        header("location: ./login.php?error=user_and_password");
    } else
    if (empty($_POST["txtclave"])) {
        header("location: ./login.php?error=password");
    } else if (empty($_POST["txtuser"])) {
        header("location: ./login.php?error=user");
    } else {
        $user = $_POST["txtuser"];
        $pass = $_POST["txtclave"];
        $sql = $conectar->query("SELECT * FROM admin WHERE usuario='$user' AND `password`='$pass';");
        if ($datos = $sql->fetch_object()) {
            $_SESSION["usuario"] = $user;
            header("location: ./views/layouts/admin_view.php");
        } else {
            header("location: ./login.php?error=no_existe");
        }
    }
}