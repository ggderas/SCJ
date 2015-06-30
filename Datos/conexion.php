<?php 
$conectar = new mysqli('localhost','root','','sistema_ciencias_juridicas');
//$cn = mysql_connect("localhost","root","");
//mysql_select_db("poa", $cn);

$enlace = mysql_connect('localhost', 'root', '');
mysql_select_db('sistema_ciencias_juridicas', $enlace);
if (!$enlace) {
    die('No se pudo conectar: ' . mysql_error());
}

?>
