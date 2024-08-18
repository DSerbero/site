<?php

$hostname = "localhost";
$usuariodb = "root";
$passworddb = "";
$dbname = "pqrs";

$conectar = mysqli_connect($hostname, $usuariodb, $passworddb, $dbname);

if (!$conectar) {
    echo "conexión fallida";
}
?>  