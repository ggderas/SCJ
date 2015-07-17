<?php
/*Conexion a la base de datos*/
include '../../../Datos/conexion.php';

/*Se comprueba valor que se ha mandado*/
if(isset($_POST['accion']))
{
    $accion = $_POST['accion'];
    
    switch($accion)
    {
        case 1:
        {
            /*Se llama al procedimiento para obtener tipos de estudiante*/
            $query = 'CALL SP_OBTENER_TIPOS_ESTUDIANTES(@pcMensajeError)';
            /*Se obtiene resultado, devuelto por el procedimiento*/
            $result = mysql_query($query);
            /*Se crea un arreglo, para almacenar el resultado devuelto*/
            $json = array();
            $contadorIteracion = 0;
            /*Se agrega el resultado devuelto al arreglo*/
            while($fila = mysql_fetch_array($result))
            {
                $json[$contadorIteracion] = array 
                (
                    "codigoTipoEstudiante" => $fila["codigo"],
                    "nombreTipoEstudiante" => $fila["descripcion"],
                );
                
                $contadorIteracion++;
            }
            /*Se envia resultado*/
            echo json_encode($json);
            break;
        }
    }
}