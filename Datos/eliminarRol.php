    <?php
    
       include '../Datos/funciones.php';
      include'../Datos/conexion.php';
    
        if (isset($_POST['Id_Rol'])) {
            $id = $_POST['Id_Rol'];
            
            if(mysql_query("DELETE FROM roles WHERE Id_Rol='$id'")){
            echo mensajes('Rol "' . $id . '" Eliminado con Exito', 'verde');
            }else{
                
            echo mensajes('Rol "' . $id . '" No se puede eliminar', 'rojo');
                
            }
        }
        
        
        include '../Datos/cargarRoles.php';
        
    ?>