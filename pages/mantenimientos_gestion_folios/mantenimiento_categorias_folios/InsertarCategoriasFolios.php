 <?php

    try{

        $addNombreCategoria = $_POST['NombreCategoria'];
        $addDescripcionCategoria = $_POST['DescripcionCategoria'];

        if($addNombreCategoria == "" or $addNombreCategoria == NULL){
            $mensaje = "Por favor introduzca un nombre para la categoría";
            $codMensaje = 0;
        }elseif($addDescripcionCategoria == "" or $addDescripcionCategoria == NULL){
            $mensaje = "Por favor introduzca una descripción para la categoría";
            $codMensaje = 0;
        }else{

        require_once("../../conexion/config.inc.php");
	
        $sql = "CALL sp_insertar_categorias_folios(?,?,@mensaje,@codMensaje)";

        $query = $db->prepare($sql);
        $query ->bindParam(1,$addNombreCategoria,PDO::PARAM_STR);
        $query ->bindParam(2,$addDescripcionCategoria,PDO::PARAM_STR);
        $query->execute();

        $output = $db->query("select @mensaje, @codMensaje")->fetch(PDO::FETCH_ASSOC);
		//var_dump($output);
        $mensaje = $output['@mensaje'];
	$codMensaje = $output['@codMensaje'];

        }

    }catch(PDOExecption $e){
        $mensaje = "Al tratar de insertar, por favor intente de nuevo";
        $codMensaje = 0;
    }

?>
