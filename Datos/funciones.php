<?php
	function encrypt($string, $key) {
		$result = ''; $key=$key.'2013';
	   	for($i=0; $i<strlen($string); $i++) {
			  $char = substr($string, $i, 1);
			  $keychar = substr($key, ($i % strlen($key))-1, 1);
			  $char = chr(ord($char)+ord($keychar));
			  $result.=$char;
	   	}
	   	return base64_encode($result);
	}
	#####CONTRASEÑA DE-ENCRIPTAR
	function decrypt($string, $key) {
	   	$result = ''; $key=$key.'2013';
	   	$string = base64_decode($string);
	   	for($i=0; $i<strlen($string); $i++) {
			  $char = substr($string, $i, 1);
			  $keychar = substr($key, ($i % strlen($key))-1, 1);
			  $char = chr(ord($char)-ord($keychar));
			  $result.=$char;
	   	}
	   	return $result;
	}
	
	function fecha($fecha){
		$meses = array("ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
		$a=substr($fecha, 0, 4); 	
		$m=substr($fecha, 5, 2); 
		$d=substr($fecha, 8);
		return $d." / ".$meses[$m-1]." / ".$a;
	}
	
	function estado($estado){
		if($estado=='s'){
			return '<span class="label label-success">Activo</span>';
		}else{
			return '<span class="label label-important">No Activo</span>';
		}
	}
	
	function mensajes($mensaje,$tipo){
		if($tipo=='verde'){
			$tipo='alert alert-success';
		}elseif($tipo=='rojo'){
			$tipo='alert alert-danger';
		}elseif($tipo=='azul'){
			$tipo='alert alert-info';
		}
		return '<div class="'.$tipo.'" align="center">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>'.$mensaje.'</strong>
            </div>';
	}
	
	function formato($valor){
		return number_format($valor,2,",",".");
	}
?>