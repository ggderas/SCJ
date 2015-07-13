    <?php
    
      require_once 'funciones.php';
     
    
        if (isset($_POST['Id_Pais'])) {
            $id = $_POST['Id_Pais'];
            
            if(mysql_query("DELETE FROM pais WHERE Id_pais='$id'")){
            echo mensajes('Pais"' . $id . '" Eliminado con Exito', 'verde');
            
            }else{
                
            echo mensajes('Pais"' . $id . '" No se puede eliminar', 'rojo');
                
            }
        }
        
        
        
        
    ?>
