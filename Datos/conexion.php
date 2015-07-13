<?php 
$conectar = new mysqli('localhost','root','','ccjj');
//$cn = mysql_connect("mysqlv115","root","");
//mysql_select_db("poa", $cn);

$enlace = mysql_connect('localhost', 'root', '');
mysql_select_db('ccjj', $enlace);
if (!$enlace) 
{
    die('No se pudo conectar: ' . mysql_error());
}

?>
