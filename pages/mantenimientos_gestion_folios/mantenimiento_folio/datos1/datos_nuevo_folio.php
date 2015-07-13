<?php

require_once($maindir."conexion/config.inc.php"); 
$conexion = mysqli_connect($host, $username, $password, $dbname);

$query = "SELECT * FROM unidad_academica";
$result1 = mysqli_query($conexion, $query);

$query2 = "SELECT * FROM organizacion";
$result2 = mysqli_query($conexion, $query2);

$query3 = "SELECT * FROM ubicacion_archivofisico";
$result3 = mysqli_query($conexion, $query3);

$query4 = "SELECT * FROM prioridad";
$result4 = mysqli_query($conexion, $query4);

$query5 = "SELECT * FROM estado_seguimiento";
$result5 = mysqli_query($conexion, $query5);

$query6 = "SELECT * FROM categorias_folios";
$result6 = mysqli_query($conexion, $query6);

?>