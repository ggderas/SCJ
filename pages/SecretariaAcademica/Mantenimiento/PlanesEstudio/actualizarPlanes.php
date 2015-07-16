<?php  
$mkdir = "../../../../";
include($mkdir."conexion/config.inc.php");
    $pcCod = $_POST['id'];
    $query = 'SELECT * FROM sa_planes_estudio  WHERE sa_planes_estudio.codigo ='.$pcCod;
    $result = mysql_query($query);
    $json = array();
    $contadorIteracion = 0;
    while ($fila = mysql_fetch_array($result)) { 
        $json[$contadorIteracion] = array
            (
                "codPlan" => $fila["codigo"],
                "nombrePlan" => $fila["nombre"],
                "uvPlan" => $fila["uv"]
            );

        $contadorIteracion++;
    }

    //Retornamos el jason con todos los elmentos tomados de la base de datos.
    echo json_encode($json);
?>