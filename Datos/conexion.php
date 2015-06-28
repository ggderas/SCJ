<?php 
$conectar = new mysqli('mysqlv115','ddvderecho','DDVD3recho','ccjj');
//$cn = mysql_connect("localhost","root","");
//mysql_select_db("poa", $cn);

$enlace = mysql_connect('mysqlv115', 'ddvderecho', 'DDVD3recho');
mysql_select_db('ccjj', $enlace);
if (!$enlace) {
    die('No se pudo conectar: ' . mysql_error());
}



?>
