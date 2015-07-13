<?php
require_once("../conexion/config.inc.php");

$nombreEdificio = $_POST['nombreEdificio'];
$accion = $_POST["accion"];

$codigoEdificio =  NULL;
if(isset($_POST["codigoEdificio"]))
{
    $codigoEdificio = $_POST["codigoEdificio"];
}

$consulta=$db->prepare("CALL SP_GESTIONAR_EDIFICIOS(?,?,?, @pcMensajeError)");
$consulta->bindParam(1, $codigoEdificio, PDO::PARAM_INT);
$consulta->bindParam(2, $nombreEdificio, PDO::PARAM_STR);
$consulta->bindParam(3, $accion, PDO::PARAM_INT);

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
                    Se ha creado exitosamente el edificio ' .  $nombreEdificio . '.</div>';            
            
            break;
        }
        
        //Actualizar
        case 2:
        {
            echo '<div id="resultado" class="alert alert-success">
                    Se ha actualizado exitosamente el edificio ' .  $nombreEdificio . '.</div>';            
                        
            break;
        }
        
        case 3:
        {
            echo '<div id="resultado" class="alert alert-success">
                    Se ha eliminado exitosamente el edificio.</div>';             
            break;
            
        }

    }
}
else 
{
        echo '<div id="resultado" class="alert alert-danger">
         ' . $mensaje . '</div>';
}

    
include 'ca_cargarEdificios.php';

?>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $("#resultado").fadeOut(1500);
    },3000);
	
});
</script>