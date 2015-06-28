<?php

        $num_folioAnt = $_POST["NroFolioAnt"];
        $addNroFolio = $_POST['NroFolio'];
        $addFechaCreacion = $_POST['FechaCreacion'];
        $addFechaEntrada = $_POST['FechaEntrada'];
		$addPersonaReferente = $_POST['PersonaReferente'];
		$addUnidadAcademica = $_POST['UnidadAcademica'];
		$addOrganizacion = $_POST['Organizacion'];
		$addCategoria = $_POST['Categoria'];
		$addDescripcionAsunto = $_POST['DescripcionAsunto'];
		$addTipoFolio = $_POST['TipoFolio'];
		$addUbicacionFisica = $_POST['UbicacionFisica'];
		$prioridadAnt = $_POST["prioridadAnt"];
		$addPrioridad = $_POST['Prioridad'];

        if($addFechaCreacion == "" or $addFechaCreacion == null){
        	$mensaje = "Debe de ingresar una fecha de creación para el folio";
            $codMensaje = 0;
        }elseif($addFechaEntrada == "" or $addFechaEntrada == null){
        	$mensaje = "Debe de ingresar una ubicación para la organización";
            $codMensaje = 0;
        }
		elseif($addPersonaReferente == "" or $addPersonaReferente == null){
        	$mensaje = "Debe de ingresar una persona referente para el folio";
            $codMensaje = 0;
        }
		elseif($addUnidadAcademica == "" or $addUnidadAcademica == null){
        	$mensaje = "Debe de ingresar una unidad académica para el folio";
            $codMensaje = 0;
        }
		elseif($addOrganizacion == "" or $addOrganizacion == null){
        	$mensaje = "Debe de ingresar una organización para el folio";
            $codMensaje = 0;
        }
		elseif($addCategoria == "" or $addCategoria == null){
        	$mensaje = "Debe de ingresar una categoría para el folio";
            $codMensaje = 0;
        }
		elseif($addDescripcionAsunto == "" or $addDescripcionAsunto == null){
        	$mensaje = "Debe de ingresar una descripción asunto para";
            $codMensaje = 0;
        }
		elseif($addTipoFolio == "" or $addTipoFolio == null){
        	$mensaje = "Debe de ingresar un tipo de folio";
            $codMensaje = 0;
        }
		elseif($addUbicacionFisica == "" or $addUbicacionFisica == null){
        	$mensaje = "Debe de ingresar una ubicación física del folio";
            $codMensaje = 0;
        }
		elseif($addPrioridad == "" or $addPrioridad == null){
        	$mensaje = "Debe de ingresar una prioridad para el folio";
            $codMensaje = 0;
        }
		else{
		
		if($addOrganizacion == -1){
		    $addOrganizacion = NULL;
		}elseif($addUnidadAcademica == -1){
		    $addUnidadAcademica = NULL;
		}

	try{
		$stmt = $db->prepare("CALL sp_actualizar_folio(?,?,?,?,?,?,?,?,?,?,?,?,?,@mensaje,@codMensaje)");
        $stmt->bindParam(1, $num_folioAnt, PDO::PARAM_STR);
		$stmt->bindParam(2, $addNroFolio, PDO::PARAM_STR);
		$stmt->bindParam(3, $addFechaCreacion, PDO::PARAM_STR); 
		$stmt->bindParam(4, $addFechaEntrada, PDO::PARAM_STR); 
		$stmt->bindParam(5, $addPersonaReferente, PDO::PARAM_STR); 
		$stmt->bindParam(6, $addUnidadAcademica, PDO::PARAM_STR); 
		$stmt->bindParam(7, $addOrganizacion, PDO::PARAM_STR); 
		$stmt->bindParam(8, $addDescripcionAsunto, PDO::PARAM_STR); 
		$stmt->bindParam(9, $addTipoFolio, PDO::PARAM_STR); 
		$stmt->bindParam(10, $addUbicacionFisica, PDO::PARAM_STR); 
		$stmt->bindParam(11, $prioridadAnt, PDO::PARAM_STR);
		$stmt->bindParam(12, $addPrioridad, PDO::PARAM_STR);
		$stmt->bindParam(13, $addCategoria, PDO::PARAM_STR);
		
        // call the stored procedure
        $stmt->execute();	
		
		$output = $db->query("select @mensaje, @codMensaje")->fetch(PDO::FETCH_ASSOC);
		//var_dump($output);
        $mensaje = $output['@mensaje'];
		$codMensaje = $output['@codMensaje'];
		
		}catch(PDOExecption $e){
			$mensaje="No se ha procesado su petición, comuníquese con el administrador del sistema";
		    $codMensaje =0;
		}
	
	}
    ?>