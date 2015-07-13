<?php

$root = \realpath($_SERVER["DOCUMENT_ROOT"]);
include "$root\sistemaCienciasJuridicas\Datos\Conexion.php";

if (isset($_POST['rol'])&&isset($_POST['descripcion'])&&isset($_POST['nivel1'])) {
    $nombre1 = $_POST['rol'];
    $descripcion1 = $_POST['descripcion'];
    $nivel1=$_POST['nivel1'];
    $query = "INSERT INTO roles(Id_Rol,nombre_Rol,Descripcion) VALUES($nivel1, '$nombre1','$descripcion1')";

    mysql_query($query);
}
 else {
    echo "no";
}
include "$root\sistemaCienciasJuridicas\Datos\cargarRoles.php";
?>