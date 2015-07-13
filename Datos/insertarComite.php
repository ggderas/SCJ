<?php

require_once('funciones.php');




//echo $_POST['nombre'];
if (isset($_POST['nombreComite'])) {
    $nombre1 = $_POST['nombreComite'];
    $query = "INSERT INTO grupo_o_comite(Nombre_Grupo_o_comite) VALUES('$nombre1')";

    mysql_query($query);
    
       if($query){
           
           
           echo mensajes('Agregado con Exito','verde');
       }else{
        
           echo mensajes('no se puedo ingresar registro','rojo');
       }
}

?>