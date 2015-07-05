<?php
require_once("../conexion/config.inc.php");

$accion = $_POST["accion"];

$codigoEdificio =  NULL;
$codigoAula = NULL;
$numeroAula = NULL;

if(isset($_POST["codigoEdificio"]))
{
    $codigoEdificio = $_POST["codigoEdificio"];
}

if(isset($_POST["codigoAula"]))
{
    $codigoAula = $_POST["codigoAula"];
}

if(isset($_POST["numeroAula"]))
{
    $numeroAula = $_POST['numeroAula'];
}

$consulta=$db->prepare("CALL SP_GESTIONAR_AULAS(?,?,?, ?, @pcMensajeError)");
$consulta->bindParam(1, $codigoEdificio, PDO::PARAM_INT);
$consulta->bindParam(2, $numeroAula, PDO::PARAM_STR);
$consulta->bindParam(3, $codigoAula, PDO::PARAM_INT);
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
                    Se ha creado exitosamente el aula ' .  $numeroAula . '.</div>';            
            
            break;
        }
        
        //Actualizar
        case 2:
        {
            echo '<div id="resultado" class="alert alert-success">
                    Se ha actualizado exitosamente el aula ' .  $numeroAula . '.</div>';            
                        
            break;
        }
        
        case 3:
        {
            echo '<div id="resultado" class="alert alert-success">
                    Se ha eliminado exitosamente el aula.</div>';             
            break;
            
        }

    }
}
else 
{
        echo '<div id="resultado" class="alert alert-danger">
         ' . $mensaje . '</div>';
}

$_SESSION["SA_CODIGO_EDIFICIO"] = $codigoEdificio;

    
include 'ca_cargarAulas.php';

?>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $("#resultado").fadeOut(1500);
    },3000);
	
});
</script>