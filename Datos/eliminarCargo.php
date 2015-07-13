    <?php
    
        require_once('funciones.php');
     
    
        if (isset($_POST['ID_cargo'])) {
            $id = $_POST['ID_cargo'];
            
            if(mysql_query("DELETE FROM cargo WHERE ID_cargo='$id'")){
            echo mensajes('Cargo"' . $id . '" Eliminado con Exito', 'verde');
            }else{
                
            echo mensajes('Cargo"' . $id . '" No se puede eliminar', 'rojo');
                
            }
        }
        
        
      
        
    ?>
