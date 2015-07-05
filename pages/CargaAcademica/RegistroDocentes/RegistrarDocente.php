
<?php  
function limpiar($tags)
{
    $tags = strip_tags($tags);
    return $tags;
    
    
}
	try{

		$identi = limpiar($_POST['identidad']);
    	$pNombre = limpiar($_POST['primerNombre']);
    	$sNombre = limpiar($_POST['segundoNombre']);
	    $pApellido = limpiar($_POST['primerApellido']);
	    $sApellido = limpiar($_POST['segundoApellido']);
	    $fNac = limpiar($_POST['fecha']);
	    $sexo = $_POST['sexo'];
	    $tel = limpiar($_POST['telefono']);
	    $direc = limpiar($_POST['ciudadNatal']);
	    $email = limpiar($_POST['correo']);
	    $estCivil = $_POST['estCivil'];
	    $nacionalidad = $_POST['nacionalidad'];

		      // realizamos la consulta
      $query = ""; // Lugar para el pl
      $result = mysql_query($query, $conexion) or die("error en la consulta"); // hacemos la consulta a la base de datos
      $mensaje = "El usuario se ha creado exitosamente...";
      $codMensaje = 1;
    
    }catch(PDOExecption $e){
      $mensaje="No se ha procesado su peticion, comuniquese con el administrador del sistema";
      $codMensaje =0;
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