<?php
   $root = \realpath($_SERVER["DOCUMENT_ROOT"]);

   include "$root\curriculo\Datos\conexion.php";

    if (isset($_GET['idioma']) and empty($_POST['Id_Idioma'])) 
    {
        $idioma = $_GET['idioma']; 
        
        $query = "INSERT INTO idioma(Idioma) VALUES('$idioma')";
        
        mysql_query($query); 

    }   
?>