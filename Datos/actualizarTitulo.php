<?php
  
	require_once('funciones.php');
	
	If(isset($_POST['codigo'])){
		
		 $Titulo=$_POST['titulo'];
		 $codigo=$_POST['codigo'];
                 
                 
		 
	$query= mysql_query("UPDATE titulo SET titulo='$Titulo' WHERE id_titulo='$codigo'");
	
	
	
	if($query){
	
		//echo '<META HTTP-EQUIV="REFRESH" CONTENT="2">' ;
		echo mensajes('Actualizado con Exito','verde');
	
	
	
	}else{}
	
	

	
	}
        
     
?>

