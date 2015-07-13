<?php

  $maindir = "../../";

  if(isset($_GET['contenido']))
  {
    $contenido = $_GET['contenido'];
	$navbar_loc = 'contenido';
  }
  else
  {
    $contenido = 'gestion_de_folios';
	$navbar_loc = 'contenido';
  }

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");
  
  require_once($maindir.'pages/navbar.php');
  
  $userId = $_SESSION['user_id'];
  $user = $_SESSION['nombreUsuario'];

  require_once("datos/datos_ultimos_cinco_folios.php");
	
  require_once("datos/datos_ultimas_alertas.php");
  
  require_once("datos/datos_notificaciones.php");
  
  $db = null;

?>

<!-- Main -->
<div class="container-fluid">
<div class="row">
    <?php 
        require_once("navbar.php");
    ?>
    <div class="col-sm-10">
      <section class="content">
        <h2>Gestión de folios</h2>
        <div class="row">
          <div class="col-md-6">
            <div class="box box-warning">
                                <div class="box-header">
                                    <h3 class="box-title">Alertas</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-hover">
									<?php
                                        if($alertas == 1){
                                        echo '<tr>';
                                        echo '<th style="width: 30px">Folio</th>';
                                        echo '<th>Prioridad</th>';
                                        echo '<th>Fecha entrada folio</th>';
                                        echo '<th>Seguimiento</th>';
                                        echo '</tr>';
								    
                                            foreach ($rows_alertas as $row) {

                                                $NroFolio = $row['NroFolioGenera'];
												$Prioridad = $row['Prioridad'];
                                                $DescripcionPrioridad = $row['DescripcionPrioridad'];
                                                $DescripcionEstadoSeguimiento = $row['DescripcionEstadoSeguimiento'];
                                                $FechaEntrada = $row['FechaEntrada'];
												
                                                if( $Prioridad == 1){
												    echo "<tr class='info' data-id='".$NroFolio."'>";
                                                }elseif( $Prioridad == 2 ){
												    echo "<tr class='warning' data-id='".$NroFolio."'>";
                                                }elseif( $Prioridad == 3 ){
												    echo "<tr class='danger' data-id='".$NroFolio."'>";
                                                }else{
												    echo "<tr class='default' data-id='".$NroFolio."'>";
												}
												echo "<td>".$NroFolio."</td>";
												echo "<td>".$DescripcionPrioridad."</td>";
												echo "<td>".$FechaEntrada."</td>";
                                                echo "<td>".$DescripcionEstadoSeguimiento."</td>";
                                                echo "</tr>";
                                            }                                        
                                        }elseif($alertas == 0){
                                            echo "<tr>";
                                            echo "<td>No hay ninguna alerta por el momento</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->           
          </div>
          <div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Notificaciones</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-hover">
                                        <?php
                                        if($notificacion == 1){
                                        echo '<tr>';
                                        echo '<th style="width: 30px">Folio</th>';
                                        echo '<th>Enviado por</th>';
                                        echo '<th>Titulo</th>';
                                        echo '<th>Fecha Not.</th>';
                                        echo '</tr>';
								    
                                            foreach ($rows as $row) {

                                                $NroFolio = $row['NroFolio'];
												$titulo = $row['Titulo'];
                                                $enviadoPor = $row['nombre'];
                                                $fechaCreacion = $row['FechaCreacion'];
												
												echo "<td>".$NroFolio."</td>";
												echo "<td>".$enviadoPor."</td>";
												echo "<td>".$titulo."</td>";
                                                echo "<td>".$fechaCreacion."</td>";
                                                echo "</tr>";
                                            }                                        
                                        }elseif($alertas == 0){
                                            echo "<tr>";
                                            echo "<td>No hay ninguna notificacion</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
        </div>
        <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Folios</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <?php
                                        if($folios == 1){
										
										echo "<tr>";
                                        echo "<th>Folio</th>";
                                        echo "<th>Tipo de folio</th>";
                                        echo "<th>Fecha</th>";
                                        echo "<th>Prioridad</th>";
                                        echo "<th>Seguimiento</th>";
                                        echo "</tr>";
										
                                            foreach ($rows_folios as $row) {

                                                $NroFolio = $row['NroFolio'];
                                                $Prioridad = $row['Prioridad'];
                                                $DescripcionPrioridad = $row['DescripcionPrioridad'];
                                                $EstadoSeguimiento = $row['EstadoSeguimiento'];
                                                $DescripcionEstadoSeguimiento = $row['DescripcionEstadoSeguimiento'];
                                                $FechaEntrada = $row['FechaEntrada'];
                                                $TipoFolio = $row['TipoFolio'];

                                                echo "<tr data-id='".$NroFolio."'>";
                                                echo "<td>".$NroFolio."</td>";
                                                if($TipoFolio == 1){
                                                    echo "<td> Entrada </td>";
                                                }else{
                                                    echo "<td> Salida </td>";
                                                }
                                                echo "<td>".$FechaEntrada."</td>";
                                                if( $Prioridad == 1){
                                                    echo "<td><span class='label label-primary'>".$DescripcionPrioridad."</span></td>";
                                                }elseif( $Prioridad == 2 ){
                                                    echo "<td><span class='label label-warning'>".$DescripcionPrioridad."</span></td>";
                                                }elseif( $Prioridad == 3 ){
                                                    echo "<td><span class='label label-danger'>".$DescripcionPrioridad."</span></td>";
                                                }else{
												    echo "<td><span class='label label-default'>".$DescripcionPrioridad."</span></td>";
												}
                                                echo "<td>".$DescripcionEstadoSeguimiento."</td>";
                                                echo "</tr>";
                                            }                                        
                                        }elseif($folios == 0){
                                            echo "<tr>";
                                            echo "<td>No hay ningun folio actualmente en el sistema</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
      </section><!-- /.content -->
    </div>
    </div><!--/col-span-10-->

</div><!-- /Main -->

<script>
$(document).ready(function() {
  $('#tabla_folios').dataTable({
    
  });
}); 
</script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>
