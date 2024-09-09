<?php
include '../config/db.php'; //Se incluye la conexión a la base de datos
$id = $_GET["id"]; //Se extrae el id de la PQRS mediante el metodo GET

$estado = $_POST['select']; //Se trae el esxtado mediante el metodo POST

$sql = "UPDATE pqrss SET estado='$estado' WHERE id_solicitud='$id'"; //Se crea la secuencia para cambiar el estado de la PQRS
$result = mysqli_query($conectar, $sql); //Se ejecuta la secuencia


if ($result) { // Se verifica que se halla ejecutado correctamente
    header("Location: ../views/layouts/vista_detallada.php?id=$id#estado"); //Redirige al lugar donde estaba en la sección donde se encontraba
}