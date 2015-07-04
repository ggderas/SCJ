

<?php

    $maindir = "../../";

  if(isset($_GET['contenido']))
    {
      $contenido = $_GET['contenido'];
    }
  else
    {
      $contenido = 'carga_academica';
    }

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");

  require_once($maindir."pages/navbar.php");



if(!isset( $_SESSION['user_id'] ))
  {
    header('Location: '.$maindir.'login/logout.php?code=100');
    exit();
  }
  
?>
 
<html lang="es">
    <head>    
    <meta charset="utf-8">
    </head>
      <div class="container-fluid">
        <div class = "row">
          <div class = "col-sm-3" >
            <ul class="list-unstyled">
               <li  class="nav-header active"> <a id="CargaAcademica" href="#"><i class="glyphicon glyphicon-home"></i> Inicio Carga Academica</a></li>
               <hr>
               <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#userMenu">
                 <h5><i class="glyphicon glyphicon-book"></i> Gestión de Clases<i class="glyphicon glyphicon-chevron-down"></i></h5>
                    </a>
                    <ul class="list-unstyled collapse in" id="userMenu">
                      <li>
                        <a id="Asignaturas" href="#"><i class="glyphicon glyphicon-list"></i> Asignaturas</a>
                      </li>
                      <li>
                        <a id="Edificios"  href="#"><i class="glyphicon glyphicon-equalizer"></i> Edificios</a>
                      </li>
                      <li>
                        <a id="Aulas"  href="#"><i class="glyphicon glyphicon-book"></i> Aulas</a>
                      </li>
                      <li>
                        <a id="Clases"  href="#"><i class="glyphicon glyphicon-list"></i> Clases</a>
                      </li>
                      <li>
                        <a id="AsignacionClases"  href="#"><i class="glyphicon glyphicon-calendar"></i> Asiganacion de clases</a>
                      </li>
                    </ul>
                </li>
                <li id = "RegistroDocentes" class="nav-header"> <a href="#" data-target="#userMenu2">
                  <h5><i class="glyphicon glyphicon-edit"></i> Registro de docentes</h5>
                  </a>
                </li>
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#userMenu2">
                  <h5><i class="glyphicon glyphicon-folder-open"></i> Gestión de Proyecto<i class="glyphicon glyphicon-chevron-down"></i></h5>
                  </a>
                    <ul class="list-unstyled collapse in" id="userMenu2">     
                        <li><a id="Facultad" href="#"><i class="glyphicon glyphicon-ok"></i> Facultad</a></li>
                        <li><a id="AreasProyecto" href="#"><i class="glyphicon glyphicon-ok"></i> Areas de proyecto</a></li> 
                        <li><a id="AreasVinculacion" href="#"><i class="glyphicon glyphicon-ok"></i> Areas de vinculacion</a></li> 
                        <li><a id="Proyectos" href="#"><i class="glyphicon glyphicon-ok"></i> Proyecto</a></li> 
                        <li><a id="AsigancionProyecto" href="#"><i class="glyphicon glyphicon-ok"></i> Asignacion de proyecto</a></li> 
                    </ul>
                </li>
                <li id = "BusquedaAvanzada" class="nav-header"> <a href="#" data-toggle="collapse" data-target="#userMenu2">
                  <h5><i class="glyphicon glyphicon-search"></i> Busqueda vanzada</h5>
                  </a>
                </li>
            </ul>
          </div>
            <div class="col-sm-9">
                <div id="contenedor" class="content-panel">
                </div>
            </div>
      </div> 
    </div>
<script type="text/javascript" src = "pages/CargaAcademica/menu.js" />
