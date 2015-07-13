<?php

$query = $db->prepare(" SELECT * FROM (SELECT notificaciones_folios.Id_Notificacion,notificaciones_folios.NroFolio,notificaciones_folios.Titulo,notificaciones_folios.FechaCreacion,nueva.id_Usuario as idUsuario,nueva.nombre AS nombre 
    FROM notificaciones_folios INNER JOIN 
    (SELECT usuario_notificado.Id_Notificacion,usuario.nombre, usuario.id_Usuario 
        from usuario_notificado INNER JOIN usuario ON usuario_notificado.Id_Usuario=usuario.id_Usuario) 
AS nueva ON notificaciones_folios.Id_Notificacion=nueva.Id_Notificacion WHERE IdUbicacionNotificacion='1' AND IdEmisor IN (SELECT id_Usuario FROM usuario WHERE nombre=:usuario)  
                       
                        UNION ALL
                        
   SELECT  notificaciones_folios.Id_Notificacion,notificaciones_folios.NroFolio,notificaciones_folios.Titulo,notificaciones_folios.FechaCreacion,usuario.id_Usuario as idUsuario,usuario.nombre AS nombre 
    FROM notificaciones_folios INNER JOIN usuario ON notificaciones_folios.IdEmisor=usuario.id_Usuario 
    WHERE   Id_Notificacion in 
    (SELECT Id_Notificacion from usuario_notificado WHERE  IdUbicacionNotificacion='1' AND Id_Usuario IN 
        (SELECT id_Usuario from usuario where nombre =:usuario) )) T2
                     ORDER BY `T2`.`FechaCreacion` DESC   ");
    $query ->bindParam(":usuario",$user);
    $query->execute();
    $rows = $query->fetchAll();
        if($rows){
            //$number_of_rows = $rows->rowCount();
            $notificacion = 1;
        }else{
            $number_of_rows = 0;
            $notificacion = 0;
        }
    $query = null;



?>