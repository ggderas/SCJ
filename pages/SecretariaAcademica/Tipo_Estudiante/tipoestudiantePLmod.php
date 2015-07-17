<?php

  /*Conexion a la base de datos*/
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
    /*Se recuperan valores enviados*/
		$Nidentidad = $_POST['Identidad'];
    $NuevoTipo = $_POST['cmbxNuevoTipoE'];
    /*Se llama al procedimiento realizar cambio*/
		$stmt = $db->prepare("CALL SP_REALIZAR_CAMBIO_TIPO_ESTUDIANTE(?,?,@mensajeError)");
		/*Introduccion de parametros*/
		$stmt->bindParam(1, $Nidentidad, PDO::PARAM_STR); 
		$stmt->bindParam(2, $NuevoTipo, PDO::PARAM_STR);
    /*Ejeucion de procedimiento*/ 
		$stmt->execute();
    /*Se obtiene mensaje que se generó*/ 
		$output = $db->query("select @mensajeError")->fetch(PDO::FETCH_ASSOC);
		$mensaje = $output['@mensajeError'];
		$codMensaje = 0;

    }catch(PDOExecption $e){
      $mensaje = 'error al ingresar el registro o registro actualmente existente';
      $codMensaje = 0;
    }
    
    /*Resultado enviado*/ 
    if(is_null($mensaje)){
      echo '<div class="alert alert-success alert-succes">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Tipo de estudiante se ha modificado correctamente. </strong>'.$mensaje.'</div>';
    }else{
      echo '<div class="alert alert-danger alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Error! </strong>'.$mensaje.'</div>';
    }
 ?>