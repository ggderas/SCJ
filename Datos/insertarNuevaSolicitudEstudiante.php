<?php
require_once("../conexion/config.inc.php");

$pcIdentidadEstudiante= $_POST['identidad'];
$pcTipoSolicitud= $_POST['solicitud'];
$pnCodigoPeriodo= $_POST['periodo'];
$pcHimno=$_POST['himno'];
$fecha=$_POST['fecha'];


$consulta=$db->prepare("CALL SP_REGISTRAR_SOLICITUD(?,?,?,?,?,@pcMensajeError)");
$consulta->bindParam(1, $pcIdentidadEstudiante, PDO::PARAM_STR);
$consulta->bindParam(2, $pcTipoSolicitud, PDO::PARAM_STR);
$consulta->bindParam(3, $pnCodigoPeriodo, PDO::PARAM_INT);
$consulta->bindParam(4, $pcHimno, PDO::PARAM_BOOL);
$consulta->bindParam(5, $fecha, PDO::PARAM_STR);

$resultado=$consulta->execute();

$output = $db->query("select @pcMensajeError")->fetch(PDO::FETCH_ASSOC);

$mensaje = $output['@pcMensajeError'];

if ($mensaje == NULL)
{
    echo '<div id="resultado" class="alert alert-success">
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
        $(" ").fadeOut(1500);
    },3000);
	
});
</script>