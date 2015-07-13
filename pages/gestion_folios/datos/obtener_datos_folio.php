<?php

    require($maindir."conexion/config.inc.php");

    $query = $db->prepare("SELECT folios.NroFolio, folios.NroFolioRespuesta, folios.PersonaReferente, folios.UnidadAcademica, unidad_academica.NombreUnidadAcademica, 
	    folios.Organizacion, organizacion.NombreOrganizacion,folios.categoria,categorias_folios.NombreCategoria, folios.TipoFolio,DATE(folios.FechaEntrada) as FechaEntrada, 
		folios.FechaCreacion, folios.UbicacionFisica, ubicacion_archivofisico.DescripcionUbicacionFisica ,folios.Prioridad ,prioridad.DescripcionPrioridad, 
		folios.DescripcionAsunto FROM folios INNER JOIN ubicacion_archivofisico ON folios.UbicacionFisica = ubicacion_archivofisico.Id_UbicacionArchivoFisico 
		INNER JOIN prioridad ON folios.Prioridad = prioridad.Id_Prioridad INNER JOIN categorias_folios ON categorias_folios.Id_categoria = folios.categoria 
		LEFT JOIN unidad_academica ON folios.UnidadAcademica = unidad_academica.Id_UnidadAcademica 
		LEFT JOIN organizacion ON folios.Organizacion = organizacion.Id_Organizacion
    	WHERE NroFolio = :NroFolio");
    $query ->bindParam(":NroFolio",$NroFolio);
    $query->execute();
    $result = $query->fetch();
        if($result){
            $folio = 1;
        }else{
            $folio = 0;
        }
    $query = null;
    $db = null;

?>