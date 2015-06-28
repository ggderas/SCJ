<?php

$query2 = $db->prepare( "SELECT NroFolio  FROM folios");
$query2->execute();
$filas = $query2->fetchAll();
        if($filas){
            //$number_of_rows = $rows->rowCount();
            $folio = 1;
        }else{
            $numero_filas = 0;
            $notificacion = 0;
        }
    $query2 = null;
    

?>