<?php
$mkdir = "../../../../";
include($mkdir."conexion/config.inc.php");

    /* Hacemos una consulta a la base de datos para obtener los datos de la tabla Ciudades. */
        $query = 'SELECT * FROM sa_ciudades';
        $result = mysql_query($query);
        $json = array();
        $contadorIteracion = 0;


        while ($fila = mysql_fetch_array($result)) { 
            $json[$contadorIteracion] = array
                (
                "codCiudad" => $fila["codigo"],
                "nombreCiudad" => $fila["nombre"]
                );

            $contadorIteracion++;
        }

        //Retornamos el jason con todos los elmentos tomados de la base de datos.
        echo json_encode($json);
?>

