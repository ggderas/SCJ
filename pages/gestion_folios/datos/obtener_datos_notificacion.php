<?php

    require($maindir."conexion/config.inc.php");

    $query = $db->prepare("SELECT NroFolio,Titulo,Cuerpo,FechaCreacion FROM notificaciones_folios
    	WHERE Id_Notificacion= :IdNotificacion");
    $query ->bindParam(":IdNotificacion",$VerNotificacion);
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