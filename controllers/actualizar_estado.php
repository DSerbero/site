<?php
include '../config/db.php';
$id = $_GET["id"];

$estado = $_POST['select'];

$sql = "UPDATE pqrss SET estado='$estado' WHERE id_solicitud='$id'";
$result = mysqli_query($conectar, $sql);


if ($result) {
    header("Location: ../views/layouts/vista_detallada.php?id=$id#estado");
}