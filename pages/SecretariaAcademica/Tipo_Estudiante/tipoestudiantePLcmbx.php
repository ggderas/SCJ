<?php

include '../../../Datos/conexion.php';

if(isset($_POST['accion']))
{
    $accion = $_POST['accion'];
    
    switch($accion)
    {
        //Obtener tipos de solicitudes
        case 1:
        {
            $query = 'CALL SP_OBTENER_TIPOS_ESTUDIANTES(@pcMensajeError)';
            $result = mysql_query($query);
            
            $json = array();
            $contadorIteracion = 0;
            
            while($fila = mysql_fetch_array($result))
            {
                $json[$contadorIteracion] = array 
                (
                    "codigoTipoEstudiante" => $fila["codigo"],
                    "nombreTipoEstudiante" => $fila["descripcion"],
                );
                
                $contadorIteracion++;
            }
            
            echo json_encode($json);
            break;
        }
    }
}