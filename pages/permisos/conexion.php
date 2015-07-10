<?php 
//$conectar = new mysqli("localhost", "root","inding115","test8");
//$cn = mysql_connect("localhost","root","");
//mysql_select_db("poa", $cn);

$enlace = mysql_connect('localhost', 'root', '');
mysql_select_db("ccjj", $enlace);
if (!$enlace) {
    die('No se pudo conectar: ' . mysql_error());
}
?>
