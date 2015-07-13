<?php


require_once('funciones.php');




If (isset($_POST['idCargo'])) {

    $cargo = $_POST['cargo'];
    $idcargo = $_POST['idCargo'];



    $query = mysql_query("UPDATE cargo SET Cargo='$cargo' WHERE ID_cargo='$idcargo'");



    if ($query) {

        echo mensajes('Actualizado con Exito', 'verde');
    } else {
        
    }
}

 
?>