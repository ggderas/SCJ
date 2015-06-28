<?php
    
	require_once('funciones.php');
	
	
	
	

	If(isset($_POST['nombre2'])){
		
		$nombre2=$_POST['nombre2'];
		 $pais2=$_POST['pais2'];
		 $codigo2=$_POST['codigo'];
                 
              
		 
	$query= mysql_query("UPDATE universidad SET 
	nombre_universidad='$nombre2',
	Id_pais='$pais2'
	WHERE id_universidad='$codigo2'");
	
	
	
	if($query){
	
		//echo '<META HTTP-EQUIV="REFRESH" CONTENT="2">' ;
		echo mensajes('Actualizado con Exito','verde');
	
	
	
	}else{}
	
	

	
	}
        
     
?>