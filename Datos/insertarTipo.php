<?php

require_once('funciones.php');

//echo $_POST['nombre'];
if (isset($_POST['nombre'])) {
    $nombre1 = $_POST['nombre'];
    $query = "INSERT INTO tipo_estudio(Tipo_estudio) VALUES('$nombre1')";

    mysql_query($query);
    
    
      	
	if($query){
	
		//echo '<META HTTP-EQUIV="REFRESH" CONTENT="2">' ;
		echo mensajes('Actualizado con Exito','verde');
	
	
	
	}else{}
	
    
    
}

?>