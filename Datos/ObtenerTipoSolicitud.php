<?php
require_once("../conexion/config.inc.php");

$pcIdentidadEstudiante= $_POST['id'];


$consulta=$db->prepare("CALL SP_OBTENER_TIPOS_SOLICITUDES_POR_ESTUDIANTE(?,@pcMensajeError)");
$consulta->bindParam(1, $pcIdentidadEstudiante, PDO::PARAM_STR);


$resultado=$consulta->execute();


$output = $db->query("select @pcMensajeError")->fetch(PDO::FETCH_ASSOC);


$mensaje = $output['@pcMensajeError'];

if ($mensaje == NULL)
{

	$json = array();
	$interacion = 0;

	WHILE($linea=mysqli_fetch_array($resultado))
	{
	    $json[$interacion] = array
        	(
	            "codigoTipoSolicitud" => $linea["codigo"],
        	    "nombreSolicitud" => $linea["nombre"]
	        );
    
    	    $interacion++;
	}

	echo json_encode($json);

	    
}
else
{
    echo '<div id="resultado" class="alert alert-danger">
    ' . $mensaje . '</div>';
}

?>