<?php

require_once('funciones.php');
    if (isset($_POST['departamento'])) 
    {
        $depto = $_POST['departamento']; 
        $query = "INSERT INTO departamento_laboral(nombre_departamento) VALUES('$depto')";
        mysql_query($query); 
        
        
             if($query){
           
           
           echo mensajes('Agregado con Exito','verde');
       }else{
        
           echo mensajes('no se puedo ingresar registro','rojo');
       }

    }
      
?>
