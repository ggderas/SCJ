<?php
	$motivo =  $_POST['dmotivo'];

	require_once("../../conexion/conn.php");  
	$conexion = mysqli_connect($host, $username, $password, $dbname);
	
	//require_once("conexion.php");
	
	$query = "INSERT INTO motivos(descripcion) VALUES ('$motivo')";
	
	$resultado = mysqli_query($conexion, $query) or die("Error " . mysqli_error($link));
	mysqli_close($conexion);
?>