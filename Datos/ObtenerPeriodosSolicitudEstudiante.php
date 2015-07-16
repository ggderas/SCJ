<?php
require_once("../conexion/config.inc.php");

//$pcIdentidadEstudiante= $_POST['id'];

$query= 'CALL SP_OBTENER_PERIODOS_ACADEMICOS(@pcMensajeError)';
$result = mysql_query($query);
$json = array();
$interacion = 0;

WHILE($linea=  mysql_fetch_array($result))
{
    $json[$interacion] = array
        (
            "idPeriodo" => $linea["codigo"],
            "nombrePeriodo" => $linea["nombre"]
        ); 

    $interacion++;
}

echo json_encode($json);	    
?>
