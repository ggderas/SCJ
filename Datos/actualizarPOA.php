
<?php
include '../Datos/conexion.php';
$idPOA= $_POST['idPOA'];
$titulo= $_POST['titulo'];
$del= $_POST['inicio'];
$al= $_POST['fin'];
$observacion= $_POST['observacion'];
//echo $idPOA;
$consulta=$conectar->prepare("CALL pa_modificar_poa(?,?,?,?,?)");
$consulta->bind_param('issss',$idPOA,$titulo,$del,$al,$observacion);
$resultado=$consulta->execute();

if($resultado==1)
    {
    echo '<div id="resultado" class="alert alert-success">
        Se ha Actializado un Plan Operativo Anual
         
         </div>';
    
    }else{
         echo '<div id="resultado" class="alert alert-danger">
        No se Actualizo ningun Elemento 
         
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
