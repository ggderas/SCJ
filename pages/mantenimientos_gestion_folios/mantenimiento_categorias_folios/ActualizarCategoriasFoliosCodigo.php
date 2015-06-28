<?php

    try{
        $addId_categoria = $_POST['Id_categoria'];
        $addNombreCategoria = $_POST['NombreCategoria'];
        $addDescripcionCategoria = $_POST['DescripcionCategoria'];

        if($addNombreCategoria == "" or $addNombreCategoria == null){
        	$mensaje = "Debe de ingresar un nombre para la categoria";
            $codMensaje = 0;
        }elseif($addDescripcionCategoria == "" or $addDescripcionCategoria == null){
        	$mensaje = "Debe de ingresar una descripcion para la categoria";
            $codMensaje = 0;
        }else{

            require_once("../../conexion/config.inc.php");
    
            $sql = "CALL sp_actualizar_categorias_folios(?,?,?,@mensaje,@codMensaje)";
            $query1 = $db->prepare($sql);
            $query1->bindParam(1,$addId_categoria,PDO::PARAM_STR);
            $query1->bindParam(2,$addNombreCategoria,PDO::PARAM_STR);
            $query1->bindParam(3,$addDescripcionCategoria,PDO::PARAM_STR);
       
            $query1->execute();

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
