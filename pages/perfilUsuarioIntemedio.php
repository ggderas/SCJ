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
                            <a id="crear" href="#"><i class="fa fa-table fa-fw"></i>Mis Actividades</a>
                        </li>
                        <li>
                            <a id="actividades" href="#"><i class="fa fa-dashboard fa-fw"></i>Sub-Actividades</a>
                        </li>
                        <li>
                            <a  id="reportes" href="#"><i class="fa fa-file-pdf-o fa-fw"></i> Reportes</a>
                        </li>
                        <li>
                            <a  id="estadisticas" href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Estadisticas</a>
                        </li>
                    </ul>
                </div>
            </div>
         
    </div>
    <div id="page-wrapper">
                <div id="contenedor">
                    <?php
                        //include 'pages/crearPOA.php';
                    
                    ?>
                    <h2>Bienvenido al Sistema de Administracion de POA</h2>
                    
                    <div class="col-lg-4">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            Actividades Urgentes A Realizar
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
                        <div class="panel-footer">
                            Panel Footer
                        </div>
                    </div>
                </div>
                    <div class="col-lg-4">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            Actividades De esta Semana
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
                        <div class="panel-footer">
                            Panel Footer
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
                        <div class="panel-footer">
                            Panel Footer
                        </div>
                    </div>
                </div>
                </div>
                
         
    </div>
