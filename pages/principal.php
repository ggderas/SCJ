<?php

  $maindir = "../";

  if(isset($_GET['contenido']))
    {
      $contenido = $_GET['contenido'];
    }
  else
    {
      $contenido = 'poa';
    }

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");

  require_once($maindir."pages/navbar.php");

?>

<?php
    include '../Datos/conexion.php';
    $consultaAR = "SELECT * FROM `actividades` WHERE `fecha_fin` <= now()";
    $query1 = mysql_query($consultaAR,$enlace);
    $consultaAA = "SELECT * FROM `actividades` WHERE `fecha_fin` >= now() AND `fecha_fin` <= ADDDATE(NOW(), INTERVAL 7 DAY )";
    $query2 = mysql_query($consultaAA,$enlace);
    $consultaAV = "SELECT * FROM `actividades` WHERE `fecha_fin` >= ADDDATE(NOW(), INTERVAL 5 DAY )";
    $query3 = mysql_query($consultaAV,$enlace);
?>

<div id="wrapper">

        
        
         
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a id="crear" href="#"><i class="fa fa-table fa-fw"></i>POAs</a>
                        </li>
                        <li>
                            <a id="actividades" href="#"><i class="fa fa-dashboard fa-fw"></i>Mis Actividades</a>
                        </li>
                        <li>
                            <a  id="reportes" href="#"><i class="fa fa-file-pdf-o fa-fw"></i> Reportes</a>
                            
                        </li>
                        <li>
                            <a  id="estadisticas" href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Estadisticas</a>
                            
                        </li>
                                               <li data-popover="true" rel="popover" data-placement="right"><a href="#" data-target=".premium-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-gears fa-fw"></i>Mantenimiento<i class="fa fa-collapse"></i></a></li>
                    <li><ul class="premium-menu nav nav-list collapse">
                            <li ><a id="areas" href="premium-profile.html"><span class="fa fa-caret-right"></span> Areas</a></li>
                            <li ><a id="tipoDeAreas" href="premium-blog.html"><span class="fa fa-caret-right"></span> Tipos De Areas</a></li>
                        </ul>
                    </li>
                                         
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
         
    </div>
    <div id="page-wrapper">
 
                
                <div id="contenedor">
                    <?php
                    
                        //include 'pages/crearPOA.php';
                    
                    ?>
                    <h2>Administración de POA</h2>
                    
                    <div class="col-lg-4">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            Actividades urgentes
                        </div>
                        <div class="panel-body">
                            <?php
                            //$i=0;
                                while($filaAU = mysql_fetch_array($query1))
                                {
                                    //$i++;
                                    //id="<?php echo 'id_$i'";
                               ?>
                            <div class="alert alert-danger alert-dismissable" >
                                
                                <?php
                                    echo $filaAU['descripcion']." - ".$filaAU["fecha_fin"];
                                ?>
                            </div>    
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                    <div class="col-lg-4">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            Actividades de esta semana
                        </div>
                        <div class="panel-body">
                            <?php
                            //$i=0;
                                while($filaAU = mysql_fetch_array($query2))
                                {
                                    //$i++;
                                    //id="<?php echo "id_$i";
                            ?>
                            <div class="alert alert-warning alert-dismissable">
                                
                                <?php
                                    echo $filaAU['descripcion']." - ".$filaAU["fecha_fin"];
                                ?>
                            </div>    
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                    <div class="col-lg-4">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            Actividades 
                        </div>
                        <div class="panel-body">
                            <?php
                            //$i=0;
                                while($filaAU = mysql_fetch_array($query3))
                                {
                                    //$i++;
                                    //id="<?php echo "id_$i";
                            ?>
                            <div class="alert alert-success alert-dismissable">
                                
                                <?php
                                    echo $filaAU['descripcion']." - ".$filaAU["fecha_fin"];
                                ?>
                            </div>    
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                </div>
                
         
    </div>
    

    <script type="text/javascript" src="js/menu.js" ></script>
