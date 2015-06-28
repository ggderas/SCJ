<?php

require_once('funciones.php');

if (isset($_POST['nombreIdioma'])) {
    $Language = $_POST['nombreIdioma'];

    $query = "INSERT INTO idioma(Idioma) VALUES('$Language')";

    mysql_query($query);
}


?>