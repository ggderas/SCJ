<?php


If (isset($_POST['nombre_pais'])) {

    $nombre2 = $_POST['nombre_pais'];
    $codigo2 = 'codigo';

    $query = mysql_query("UPDATE pais SET 
	Nombre_pais='$nombre2'
	WHERE Id_pais='$codigo'");



    if ($query) {

        echo '<META HTTP-EQUIV="REFRESH" CONTENT="4">';
        echo mensajes('Pais "' . $nombre_pais . '" Identificado con el Codigo "' . $codigo . '" Ha sido Actualizado con Exito', 'verde');
    } else {
        
    }
}
?>