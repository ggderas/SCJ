
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

		  $identi = $_POST['identidad'];
    	$pNombre = $_POST['primerNombre'];
    	$sNombre = $_POST['segundoNombre'];
	    $pApellido = $_POST['primerApellido'];
	    $sApellido = $_POST['segundoApellido'];
	    $fNac = $_POST['fecha'];
	    $sexo = $_POST['sexo'];
	    $tel = $_POST['telefono'];
	    $direc = $_POST['ciudadNatal'];
	    $email = $_POST['email'];
	    $estCivil = $_POST['estCivil'];
	    $nacionalidad = $_POST['nacionalidad'];
      
       $stmt = $db->prepare("CALL SP_REGISTRAR_DOCENTE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,@mensaje,@codMensaje)");
		      //Introduccion de parametros
          $stmt->bindParam(1, $identi, PDO::PARAM_STR); 


          // 
       $stmt->execute();
       $output = $db->query("select @mensaje, @codMensaje")->fetch(PDO::FETCH_ASSOC);
      //var_dump($output);
       $mensaje = $output['@mensaje'];
       $codMensaje = $output['@codMensaje'];
          // realizamos la consulta
    

    }catch(PDOExecption $e){
      $mensaje = 'error al ingresar el registro o registro actualmente existente';
      $codMensaje = 0;
    }
    
  if(isset($codMensaje) and isset($mensaje)){
    if($codMensaje == 1){
      echo '<div class="alert alert-success alert-succes">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Exito! </strong>'.$mensaje.'</div>';
    }else{
      echo '<div class="alert alert-danger alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Error! </strong>'.$mensaje.'</div>';
    }
  }
 ?>