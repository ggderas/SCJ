<?php
    require_once($maindir."funciones/getRandomColor.php");
?>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

          <!-- row -->
          <div class="row">
            <div class="col-md-12">
              <!-- The time line -->
              <ul class="timeline">

                <!-- timeline item -->
				<?php 
				//date_format($antFecha, "g:ia \o\n l jS F Y")
				    foreach( $rows as $row ){ 
				
				        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
				
				        $date = date_create($row['FechaCambio']);
				
				        if(!isset($antFecha)){
							$antFecha = $date;
			                // timeline-label
                                echo '<li class="time-label">';
                                echo '<span class="bg-light-blue">'.$dias[date_format($antFecha,'w')]." ".date_format($antFecha,'d')." de ".$meses[date_format($antFecha,'n')-1]. " del ".date_format($antFecha,'Y').'</span>';
                                echo '</li>';
                            //timeline-label 
						}else{				
						    $interval = $date->diff($antFecha);
							$dif = $interval->format('%R%a');
							if($dif > 0){
								$antFecha = $date;
								// timeline-label
                                    echo '<li class="time-label">';
                                    echo '<span class="bg-light-blue">'.$dias[date_format($antFecha,'w')]." ".date_format($antFecha,'d')." de ".$meses[date_format($antFecha,'n')-1]. " del ".date_format($antFecha,'Y').'</span>';
                                    echo '</li>';
                                //timeline-label 
							}
						}
				
				        echo '<li>';
						$randNum = rand(2,4);
						$randColor = getColor($randNum);
					    echo '<i class="fa fa-user '.$randColor.'"></i>';
					    echo '<div class="timeline-item">';
					    echo '<span class="time"> '.date_format($date, "g:ia").' <i class="fa fa-clock-o"></i></span>';
					    echo '<h3 class="timeline-header no-border"><a href="#"> Estado del seguimiento: </a> '.$row["DescripcionEstadoSeguimiento"].' </h3>';
						echo '<div class="timeline-body">'.$row["Notas"].'</div>';
					    echo '<div class="timeline-footer">';
                        echo '<span class="label label-primary">'.$row["DescripcionPrioridad"].'</span>';
		                echo '</div>';
                        echo '</div>';
					    echo '</li>';
											
					}
				?>
                <!-- END timeline item -->
              </ul>
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->