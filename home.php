<?php

  if(isset($_GET['contenido']))
    {
      $contenido = $_GET['contenido'];
    }
  else
    {
      $contenido = 'home';
    }

  require_once("funciones/check_session.php");

  require_once("funciones/timeout.php");

  require_once("pages/navbar.php");

?>

<!-- Main -->
<div class="container-fluid">
<div class="row">
    <div class="col-sm-12">
        
       <div class="row">
        <div class="col-md-12">
          <div class="featurette">
            <img class="featurette-image img-circle pull-left" src="assets/img/logo-cienciasjuridicas.png">
            <h2 class="featurette-heading">Facultad de Ciencias Jurídicas. <span class="text-muted"> Página principal </span></h2>
            <p class="lead">Somos la Facultad de Derecho que tiene como misión Organizar, Dirigir, Desarrollar y Vincular las Ciencias Jurídicas a través de actividades docentes y de investigación, orientadas a la ciencia del Derecho y su multidiciplinariedad con otras ciencias.</p>
          </div>
        </div>
      </div>
    </div><!--/col-span-9-->     
</div>
</div>
<!-- /Main -->