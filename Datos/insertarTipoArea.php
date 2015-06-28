<?php
include '../Datos/conexion.php';
$nombre= $_POST['nombreTA'];
$obs= $_POST['observacionTA'];

$consulta=$conectar->prepare("CALL pa_insertar_tipo_area(?,?);");
$consulta->bind_param('ss',$nombre,$obs);
$resultado=$consulta->execute();

if($resultado==1)
    {
    echo '<div id="resultado" class="alert alert-success">
        se ha ingresaso un nuevo Tipo de Area
         
         </div>';
    
    }else{
         echo '<div id="resultado" class="alert alert-danger">
        No se pudo almacenaar
         
         </div>';
    }

?>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $("#resultado").fadeOut(1500);
    },3000);
	
});
</script>
