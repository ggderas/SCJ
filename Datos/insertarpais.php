<?php

 

require_once 'funciones.php';
  	

    if (isset($_POST['Pais'])) 
    {
        $Pais = $_POST['Pais']; 
        
  
       $query =mysql_query("INSERT INTO pais(Nombre_pais) VALUES('$Pais')"); 
       
       
       if($query){
           
           
           echo mensajes('Agregado con Exito','verde');
       }else{
        
           echo mensajes('no se puedo ingresar registro','rojo');
       }
        
       
    }   
   
   
    
    
?>
