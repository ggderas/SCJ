<?php 

  if(!isset( $_SESSION['user_id'] ))
  {
    header('Location: '.$maindir.'login/logout.php?code=100');
    exit();
  }
  else
  {
	$user = $_SESSION['nombreUsuario'];
	$rol = $_SESSION['user_rol']; 
  }

?>

<div class="navbar navbar-default" id="subnav">
    <div class="col-md-12">

        <div class="collapse navbar-collapse" id="navbar-collapse2">
          <ul class="nav navbar-nav navbar-left">
            <!--
            <li class="active"><a href="javascript:ajax_('home.php');">Inicio</a></li>
            <li><a role="button" href="javascript:void(0)" >Modulo 1</a></li>
            <li><a role="button" href="javascript:void(0)" >Gestión de proyectos</a></li>
            <li><a role="button" href="javascript:void(0)" >Recursos humanos</a></li>
            <li><a role="button" href="javascript:ajax_('gestion_folios/gestion_de_folios.php?contenido=gestion_de_folios');">Gestión de folios</a></li>
            -->
<?php

             // Revisa si es la pagina de inicio o cualquier otra pagina
             // pagina de inicio
            if($contenido == 'home') 
              {
                  $url = 'home.php';
                  echo <<<HTML
                <li class="active"><a role='button' id="home" href="javascript:ajax_('$url')" >Inicio</a></li>
HTML;
              }
            else
              {
                $url = 'home.php';
                echo <<<HTML
                <li><a role='button' id="home" href="javascript:ajax_('$url')" >Inicio</a></li>
HTML;
              }

             // pagina del POA
	    if($rol == 100 || $rol == 50 || $rol == 30 || $rol == 20)
		{
//            if($contenido == 'poa') 
//              {
			  
			switch($rol)
			{   
			    case 100: 
				    $url = 'pages/principal.php?contenido=poa';// 100    
				    break;
				case 50:
				    $url = 'pages/principalDecana.php?contenido=poa'; // 50
				    break;
				case 30:
				    $url = 'pages/principalJefe.php?contenido=poa'; // 30
					break;
				case 20:
				    $url = 'pages/principalDocente.php?contenido=poa'; // 20
			     	break;
			}
				
                echo <<<HTML
                <li class="active"><a href="javascript:ajax_('$url');">POA</a></li>

HTML;
//              }
//            else
//              {
//                $url = 'pages/principal.php?contenido=poa';
//                echo <<<HTML
//                <li><a role="button" href="javascript:ajax_('$url');">POA</a></li>
//
//HTML;
//              }
		}
             
             // pagina de permisos
            if($contenido == 'permisos') 
              {
                $url = 'pages/permisos/permisos_principal.php?contenido=permisos';
                echo <<<HTML
                <li class="active"><a role="button" href="javascript:ajax_('$url');">Permisos</a></li>

HTML;
              }
            else
              {
                $url = 'pages/permisos/permisos_principal.php?contenido=permisos';
                echo <<<HTML
                <li><a role="button" href="javascript:ajax_('$url');">Permisos</a></li>

HTML;
                
              }
              if($rol >= 40){
             // pagina del recursos humanos
            if($contenido == 'recursos_humanos') 
              {
			    $url = 'pages/recursos_humanos/recursos_humanos.php?contenido=recursos_humanos';
			    echo <<<HTML
                <li class="active"><a role="button" href="javascript:ajax_('$url');">Recursos humanos</a></li>

HTML;
              }
            else
              {
			    $url = 'pages/recursos_humanos/recursos_humanos.php?contenido=recursos_humanos';
			    echo <<<HTML
                <li><a role="button" href="javascript:ajax_('$url');">Recursos humanos</a></li>

HTML;
              }
              }	  
        if($rol >= 0){
             // pagina del modulo de gestion de folios
            if($contenido == 'gestion_de_folios') 
              {

                $url = 'pages/gestion_folios/gestion_de_folios.php?contenido=gestion_de_folios';
                echo <<<HTML
                <li class="active"><a role="button" id="gestion_de_folios" href="javascript:ajax_('$url')" >Gestion de folios</a></li>
HTML;

              }
            else
              {

                $url = 'pages/gestion_folios/gestion_de_folios.php?contenido=gestion_de_folios';
                echo <<<HTML
                <li><a role='button' id="gestion_de_folios" href="javascript:ajax_('$url')" >Gestion de folios</a></li>
HTML;
              }
        }     
?>

           </ul>
        </div>  
     </div> 
</div>
