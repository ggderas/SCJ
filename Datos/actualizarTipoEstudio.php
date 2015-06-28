<?php
      
	require_once('funciones.php');
	

	

	If(isset($_POST['codigo'])){
		
		 $Tipo_Estudio=$_POST['TipoEstudio'];
		 $codigo=$_POST['codigo'];
                 
                 
		 
	$query= mysql_query("UPDATE tipo_estudio SET Tipo_estudio='$Tipo_Estudio' WHERE ID_Tipo_estudio='$codigo'");
	
	
	
	if($query){
	
		//echo '<META HTTP-EQUIV="REFRESH" CONTENT="2">' ;
		echo mensajes('Actualizado con Exito','verde');
	
	
	
	}else{}
	
	

	
	}
        
      
?>