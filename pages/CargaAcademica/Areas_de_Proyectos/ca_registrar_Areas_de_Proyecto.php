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
     //Se reciben valores enviados por el ajax
	   $nombre = $_POST['nombreAreaProyecto'];
     //Se llama al procedimiento almacenado
     $stmt = $db->prepare("CALL SP_INSERTAR_AREAS(?,@mensajeError)");
	   //Introduccion de parametros
     $stmt->bindParam(1, $nombre, PDO::PARAM_STR); 
     //Se ejecuta la consulta 
     $stmt->execute();
     //Se recibe un mensaje de error, que se generó al ejecutar la consulta
     $output = $db->query("select @mensajeError")->fetch(PDO::FETCH_ASSOC);
     //Se obtiene mensaje
     $mensaje = $output['@mensajeError'];
     $codMensaje = 1;

    }catch(PDOExecption $e){
      $mensaje = 'Error al ingresar el registro o registro actualmente existente.';
      $codMensaje = 0;
    }
    //Se envia resultado
    if($codMensaje == 1){
      echo '<div class="alert alert-success alert-succes">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Registro almacenado con éxito..! </strong>'.$mensaje.'</div>';
    }else{
      echo '<div class="alert alert-danger alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Error! </strong>'.$mensaje.'</div>';
  }
?>