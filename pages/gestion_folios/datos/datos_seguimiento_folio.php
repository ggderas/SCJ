<?php
    
	require($maindir."conexion/config.inc.php");

    $query = $db->prepare("SELECT usuario.Nombre ,seguimiento.*,persona.Primer_nombre,persona.Segundo_nombre,persona.Primer_apellido,persona.Segundo_apellido 
	                       FROM seguimiento LEFT JOIN usuario ON seguimiento.UsuarioAsignado = usuario.id_usuario 
						   LEFT JOIN empleado ON usuario.No_Empleado = empleado.No_Empleado LEFT JOIN persona ON empleado.N_identidad = persona.N_identidad
                                  WHERE NroFolio = :NroFolio");
	$query ->bindParam(":NroFolio",$NroFolio);
    $query->execute();
    $result11 = $query->fetch();
        if($result11){
            $seguimiento = 1;
            if($result11['UsuarioAsignado']){
               $UsuarioAsignado = $result11['UsuarioAsignado'];
			   $userName = $result11['Nombre']; 
               $primerN = $result11['Primer_nombre'];
               $segundoN = $result11['Segundo_nombre'];
               $primerA = $result11['Primer_apellido'];
               $segundoA = $result11['Segundo_apellido'];
            }else{
               $UsuarioAsignado = 0;
            }
            $finSeguimiento = $result11['FechaFinal'];
        }else{
            $seguimiento = 0;
        }
	
	if($seguimiento == 1){
	$Id_Seguimiento = $result11['Id_Seguimiento'];
	$sql = "SELECT seguimiento_historico.Id_SeguimientoHistorico, seguimiento_historico.Id_Seguimiento, estado_seguimiento.DescripcionEstadoSeguimiento, 
	        seguimiento_historico.FechaCambio, seguimiento_historico.Notas, prioridad.DescripcionPrioridad FROM seguimiento_historico 
			INNER JOIN estado_seguimiento ON seguimiento_historico.Id_Estado_Seguimiento = estado_seguimiento.Id_Estado_Seguimiento 
			INNER JOIN prioridad ON seguimiento_historico.Prioridad = prioridad.Id_Prioridad WHERE Id_Seguimiento = :Id_Seguimiento 
			ORDER BY FechaCambio DESC";

    $query = $db->prepare($sql);
	$query ->bindParam(":Id_Seguimiento",$Id_Seguimiento);
    $query->execute();
    $rows = $query->fetchAll();
        if($rows){
            $seguimiento_historico = 1;
        }else{
            $seguimiento_historico = 0;
        }
	}
	
    $query = null;
    $db = null;
?>