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


	try{

		  $nombre = $_POST['nombreSolicitud'];
      $('#myModal').modal('hide');
       $stmt = $db->prepare("CALL SP_REGISTRAR_TIPO_SOLICITUD(?,@mensajeError)");
		      //Introduccion de parametros
          $stmt->bindParam(1, $nombre, PDO::PARAM_STR); 
         
       $stmt->execute();
       $output = $db->query("select @mensajeError")->fetch(PDO::FETCH_ASSOC);
      //var_dump($output);
       $mensaje = $output['@mensajeError'];
       $codMensaje = 1;
       
    

    }catch(PDOExecption $e){
      $mensaje = 'error al ingresar el registro o registro actualmente existente';
      $codMensaje = 0;
    }
    
    if($codMensaje == 1){
      echo '<div class="alert alert-success alert-succes">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Exito! </strong>'.$mensaje.'</div>';
    }else{
      echo '<div class="alert alert-danger alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Error! </strong>'.$mensaje.'</div>';
    }
 ?>