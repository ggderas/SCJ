<?php 
$conectar = new mysqli('205.178.146.115','ddvderecho','DDVD3recho','ccjj');
//$cn = mysql_connect("localhost","root","");
//mysql_select_db("poa", $cn);

$enlace = mysql_connect('localhost', 'root', '');
mysql_select_db('ccjj', $enlace);
if (!$enlace) 
{
    die('No se pudo conectar: ' . mysql_error());
}

?>
