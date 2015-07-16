
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
	    $direc = $_POST['direccion'];
	    $email = $_POST['email'];
	    $estCivil = $_POST['estCivil'];
	    $nacionalidad = $_POST['nacionalidad'];
      $nempleado = $_POST['nempleado'];
      
       $stmt = $db->prepare("CALL SP_REGISTRAR_DOCENTE(?,?,?,?,?,?,?,?,?,?,?,?,@mensajeError)");
		      //Introduccion de parametros
          $stmt->bindParam(1, $identi, PDO::PARAM_STR); 
          $stmt->bindParam(2, $pNombre, PDO::PARAM_STR);
          $stmt->bindParam(3, $sNombre, PDO::PARAM_STR); 
          $stmt->bindParam(4, $pApellido, PDO::PARAM_STR); 
          $stmt->bindParam(5, $sApellido, PDO::PARAM_STR); 
          $stmt->bindParam(6, $fNac, PDO::PARAM_STR); 
          $stmt->bindParam(7, $sexo, PDO::PARAM_STR); 
          $stmt->bindParam(8, $direc, PDO::PARAM_STR); 
          $stmt->bindParam(9, $estCivil, PDO::PARAM_STR); 
          $stmt->bindParam(10, $nacionalidad, PDO::PARAM_STR);
          $stmt->bindParam(11, $email, PDO::PARAM_STR);
          $stmt->bindParam(12, $nempleado, PDO::PARAM_STR);   
         
       $stmt->execute();
       $output = $db->query("select @mensajeError")->fetch(PDO::FETCH_ASSOC);
       $mensaje = $output['@mensajeError'];
       if(is_null($mensaje)){
      echo '<div class="alert alert-success alert-succes">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Exito! </strong>'.$mensaje.'</div>';
    }else{
      echo '<div class="alert alert-danger alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Error! </strong>'.$mensaje.'</div>';
    }
    

    }catch(PDOExecption $e){
      //$mensaje = 'error al ingresar el registro o registro actualmente existente';
      $codMensaje = 0;
    }
    
    
 ?>