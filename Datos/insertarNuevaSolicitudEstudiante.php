<?php
require_once("../conexion/config.inc.php");

$pcIdentidadEstudiante= $_POST['identidad'];
$pcTipoSolicitud= $_POST['solicitud'];
$pnCodigoPeriodo= $_POST['periodo'];


$consulta=$db->prepare("CALL SP_REGISTRAR_SOLICITUD(?,?,?,@pcMensajeError)");
$consulta->bindParam(1, $pcIdentidadEstudiante, PDO::PARAM_STR);
$consulta->bindParam(2, $pcTipoSolicitud, PDO::PARAM_STR);
$consulta->bindParam(3, $pnCodigoPeriodo, PDO::PARAM_INT);

$resultado=$consulta->execute();

$output = $db->query("select @pcMensajeError")->fetch(PDO::FETCH_ASSOC);

$mensaje = $output['@pcMensajeError'];

if ($mensaje == NULL)
{
    echo '<div id="resultado" class="alert alert-danger">
    ' . 'Solicitud Guardada exitosamente'. '</div>';
}
else
{
    echo '<div id="resultado" class="alert alert-danger">
    ' . $mensaje . '</div>';
}

//include 'nuevaSolicitud.php';

?>





<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $("#resultado").fadeOut(1500);
    },3000);
	
});
</script>