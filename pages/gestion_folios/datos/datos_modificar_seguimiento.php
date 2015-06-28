<?php

require_once($maindir."conexion/conn.php"); 
$conexion = mysqli_connect($host, $username, $password, $dbname);

$query5 = "SELECT * FROM estado_seguimiento";
$result5 = mysqli_query($conexion, $query5);

?>