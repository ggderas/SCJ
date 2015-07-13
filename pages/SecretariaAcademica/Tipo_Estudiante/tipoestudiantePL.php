<?php 
	//Replace the below connection parameters to fit your environment
	$host = 'mysqlv115'; 
	$dbname = 'ccjj';
	$user = 'ddvderecho';
	$pass = 'DDVD3recho';

	//conexion a la base de datos
	$connection = mysqli_connect($host, $user, $pass, $dbname);
	
	$Nid = NULL;
	//Se recupera valor enviado
	if(isset($_POST['Identidad']))
	{
		$Nid = $_POST['Identidad'];
	}

	$sentencia =  $connection->stmt_init();
	if ($sentencia->prepare("CALL SP_OBTENER_INFORMACION_ESTUDIANTE(?, @pcMensajeError)")) 
	{
		/* vincular los parámetros para los marcadores */
		$sentencia->bind_param("s", $Nid);
		/* ejecutar la consulta */
		$sentencia->execute();
		/* vincular las variables de resultados */
		$sentencia->bind_result($nombre, $tipo);
		/* obtener el valor */
		$sentencia->fetch();
		/* cerrar la sentencia */
		$sentencia->close();
		echo $nombre."/".$tipo;
	}
?>