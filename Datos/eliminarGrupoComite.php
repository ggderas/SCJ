    <?php
    
      require_once('funciones.php');
    
        if (isset($_POST['grupoComite'])) {
            $id = $_POST['grupoComite'];
            
            if(mysql_query("DELETE FROM grupo_o_comite WHERE ID_Grupo_o_comite='$id'")){
            echo mensajes('Comite"' . $id . '" Eliminado con Exito', 'verde');
            }else{
                
            echo mensajes('Comite"' . $id . '" No se puede eliminar', 'rojo');
                
            }
        }
        
        
        
        
    ?>