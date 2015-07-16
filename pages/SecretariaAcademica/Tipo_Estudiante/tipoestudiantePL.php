<?php 

	$mkdir = "../../../../";
	include($mkdir."conexion/config.inc.php");
	
	$Nid = NULL;
	//Se recupera valor enviado
	if(isset($_POST['Identidad']))
	{
		$Nid = $_POST['Identidad'];
	}

    //Replace the below connection parameters to fit your environment
    $host = 'localhost'; 
    $dbname = 'ccjj';
    $user = 'root';
    $pass = '';

    //conexion a la base de datos
    $connection = mysqli_connect($host, $user, $pass, $dbname);
    
    $Message= "Numero de indentidad incorrecto";
    //Se recupera valor enviado
    if(isset($_POST['Identidad']))
    {
        $Nid = $_POST['Identidad'];
    }

    $sentencia =  $connection->stmt_init();
    if ($sentencia->prepare("CALL SP_OBTENER_INFORMACION_ESTUDIANTE(?, @pcMensajeError)")) 
    {
        if ($Nid != NULL) 
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
            echo $nombre."*".$tipo;
        }else {echo "Numero de identidad incorrecto"."*";}
    }       
?>