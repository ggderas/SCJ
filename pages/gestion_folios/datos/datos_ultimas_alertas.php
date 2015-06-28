<?php

    require("../../conexion/config.inc.php");

    // Obtiene las ultimas 4 alertas ingresados al sistema.

	  $query = $db->prepare("select alerta.NroFolioGenera, DATE(folios.FechaEntrada) as FechaEntrada, 
	  estado_seguimiento.DescripcionEstadoSeguimiento, folios.Prioridad, prioridad.DescripcionPrioridad from alerta 
	  inner join folios on alerta.NroFolioGenera=folios.NroFolio AND alerta.Atendido =0
	  inner join prioridad on folios.Prioridad = prioridad.Id_Prioridad
	  inner join seguimiento on folios.NroFolio = seguimiento.NroFolio
	  inner join estado_seguimiento on seguimiento.EstadoSeguimiento = estado_seguimiento.Id_Estado_Seguimiento
	  inner join usuario_alertado on usuario_alertado.Id_Alerta=alerta.Id_Alerta
	  inner join usuario on usuario.id_Usuario=usuario_alertado.Id_Usuario  and usuario.id_Usuario='$userId' 
	  ORDER BY  folios.FechaEntrada DESC LIMIT 5");

    $query->execute();
    $rows_alertas = $query->fetchAll();
        if($rows_alertas){
            $alertas = 1;
        }else{
            $alertas = 0;
        }
    $query = null;

?>