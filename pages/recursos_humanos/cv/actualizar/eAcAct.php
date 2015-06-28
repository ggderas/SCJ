<?php
session_start();
include "../../../Datos/conexion.php";
function limpiar($tags)
{
    $tags = strip_tags($tags);
    return $tags;
}

//Información Personal
if (isset($_POST['modInst']) && isset($_POST['modTiem']) && isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $inst = limpiar($_POST['modInst']);
    $tiem = $_POST['modTiem'];
    $clase= $_POST['modClas'];


    $queryEA=mysql_query("UPDATE experiencia_academica SET Institucion = '$inst', Tiempo = '$tiem' WHERE ID_Experiencia_academica = '$id'");
             mysql_query("UPDATE clases_has_experiencia_academica SET ID_Clases = '$clase' WHERE ID_Experiencia_academica = '$id'");
    

      if($queryEA){

            $mensaje = 'Experiencia académica actualizado correctamente!';
            $codMensaje = 1;


        }else{
            $mensaje = 'error actualizar experiencia académica';
            $codMensaje = 0;

        }
    
}