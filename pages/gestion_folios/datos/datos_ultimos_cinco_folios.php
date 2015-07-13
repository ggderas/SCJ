<?php

    require("../../conexion/config.inc.php");

    // Obtiene los ultimos 5 folios ingresados al sistema.

    $query = $db->prepare("SELECT * FROM( SELECT folios.NroFolio, DATE(folios.FechaEntrada) as FechaEntrada, folios.TipoFolio, seguimiento.EstadoSeguimiento, 
	    folios.Prioridad ,prioridad.DescripcionPrioridad, estado_seguimiento.DescripcionEstadoSeguimiento FROM folios INNER JOIN prioridad ON 
		folios.Prioridad = prioridad.Id_Prioridad INNER JOIN seguimiento ON folios.NroFOlio = seguimiento.NroFolio INNER JOIN estado_seguimiento ON 
		seguimiento.EstadoSeguimiento = estado_seguimiento.Id_Estado_Seguimiento ORDER BY folios.fechaEntrada DESC LIMIT 5) T1 ");
    $query->execute();
    $rows_folios = $query->fetchAll();
        if($rows_folios){
            $folios = 1;
        }else{
            $folios = 0;
        }
    $query = null;
    $db = null;

?>