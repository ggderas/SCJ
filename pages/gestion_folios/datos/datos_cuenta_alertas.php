<?php

    // Obtiene la cuenta de las alertas del usuario al sistema.

	  $query = $db->prepare("select ifnull(count(alerta.NroFolioGenera),0) as total from alerta 
	  inner join folios on alerta.NroFolioGenera=folios.NroFolio AND alerta.Atendido =0
	  inner join prioridad on folios.Prioridad = prioridad.Id_Prioridad
	  inner join seguimiento on folios.NroFolio = seguimiento.NroFolio
	  inner join estado_seguimiento on seguimiento.EstadoSeguimiento = estado_seguimiento.Id_Estado_Seguimiento
	  inner join usuario_alertado on usuario_alertado.Id_Alerta=alerta.Id_Alerta
	  inner join usuario on usuario.id_Usuario=usuario_alertado.Id_Usuario  and usuario.id_Usuario='$userId' 
	  ORDER BY  folios.FechaEntrada");

    $query->execute();
    $query_cuenta = $query->fetch();
        if($query_cuenta){
            $cuenta_alertas = $query_cuenta['total'];
        }else{
            $cuenta_alertas = 0;
        }
    $query = null;

?>