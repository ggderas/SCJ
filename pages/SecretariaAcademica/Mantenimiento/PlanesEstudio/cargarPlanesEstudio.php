<?php
$mkdir = "../../../../";
include($mkdir."conexion/config.inc.php");

    /* Hacemos una consulta a la base de datos para obtener los datos de la tabla Ciudades. */
        $query = 'SELECT * FROM sa_planes_estudio';
        $result = mysql_query($query);
        $json = array();
        $contadorIteracion = 0;


        while ($fila = mysql_fetch_array($result)) { 
            $json[$contadorIteracion] = array
                (
                "codPlan" => $fila["codigo"],
                "nombrePlan" => $fila["nombre"],
                "uv" => $fila["uv"]
                );

            $contadorIteracion++;
        }

        //Retornamos el jason con todos los elmentos tomados de la base de datos.
        echo json_encode($json);
?>

