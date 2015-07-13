<?php

  require_once('funciones.php');

if (isset($_POST['IdClase'])) {
    $id = $_POST['IdClase'];

    if (mysql_query("DELETE FROM clases WHERE ID_Clases='$id'")) {
        echo mensajes('Clase "' . $id . '" Eliminado con Exito', 'verde');
    } else {

        echo mensajes('Clase "' . $id . '" No se puede eliminar', 'rojo');
    }
}
 
?>