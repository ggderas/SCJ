<?php
session_start();
include "../../../Datos/conexion.php";
function limpiar($tags)
{
    $tags = strip_tags($tags);
    return $tags;
}

//Información Personal
if (isset($_POST['modEmp']) && isset($_POST['modTiem']) && isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $emp = limpiar($_POST['modEmp']);
    $tiem = $_POST['modTiem'];
    $cargo = $_POST['modCarg'];


  $queryAcEL= mysql_query("UPDATE experiencia_laboral SET Nombre_empresa = '$emp', Tiempo = '$tiem' WHERE ID_Experiencia_laboral = '$id'");
              mysql_query("UPDATE experiencia_laboral_has_cargo SET  ID_cargo = '$cargo' WHERE ID_Experiencia_laboral = '$id'");

    
    
         if($queryAcEL){

            $mensaje = 'Experiencia laboral se ha actualizado correctamente!';
            $codMensaje = 1;


        }else{
            $mensaje = 'error al actualizar';
            $codMensaje = 0;

        }
    
    
}