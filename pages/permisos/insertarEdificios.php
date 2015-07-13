<?php
	require_once("../../conexion/conn.php");  
	$conexion = mysqli_connect($host, $username, $password, $dbname); 
	
	$edificio = $_POST['dedificio'];
	$query = "INSERT INTO edificios(descripcion) VALUES('$edificio')";
	
	$resultado = mysqli_query($conexion, $query) or die("Error " . mysqli_error($link));
	mysqli_close($conexion);
?>