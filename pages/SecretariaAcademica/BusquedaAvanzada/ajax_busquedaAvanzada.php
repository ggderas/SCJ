<?php

include '../../../Datos/conexion.php';
$maindir = "../../../";
include($maindir . "conexion/config.inc.php");

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    switch ($accion) {
        //Obtener tipos de solicitudes
        case 1: {
                $query = 'SELECT codigo, nombre FROM sa_tipos_solicitud';
                $result = mysql_query($query);

                $json = array();
                $contadorIteracion = 0;


                while ($fila = mysql_fetch_array($result)) {
                    //El objeto json es un array por lo que hacemos un recorrido y le ingresamos los valores
                    //solicitados. 
                    $json[$contadorIteracion] = array
                        (
                        "codigoTipoSolicitud" => $fila["codigo"],
                        "nombreTipoSolicitud" => $fila["nombre"],
                    );

                    $contadorIteracion++;
                }

                //Retornamos el jason con todos los elmentos tomados de la base de datos.
                echo json_encode($json);
                break;
            }
        case 2: {
                try {
                    $identi = $_POST['nIdentidad'];
                    $pfecha = $_POST['fecha'];
                    $tipoSolicitud = $_POST['tipoSolicitud'];

                    $stmt = $db->prepare("CALL SP_BUESQUEDA_SECRETARIA(?,?,?,@mensajeError)");

                    // Parametros de la consulta
                    $stmt->bindParam(1, $identi, PDO::PARAM_STR);
                    $stmt->bindParam(2, $pfecha, PDO::PARAM_STR);
                    $stmt->bindParam(3, $tipoSolicitud, PDO::PARAM_STR);
                    $stmt->execute();
                    $output = $db->query("select @mensajeError")->fetch(PDO::FETCH_ASSOC);
                    $mensaje = $output['@mensajeError'];
                } catch (PDOExecption $e) {
                    //$mensaje = 'error al ingresar el registro o registro actualmente existente';
                    $codMensaje = 0;
                }

                if (is_null($mensaje)) {

                    $jason = array();
                    $contador = 0;

                    $json[$contador] = array
                    (
                    "numeroIdentidad" ==> $fila[""];
                    "Nombre" ==> $fila[""];
                    "numeroCuenta" ==> $fila[""];
                    "indiceAcademico" ==> $fila[""];
                    "tipoEstudiante" ==> $fila[""];
                    "tipoSolicitud" ==> $fila[""];
                    "fecha" ==> $fila[""];
                    echo json_encode($jason);
                    )
                }
                break;
            }
    }
}

