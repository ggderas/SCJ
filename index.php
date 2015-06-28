<?php
  
$maindir = "";

  // crea el encabezado de la pagina
  require_once($maindir."pages/head.php");

?>

<!-- Div principal el cual contendra la generacion dinamica de la pag -->
<!-- div_contenido -->
<div id="div_contenido">

<?php
  
  if(!isset($_GET['contenido']))
  {
    require_once("home.php");
  }
  else
  {
  	$contenido = $_GET['contenido'];
  }

?>

</div>
<!-- /div_contenido -->

<?php

  // crea el pie de pagina
  require_once($maindir."pages/footer.php");

?>