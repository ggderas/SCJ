<?php
        
	require_once('funciones.php');

	If(isset($_POST['id'])){
		
		 $clase=$_POST['clase'];
		 $codigo=$_POST['id'];	 
                 $query= mysql_query("UPDATE clases SET Clase='$clase' "
                 . "WHERE Id_Clases='$codigo'");

	if($query){

		echo mensajes('Actualizado con Exito','verde');
	
	}else{}

	}
        
       
?>