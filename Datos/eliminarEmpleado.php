<?php

require_once('funciones.php');


$enlace = mysql_connect('localhost', 'root', '');
mysql_select_db("sistema_ciencias_juridicas", $enlace);


if (isset($_POST['codigoE'])) {
    $id=$_POST['codigoE'];
     $fecha=date("Y-m-d");
    
     $query=mysql_query("UPDATE empleado SET fecha_salida='$fecha',estado_empleado='0' WHERE No_Empleado='".$id."'");
   

     
    if($query){
    
    echo mensajes('empleado con codigo"'.$id .'" ha sido dado de alta con Exito', 'verde');
    }
    else{
     
    echo mensajes('NO se puede dar de alta al empleado con codigo"'.$id . '"', 'rojo');
        
    }
}


?>