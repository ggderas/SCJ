<?php
    $query = $db->prepare("SELECT * FROM ( SELECT folios.NroFolio, folios.PersonaReferente, unidad_academica.NombreUnidadAcademica AS ENTIDAD, 
	                       categorias_folios.NombreCategoria, DATE(folios.FechaEntrada) as FechaEntrada, folios.FechaEntrada as Fecha, 
						   folios.TipoFolio FROM folios INNER JOIN unidad_academica ON 
						   folios.UnidadAcademica = unidad_academica.Id_UnidadAcademica INNER JOIN categorias_folios ON 
						   folios.categoria = categorias_folios.Id_Categoria UNION SELECT folios.NroFolio, folios.PersonaReferente, 
						   organizacion.NombreOrganizacion AS ENTIDAD, categorias_folios.NombreCategoria, DATE(folios.FechaEntrada) as FechaEntrada,  folios.FechaEntrada as Fecha,
						   folios.TipoFolio FROM folios INNER JOIN organizacion ON folios.Organizacion = organizacion.Id_Organizacion INNER JOIN categorias_folios ON 
						   folios.categoria = categorias_folios.Id_Categoria)T1 ORDER BY `T1`.`Fecha` DESC");
    $query->execute();
    $rows = $query->fetchAll();
        if($rows){
            //$number_of_rows = $rows->rowCount();
            $folios = 1;
        }else{
            $number_of_rows = 0;
            $folios = 0;
        }
    $query = null;
    $db = null;
?>