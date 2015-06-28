<?php
include '../Datos/conexion.php';
$eIdA= $_POST['eId'];
$eNombre= $_POST['eNombreDTA'];
$obs= $_POST['eObservacionDTA'];
$consulta=$conectar->prepare("CALL pa_modificar_tipo_area (?,?,?)");
$consulta->bind_param('iss',$eIdA,$eNombre,$obs);
$resultado=$consulta->execute();


if($resultado==1)
    {
    echo '<div id="resultado2" class="alert alert-success">
        se ha Editado con exito
         
         </div>';
    
    }else{
         echo '<div id="resultado2" class="alert alert-danger">
        No se pudo Editar  
         </div>';
    }
    
    include '../Datos/mostrarTipos.php';


?>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $("#resultado2").fadeOut(1500);
    },3000);
});
</script>