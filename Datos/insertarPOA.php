<?php
include '../Datos/conexion.php';

$titulo= $_POST['titulo'];
$del= $_POST['inicio'];
$al= $_POST['fin'];
$observacion= $_POST['observacion'];

$consulta=$conectar->prepare("CALL pa_insertar_poa(?,?,?,?)");
$consulta->bind_param('ssss',$titulo,$del,$al,$observacion);
$resultado=$consulta->execute();

if($resultado==1)
    {
    echo '<div id="resultado" class="alert alert-success">
        se ha Creado un nuevo Plan Operativo Anual
         
         </div>';
    
    }else{
         echo '<div id="resultado" class="alert alert-danger">
        No se Inserto ningun Nuevo elemento 
         
         </div>';
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