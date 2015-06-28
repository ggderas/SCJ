
<?php
include '../Datos/conexion.php';
$nombre= $_POST['nombreDA'];
$tipoArea= $_POST['tipoDA'];
$obs= $_POST['observacionDA'];
$consulta=$conectar->prepare("CALL pa_insertar_area(?,?,?)");
$consulta->bind_param('sis',$nombre,$tipoArea,$obs);
$resultado=$consulta->execute();

if($resultado==1)
    {
    echo '<div id="resultado2" class="alert alert-success">
        se ha ingresaso una nueva Area 
         
         </div>';
    
    }else{
         echo '<div id="resultado2" class="alert alert-danger">
        No se pudo almacenaar el Area 
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



