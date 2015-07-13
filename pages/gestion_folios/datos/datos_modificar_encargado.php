<?php

require_once($maindir."conexion/conn.php"); 
$conexion = mysqli_connect($host, $username, $password, $dbname);

$query_1 = "SELECT usuario.id_Usuario, usuario.Nombre FROM usuario WHERE Estado = 1 AND Id_rol <= 50 AND Id_rol >= 10";
$result_1 = mysqli_query($conexion, $query_1);

?>