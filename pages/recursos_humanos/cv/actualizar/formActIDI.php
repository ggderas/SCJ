<?php
session_start();
include "../../../Datos/conexion.php";

//Información Personal
if (isset($_POST['modIdioma']) && isset($_POST['modNivel']) && isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $idioma = $_POST['modIdioma'];
    $nivel = $_POST['modNivel'];

    $s = mysql_query("SELECT ID_Idioma FROM idioma WHERE Idioma = '$idioma'");
    $idIdioma = mysql_fetch_array($s)['ID_Idioma'];


   $queryAcIdi= mysql_query("UPDATE idioma_has_persona SET ID_Idioma = '$idIdioma', Nivel = '$nivel' WHERE Id = '$id'");
    
         if($queryAcIdi){

            $mensaje = 'Idioma actualizado correctamente!';
            $codMensaje = 1;


        }else{
            $mensaje = 'error actualizar';
            $codMensaje = 0;

        }

   
}
?>