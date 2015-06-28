<?php

$enlace = mysql_connect('localhost', 'root', '');
mysql_select_db("sistema_ciencias_juridicas", $enlace);


if (isset($_POST['codigoE'])) {
    
    $id=$_POST['codigoE'];
    $Comite=$_POST['codigoComite'];
     
      $pa2= mysql_query("SELECT * FROM grupo_o_comite where Nombre_Grupo_o_comite='".$Comite."'") ;
             //var_dump($pa2);

               $row2=mysql_fetch_array($pa2);
               $idG=$row2['ID_Grupo_o_comite'];
    
    
    
     $query=mysql_query("DELETE FROM `grupo_o_comite_has_empleado` WHERE No_Empleado='".$id."' AND ID_Grupo_o_comite='".$idG."'");
   
  
     
    if($query){
        
          $mensaje = 'Empleado agregado con Exito';
            $codMensaje = 1;
    
    //echo mensajes('empleado con codigo"'.$id .'" ha sido dado de alta con Exito', 'verde');
    }
    else{
     
         $mensaje = 'error al Eliminar el registro';
            $codMensaje = 0;
            
    //echo mensajes('NO se puede dar de alta al empleado con codigo"'.$id . '"', 'rojo');
        
    }
}
