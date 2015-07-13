<?php

require_once('funciones.php');




//echo $_POST['nombre'];
if (isset($_POST['titulo'])) {
    $nombre1 = $_POST['titulo'];
    $query = "INSERT INTO titulo(titulo) VALUES('$nombre1')";

    mysql_query($query);
    
    	
	if($query){
	
		//echo '<META HTTP-EQUIV="REFRESH" CONTENT="2">' ;
		echo mensajes('Actualizado con Exito','verde');
	
	
	
	}else{}
	
	

	
	}
    

?>