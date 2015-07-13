<?php
$query = $db->prepare("SELECT count(*) AS total FROM (SELECT notificaciones_folios.Id_Notificacion, notificaciones_folios.NroFolio,notificaciones_folios.Titulo,notificaciones_folios.FechaCreacion,
    nueva.id_Usuario idUsuario,nueva.nombre AS nombre
    FROM notificaciones_folios INNER JOIN 
    (SELECT usuario_notificado.Id_Notificacion,usuario.nombre, usuario.id_Usuario from usuario_notificado INNER JOIN
     usuario ON usuario_notificado.Id_Usuario=usuario.id_Usuario) AS nueva ON notificaciones_folios.Id_Notificacion=nueva.Id_Notificacion 
        WHERE IdEmisor IN (SELECT id_Usuario FROM usuario WHERE nombre=:usuario) AND IdUbicacionNotificacion='2' AND Estado='1')T1 ORDER BY T1.FechaCreacion DESC ");
        $query ->bindParam(":usuario",$user);
    $query->execute();
    $query->execute();
    $result_ = $query->fetch();
        if($result_){
            $cuenta_notificaciones_enviadas = $result_["total"];
        }else{
            $cuenta_notificaciones_enviadas = 0;
        }
    $query = null;

//Consulta para ver las notificaciones Recibidas
 $query = $db->prepare(" SELECT count(*) AS total FROM (SELECT notificaciones_folios.Id_Notificacion, notificaciones_folios.NroFolio,notificaciones_folios.Titulo,notificaciones_folios.FechaCreacion,usuario.id_Usuario as idUsuario,usuario.nombre AS nombre 
    FROM notificaciones_folios INNER JOIN usuario ON notificaciones_folios.IdEmisor=usuario.id_Usuario 
    WHERE Id_Notificacion in 
    (SELECT Id_Notificacion from usuario_notificado WHERE  IdUbicacionNotificacion='3' AND Estado='1' AND Id_Usuario IN 
        (SELECT id_Usuario from usuario where nombre =:usuario) )) P1
                        ORDER BY P1.FechaCreacion DESC");
     
    $query ->bindParam(":usuario",$user);
    $query->execute();
    $result_ = $query->fetch();
        if($result_){
            $cuenta_notificaciones_recibidas = $result_["total"];
        }else{
            $cuenta_notificaciones_recibidas = 0;
        }
    $query = null;
	
//Basurero Enviadas

$query = $db->prepare(" SELECT count(*) AS total FROM (SELECT notificaciones_folios.Id_Notificacion,notificaciones_folios.NroFolio,notificaciones_folios.Titulo,notificaciones_folios.FechaCreacion,nueva.id_Usuario as idUsuario,nueva.nombre AS nombre 
    FROM notificaciones_folios INNER JOIN 
    (SELECT usuario_notificado.Id_Notificacion,usuario.nombre, usuario.id_Usuario 
        from usuario_notificado INNER JOIN usuario ON usuario_notificado.Id_Usuario=usuario.id_Usuario) 
AS nueva ON notificaciones_folios.Id_Notificacion=nueva.Id_Notificacion WHERE IdUbicacionNotificacion='1'  AND  Estado='1' AND IdEmisor IN (SELECT id_Usuario FROM usuario WHERE nombre=:usuario)  ) T2
                     ORDER BY `T2`.`FechaCreacion` DESC   ");
    $query ->bindParam(":usuario",$user);
    $query->execute();
    $result_ = $query->fetch();
        if($result_){
            $cuenta_basurero_enviadas = $result_["total"];
        }else{
            $cuenta_basurero_enviadas = 0;
        }
    $query = null;
	
//Basurero Recibidas
$query = $db->prepare(" SELECT count(*) AS total FROM (
                        SELECT  notificaciones_folios.Id_Notificacion,notificaciones_folios.NroFolio,notificaciones_folios.Titulo,notificaciones_folios.FechaCreacion,usuario.id_Usuario as idUsuario,usuario.nombre AS nombre 
    FROM notificaciones_folios INNER JOIN usuario ON notificaciones_folios.IdEmisor=usuario.id_Usuario 
    WHERE   Id_Notificacion in 
    (SELECT Id_Notificacion from usuario_notificado WHERE Estado='1' AND IdUbicacionNotificacion='1' AND Id_Usuario IN 
        (SELECT id_Usuario from usuario where nombre =:usuario) )) T2
                     ORDER BY `T2`.`FechaCreacion` DESC   ");
    $query ->bindParam(":usuario",$user);
    $query->execute();
    $result_ = $query->fetch();
        if($result_){
            $cuenta_basurero_recibidas = $result_["total"];
        }else{
            $cuenta_basurero_recibidas = 0;
        }
    $query = null;

?>