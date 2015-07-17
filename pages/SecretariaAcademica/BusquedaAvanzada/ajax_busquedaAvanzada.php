<?php


$maindir = "../../../";
include $maindir . 'Datos/conexion.php';
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
        case 2: 
        {
                    $identi = $_POST['numeroIdentidad'];
                    $pfecha = $_POST['fechaSolicitud'];
                    $tipoSolicitud = $_POST['codigoTipoSolicitud'];
                    
                    $_SESSION["N_IDENTIDAD"] = $identi;
                    $_SESSION["FECHA"] = $pfecha;
                    $_SESSION["TIPO_SOLICITUD"] = $tipoSolicitud;
                    
                    if($identi == NULL)
                    {
                        $identi = 'NULL';
                    }
                    else
                    {
                        $identi = "'" . $identi . "'";
                    }
                    
                    if($pfecha == NULL)
                    {
                        $pfecha = 'NULL';
                    }
                    else
                    {
                        $pfecha = "'" . $pfecha . "'";
                    }                    
                    
                    if($tipoSolicitud == NULL)
                    {
                        $tipoSolicitud = 'NULL';
                    }                     

                    $query = 'CALL SP_BUSQUEDA_SECRETARIA('
                             . $identi . ","
                             . $pfecha . ","
                             . $tipoSolicitud . ", @mensajeError)";
                    
                    $result = mysql_query($query);

                    $json = array();
                    $contadorIteracion = 0;


                    while ($fila = mysql_fetch_array($result)) 
                    {
                        //El objeto json es un array por lo que hacemos un recorrido y le ingresamos los valores
                        //solicitados.
                        $json[$contadorIteracion] = array
                        (
                            "numeroIdentidad" => $fila["NUMERO_IDENTIDAD"],
                            "Nombre" => $fila["NOMBRE"],
                            "numeroCuenta" => $fila["NUMERO_CUENTA"],
                            "indiceAcademico" => $fila["INDICE_ACADEMICO"],
                            "tipoEstudiante" => $fila["DESCRIPCION_TIPO_ESTUDIANTE"],
                            "tipoSolicitud" => $fila["NOMBRE_TIPO_SOLICITUD"],
                            "fecha" => $fila["FECHA_SOLICITUD"]
                        );

                        $contadorIteracion++;
                    }
                    
                    echo json_encode($json);
                    break;
            }
            
    }
}
