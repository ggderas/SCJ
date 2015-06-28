<?php
$query = $db->prepare("SELECT * FROM (SELECT notificaciones_folios.Id_Notificacion, notificaciones_folios.NroFolio,notificaciones_folios.Titulo,notificaciones_folios.FechaCreacion,
    nueva.id_Usuario idUsuario,nueva.nombre AS nombre
    FROM notificaciones_folios INNER JOIN 
    (SELECT usuario_notificado.Id_Notificacion,usuario.nombre, usuario.id_Usuario from usuario_notificado INNER JOIN
     usuario ON usuario_notificado.Id_Usuario=usuario.id_Usuario) AS nueva ON notificaciones_folios.Id_Notificacion=nueva.Id_Notificacion 
        WHERE IdEmisor IN (SELECT id_Usuario FROM usuario WHERE nombre=:usuario) AND IdUbicacionNotificacion='2' AND Estado='1')T1 ORDER BY T1.FechaCreacion DESC ");
        $query ->bindParam(":usuario",$user);
    $query->execute();
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