<?php
	//Se recibe el nuevo valor que se asignara al campo Nombre del registro seleccionado y se guarda en la base de datos

	$id = $_POST['Edificio_ID'];
	$desc = $_POST['dedificio'];

	require_once('conexion.php');
	
	mysql_query("update edificios set descripcion = '$desc' where Edificio_ID = '$id';", $enlace);
	
	mysql_close($enlace);
?>