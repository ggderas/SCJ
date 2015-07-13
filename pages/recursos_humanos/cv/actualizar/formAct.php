<?php
session_start();
include "../../../Datos/conexion.php";

//Información Personal
if (isset($_POST['modTipo']) && isset($_POST['modTitulo']) && isset($_POST['modUniversidad']) && isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $tipo = $_POST['modTipo'];
    $titulo = $_POST['modTitulo'];
    $universidad = $_POST['modUniversidad'];

    $s = mysql_query("SELECT ID_Tipo_estudio FROM tipo_estudio WHERE Tipo_estudio = '$tipo'");
    $idTipo = mysql_fetch_array($s)['ID_Tipo_estudio'];
    $t = mysql_query("SELECT Id_universidad FROM universidad WHERE nombre_universidad = '$universidad'");
    $idUniver = mysql_fetch_array($t)['Id_universidad'];

//Agregar ON UPDATE CASCADE, ON DELETE CASCADE A LA TABLA telefono.
   $queryAcFA=mysql_query("UPDATE estudios_academico SET Nombre_titulo = '$titulo', ID_Tipo_estudio = '$idTipo', Id_universidad = '$idUniver' WHERE ID_Estudios_academico = '$id'");

          if($queryAcFA){

            $mensaje = 'Formación académica actualizado correctamente!';
            $codMensaje = 1;


        }else{
            $mensaje = 'error actualizar';
            $codMensaje = 0;

        }
    
  
}
?>