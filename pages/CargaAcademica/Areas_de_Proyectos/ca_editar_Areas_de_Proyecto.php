<?php
$maindir = "../../../";
include($maindir."conexion/config.inc.php");  
require_once($maindir."funciones/check_session.php");
require_once($maindir."funciones/timeout.php");
if(!isset( $_SESSION['user_id'] ))
{
  header('Location: '.$maindir.'login/logout.php?code=100');
  exit();
}

  try
  {
    $codigo = $_POST['codAreaProyecto'];
    $nombre = $_POST['nomAreaProyecto'];
    $stmt = $db->prepare("CALL SP_MODIFICAR_AREAS(?,?,@mensajeError)");
	     //Introduccion de parametros
    $stmt->bindParam(1, $codigo, PDO::PARAM_STR);
    $stmt->bindParam(2, $nombre, PDO::PARAM_STR); 

    //echo $codigo . $nombre;
       
     $stmt->execute();
     $output = $db->query("select @mensajeError")->fetch(PDO::FETCH_ASSOC);
     //var_dump($output);
     $mensaje = $output['@mensajeError'];
     $codMensaje = 1;
      
    }catch(PDOExecption $e){
      $mensaje = 'Error al ingresar el registro o registro actualmente existente';
      $codMensaje = 0;
    }
    
    if($codMensaje == 1){
      echo '<div class="alert alert-info alert-succes">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Registro modificado con éxito..! </strong>'.$mensaje.'</div>';
    }else{
      echo '<div class="alert alert-danger alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Error, el registro noo pudo se modificado! </strong>'.$mensaje.'</div>';
  }
?>