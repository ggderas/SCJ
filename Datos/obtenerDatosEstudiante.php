<?php

require_once("conexion.php");

$pcIdentidadEstudiante=$_POST['id'];
/*
$consulta=$db->prepare("CALL SP_OBTENER_INFORMACION_ESTUDIANTE(?,@pcMensajeError)");
$consulta->bindParam(1, $pcIdentidadEstudiante, PDO::PARAM_STR);
$resultado=$consulta->execute();
*/
$consulta="CALL SP_OBTENER_INFORMACION_ESTUDIANTE('".$pcIdentidadEstudiante."',@pcMensajeError)";
$resultado=mysqli_query($conectar,$consulta);
$result=mysqli_query($conectar,'select @pcMensajeError');
$error=null;

if($result){
$pcMensajeError=mysqli_fetch_array($result);
$error=$pcMensajeError[0];
}

if($error==null){
    $linea=mysqli_fetch_array($resultado);
$outp = "[";

    
    $outp .= '{"nombre":"'  . $linea[0] . '",';
    $outp .= '"descripcion":"'   . $linea[1]        . '",';
    $outp .= '"existe":"1"';

$outp .="}]";
}
else
{    
  $outp = "[";

   
    $outp .= '{"nombre":"",';
    $outp .= '"descripcion":"",';
$outp .= '"existe":"0"';
$outp .="}]";  


    
}


echo($outp);




    

//echo($resultado)
?>
