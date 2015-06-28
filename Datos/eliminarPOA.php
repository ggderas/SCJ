<?php
require_once("../conexion/config.inc.php");

$id= $_POST['id'];
//echo $id;
$consulta=$db->prepare("CALL pa_eliminar_poa(?,  @mensaje, @codMensaje)");
$consulta->bindParam(1, $id, PDO::PARAM_INT);
$resultado=$consulta->execute();

$output = $db->query("select @mensaje, @codMensaje")->fetch(PDO::FETCH_ASSOC);
$mensaje = $output['@mensaje'];
$codMensaje = $output['@codMensaje'];

if ($mensaje == NULL) {
    echo '<div id="resultado" class="alert alert-success">
        Se ha eliminado el POA correctamente.</div>';
} else {
    echo '<div id="resultado" class="alert alert-danger">
         ' . $mensaje . '</div>';
}
include 'cargarPOAs.php';
?>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $("#resultado").fadeOut(1500);
    },3000);
	
});
</script>

