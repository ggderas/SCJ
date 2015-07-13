<?php
include '../Datos/conexion.php';

$id=$_POST['id'];
$nombre=$_POST['nom'];
$tipo=$_POST['tpo'];
$obs=['t'];

$id2=$_POST['ide2'];
$nombre2=$_POST['nombre2'];
$idTA=$_POST['idTA2'];
$obs2=$_POST['obs2'];

$consulta=$conectar->prepare("CALL pa_editar_area(?,?,?,?,?)");
$consulta->bind_param('isis',$id2,$nombre2,$idTA,$obs2);
$resultado=$consulta->execute();

if($resultado==1)
    {
    echo '<div id="resultado" class="alert alert-success">
        Se ha editado El Area
         
         </div>';
    
    }else{
         echo '<div id="resultado" class="alert alert-danger">
        No se EDito ningun Elemento 
         
         </div>';
    }

    
include 'mostrarAreas.php';

?>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $("#resultado").fadeOut(1500);
    },3000);
	
});
</script>





?>


<div>
    
    <p>HOLA MUNDO</p>
    
</div>