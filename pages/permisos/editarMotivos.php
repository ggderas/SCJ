<?php
	//Se recibe el nuevo valor que se asignara al campo Nombre del registro seleccionado y se guarda en la base de datos
	
	$id=$_POST['Motivo_ID'];	
	$desc=$_POST['dmotivo'];
	
	require_once("conexion.php");
	
	mysql_query("update motivos set descripcion = '$desc' WHERE Motivo_ID='$id'", $enlace);	
	
	mysql_close($enlace);

?>