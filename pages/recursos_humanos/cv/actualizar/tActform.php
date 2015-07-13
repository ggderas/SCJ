<?php
session_start();
include "../../../../Datos/conexion.php";
function limpiar($tags)
{
    $tags = strip_tags($tags);
    return $tags;
}

//Información Personal
if (isset($_POST['modTel']) && isset($_POST['modTipo']) && isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $nTel = limpiar($_POST['modTel']);
    $tipo = $_POST['modTipo'];

//Agregar ON UPDATE CASCADE, ON DELETE CASCADE A LA TABLA telefono.
    mysql_query("UPDATE telefono SET Tipo = '$tipo', Numero = '$nTel' WHERE ID_Telefono = '$id'");

    echo "Número telefónico se ha actualizado con éxito!";
}