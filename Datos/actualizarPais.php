<?php
       
	require_once('funciones.php');
	

	

	If(isset($_POST['codigo'])){
		
		 $pais=$_POST['pais'];
		 $codigo=$_POST['codigo'];
                 
                 
		 
	$query= mysql_query("UPDATE pais SET Nombre_pais='$pais' WHERE Id_pais='$codigo'");
	
	
	
	if($query){
	
		//echo '<META HTTP-EQUIV="REFRESH" CONTENT="2">' ;
		echo mensajes('Actualizado con Exito','verde');
	
	
	
	}else{}
	
	

	
	}
        
     
?>