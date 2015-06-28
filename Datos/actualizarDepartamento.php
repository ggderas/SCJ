<?php
      
	require_once('funciones.php');

	If(isset($_POST['id'])){
		
		 $departamento=$_POST['departamento'];
		 $codigo=$_POST['id'];	 
                 $query= mysql_query("UPDATE departamento_laboral SET nombre_departamento='$departamento' "
                 . "WHERE Id_departamento_laboral='$codigo'");

	if($query){

		echo mensajes('Actualizado con Exito','verde');
	
	}else{}

	}
        
       
?>