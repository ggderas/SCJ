<?php
include '../Datos/conexion.php';
$aeIdA= $_POST['idTAS'];
$aeNombre= $_POST['nombreDA'];
$aeTipo= $_POST['tipoDA'];
$aobs= $_POST['observacionDA'];

$consulta=$conectar->prepare("CALL pa_modificar_area (?,?,?,?)");
$consulta->bind_param('isis',$aeIdA,$aeNombre,$aeTipo,$aobs);
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
    include '../Datos/mostrarAreas.php';
?>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $("#resultado2").fadeOut(1500);
    },3000);
});
</script>
