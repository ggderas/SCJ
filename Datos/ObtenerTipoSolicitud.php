<?php
require_once("../conexion/config.inc.php");

$pcIdentidadEstudiante= $_POST['id'];


$consulta="CALL SP_OBTENER_TIPOS_SOLICITUDES_POR_ESTUDIANTE('".$pcIdentidadEstudiante."',@pcMensajeError)";
$resultado=mysql_query($consulta);

$json = array();
$interacion = 0;

WHILE($linea=mysql_fetch_array($resultado))
	{
	    $json[$interacion] = array
        	(                
	            "codigo" => $linea["codigo"],
        	    "nombre" => $linea["nombre"]
	        );
    
    	    $interacion++;
	}
echo json_encode($json);	

?>