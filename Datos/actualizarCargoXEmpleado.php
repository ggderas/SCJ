<?php


if(isset($_POST['codigo'])){
    
    $codigo2=$_POST['codigo'];
    $idcargo=$_POST['cargoE'];
    $fecha=  date("y-m-d");
    

$query2=mysql_query("UPDATE empleado_has_cargo SET Fecha_salida_cargo='$fecha' WHERE No_empleado ='".$codigo2."' AND ID_cargo='".$idcargo."' ");


if($query2){
    
      $mensaje = 'Empleado actualizado con Exito';
            $codMensaje = 1;
    
    
}else{
    
    
     $mensaje = 'error al actualizar el empleado';
             $codMensaje = 0;
    
    
}

}