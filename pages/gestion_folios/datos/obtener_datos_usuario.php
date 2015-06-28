
<?php
//Consulta para cargar los usuarios al combobox
$query3 = $db->prepare("SELECT * FROM usuario");
$query3->execute();
$filas2 = $query3->fetchAll();
        if($filas2){
            //$number_of_rows = $rows->rowCount();
            $usuario= 1;
        }else{
           
            $usuario = 0;
        }
    $query3 = null;


?>