<?php
	$id=$_POST['id1'];	
	
	require_once("conexion.php");
	mysql_query("update permisos set estado = 'Finalizado' FROM permisos WHERE permisos.ID_permiso='$id'", $enlace);	
	
	mysql_close($enlace);
?>