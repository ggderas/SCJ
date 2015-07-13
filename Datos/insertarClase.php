<?php


 require_once('funciones.php');



//echo $_POST['nombre'];
if (isset($_POST['nombre'])) {
    $nombre1 = $_POST['nombre'];
    $query = "INSERT INTO clases(Clase) VALUES('$nombre1')";

    mysql_query($query);
    
    
      if($query){
           
           
           echo mensajes('Agregado con Exito','verde');
       }else{
        
           echo mensajes('no se puedo ingresar registro','rojo');
       }
    
}

?>