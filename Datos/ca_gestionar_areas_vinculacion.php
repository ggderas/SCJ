<?php
require_once("../conexion/config.inc.php");

$nombreArea = $_POST['nombreArea'];
$accion = $_POST["accion"];
$codigoFacultad = $_POST["codigoFacultad"];

$codigoArea =  NULL;
if(isset($_POST["codigoArea"]))
{
    $codigoArea = $_POST["codigoArea"];
}

$consulta=$db->prepare("CALL SP_GESTIONAR_AREAS_VINCULACION(?,?,?,?, @pcMensajeError)");
$consulta->bindParam(1, $codigoArea, PDO::PARAM_INT);
$consulta->bindParam(2, $nombreArea, PDO::PARAM_STR);
$consulta->bindParam(3, $codigoFacultad, PDO::PARAM_STR);
$consulta->bindParam(4, $accion, PDO::PARAM_INT);

$resultado=$consulta->execute();

$output = $db->query("select @pcMensajeError")->fetch(PDO::FETCH_ASSOC);
$mensaje = $output['@pcMensajeError'];

if ($mensaje == NULL)
{
    switch($accion)
    {
        // Registrar
        case 1:
        {
            echo '<div id="resultado" class="alert alert-success">
                    Se ha creado exitosamente el Área de Vinculación ' .  $nombreArea . '.</div>';

            break;
        }

        //Actualizar
        case 2:
        {
            echo '<div id="resultado" class="alert alert-success">
                    Se ha modificado exitosamente el Área de Vinculación ' .  $nombreArea . '.</div>';

            break;
        }

        case 3:
        {
            echo '<div id="resultado" class="alert alert-success">
                    Se ha eliminado exitosamente el Área de Vinculación.</div>';
            break;

        }

    }
}
else
{
        echo '<div id="resultado" class="alert alert-danger">
         ' . $mensaje . '</div>';
}


include 'ca_cargarAreaVinculacion.php';

?>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $("#resultado").fadeOut(1500);
    },3000);

});
</script>
