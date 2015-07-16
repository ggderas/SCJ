<?php  
$mkdir = "../../../../";
include($mkdir."conexion/config.inc.php");
    $pcCod = $_POST['id'];
    $query = 'SELECT * FROM sa_menciones_honorificas  WHERE sa_menciones_honorificas.codigo ='.$pcCod;
    $result = mysql_query($query);
    $json = array();
    $contadorIteracion = 0;
    while ($fila = mysql_fetch_array($result)) { 
        $json[$contadorIteracion] = array
            (
                "codMencion" => $fila["codigo"],
                "nombreMencion" => $fila["descripcion"]
            );

        $contadorIteracion++;
    }

    //Retornamos el jason con todos los elmentos tomados de la base de datos.
    echo json_encode($json);
?>