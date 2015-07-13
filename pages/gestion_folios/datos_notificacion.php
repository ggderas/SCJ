<?php

  $maindir = "../../";

  if(isset($_GET['contenido']))
  {
    $contenido = $_GET['contenido'];
  }
  else
  {
    $contenido = 'gestion_de_folios';
	$navbar_loc = 'contenido';
  }
  
  require_once($maindir."funciones/check_session.php");
  
  require_once($maindir."funciones/timeout.php");
  
  require_once($maindir.'pages/navbar.php');

  require_once($maindir."conexion/config.inc.php");
  require_once('datos/obtener_datos_notificacionFolio.php');
  require_once('datos/obtener_datos_usuario.php');

  if(isset($_POST['idNotificacion']))
  {
    $VerNotificacion= $_POST['idNotificacion'];
  }
  if (isset($_POST['Usuario'])) 
  {
    $Usuario=$_POST['Usuario'];
  }

  if (isset($_POST['Foco'])) {
    $FocoNotificacion=$_POST['Foco'];
  }


  if(isset($_POST['tipoNotificacion']))
  {
    $tipoNotificacion = $_POST['tipoNotificacion'];
    if($tipoNotificacion == 'NotificacionRecibida')
	{
       require_once('datos/datos_notificacion_recibida.php');
    }
	elseif($tipoNotificacion == 'NotificacionEnviada')
	{
       require_once('datos/datos_notificacion_enviada.php');
    }
    elseif($tipoNotificacion == 'BasureroRecibida')
	{
       require_once('datos/datos_basurero_recibidas.php');
    }
    elseif($tipoNotificacion == 'BasureroEnviada')
	{
       require_once('datos/datos_basurero_enviadas.php');
    }
	
  }
  
  require_once('datos/obtener_datos_usuario_notificaciones_totales.php');
  
  require_once('datos/obtener_datos_notificacion.php');
  
  $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
 $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  
  $usuario=$_SESSION['nombreUsuario'];    
  $user=$_SESSION['user_id'];
  ?>

  <!-- Main -->
<div class="container-fluid">
<div class="row">
    <?php 
        require_once("../gestion_folios/navbar.php");
    ?>
    <div class="col-sm-10">
        <section class="content">

<?php
 
  if(isset($codMensaje) and isset($mensaje)){
    if($codMensaje == 1){
      echo '<div class="alert alert-success">';
      echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
      echo '<strong>Exito! </strong>';
      echo $mensaje;
      echo '</div>';
    }else{
      echo '<div class="alert alert-danger">';
      echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
      echo '<strong>Error! </strong>';
      echo $mensaje;
      echo '</div>';
    }
  } 

?>

                    <!-- MAILBOX BEGIN -->
                    <div class="mailbox row">
                        <div class="col-xs-12">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3">
                                            <!-- BOXES are complex enough to move the .box-header around.
                                                 This is an example of having the box header within the box body -->
                                            <div class="box-header">
                                                <i class="fa fa-envelope"></i>
                                                <h3 class="box-title"> Notificaciones </h3>
                                            </div>
                                            <!-- compose message btn -->
                                            <!-- <a class="btn btn-block btn-primary" id="nuevo_folio" href="javascript:ajax_('pages/gestion_folios/nuevo_folio.php');"><i class="fa fa-pencil"></i> Nuevo Folio</a> -->
                                            <!-- Navigation - folders-->
                                            <?php
                                            if ($rol>20) {
                                            echo '<a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i> Nueva Notificación</a>';
                                            }

                                            ?>
                                            <div style="margin-top: 15px;">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li class="header">Bandeja Notificaciones</li>
                                         
                                                  <?php


                            if(isset($_POST['tipoNotificacion'])){
                              $tipoNotificacion = $_POST['tipoNotificacion'];

              // notificaciones recibidas
                
                              if($tipoNotificacion == 'NotificacionRecibida'){
                                echo '<li class="active"><a id="recibidas" href="#"><i class="fa fa-envelope"></i><span>Recibidas ';
                            }else{
                                echo '<li><a id="recibidas" href="#"><i class="fa fa-envelope"></i><span>Recibidas ';
                            }
              if($cuenta_notificaciones_recibidas > 0){
                  if($cuenta_notificaciones_recibidas < 100){
                    echo '<span class="label label-success pull-right">'.$cuenta_notificaciones_recibidas.'</span></a></li>';
                }else{
                    echo '<span class="label label-success pull-right">+99</span></a></li>';
                }       
              }else{
                  echo '</a></li>';
              }
              
              // notificaciones enviadas
              
                              if($tipoNotificacion == 'NotificacionEnviada' and $rol>20){
                                echo '<li class="active"><a id="enviadas" href="#"><i class="fa fa-paper-plane"></i><span>Enviadas</span>';    
                            }else if($rol>20){
                                echo '<li><a id="enviadas" href="#"><i class="fa fa-paper-plane"></i><span>Enviadas</span>';
                            }
              if($cuenta_notificaciones_enviadas > 0 and $rol>20){
                  if($cuenta_notificaciones_enviadas < 100){
                    echo '<span class="label label-success pull-right">'.$cuenta_notificaciones_enviadas.'</span></a></li>';
                }else{
                    echo '<span class="label label-success pull-right">+99</span></a></li>';
                }       
              }else{
                  echo '</a></li>';
              }
                        
                // basurero recibidas
                            
                            if($tipoNotificacion == 'BasureroRecibida'){
                                echo '<li class="active"><a id="basurero_recibida" href="#"><i class="fa fa-trash"></i><span>Basurero Recibidas</span>';
                            }else{
                                echo '<li><a id="basurero_recibida" href="#"><i class="fa fa-trash"></i><span>Basurero Recibidas</span>';
                            }
              if($cuenta_basurero_recibidas > 0){
                  if($cuenta_basurero_recibidas < 100){
                    echo '<span class="label label-success pull-right">'.$cuenta_basurero_recibidas.'</span></a></li>';
                }else{
                    echo '<span class="label label-success pull-right">+99</span></a></li>';
                }       
              }else{
                  echo '</a></li>';
              }
              
              // basurero enviadas
              
                            if($tipoNotificacion == 'BasureroEnviada' and $rol>20){
                                echo '<li class="active"><a id="basurero_enviada" href="#"><i class="fa fa-trash"></i><span>Basurero Enviadas</span>';
                            }else if($rol>20){
                                echo '<li><a id="basurero_enviada" href="#"><i class="fa fa-trash"></i><span>Basurero Enviadas</span>';
                            }
              if($cuenta_basurero_enviadas > 0 and $rol>20){
                  if($cuenta_basurero_enviadas < 100){
                    echo '<span class="label label-success pull-right">'.$cuenta_basurero_enviadas.'</span></a></li>';
                }else{
                    echo '<span class="label label-success pull-right">+99</span></a></li>';
                }       
              }else{
                  echo '</a></li>';
              }
              
              //no entra en ninguno de los casos              
                          }else{
              
                            echo '<li class="active"><a id="recibidas" href="#"><i class="fa fa-envelope"></i><span>Recibidas</span>';    
              if($cuenta_notificaciones_recibidas > 0){
                  if($cuenta_notificaciones_recibidas < 100){
                    echo '<span class="label label-success pull-right">'.$cuenta_notificaciones_recibidas.'</span></a></li>';
                }else{
                    echo '<span class="label label-success pull-right">+99</span></a></li>';
                }       
              }else{
                  echo '</a></li>';
              }
              
                          if($rol>20){echo '<li><a id="enviadas" href="#"><i class="fa fa-paper-plane"></i><span>Enviadas</span>';}  
              if($cuenta_notificaciones_enviadas > 0 and $rol>20){
                  if($cuenta_notificaciones_enviadas < 100){
                    echo '<span class="label label-success pull-right">'.$cuenta_notificaciones_enviadas.'</span></a></li>';
                }else{
                    echo '<span class="label label-success pull-right">+99</span></a></li>';
                }       
              }else{
                  echo '</a></li>';
              }
              
                            echo '<li><a id="basurero_recibida" href="#"><i class="fa fa-trash"></i><span>Basurero Recibidas</span>';
              if($cuenta_basurero_recibidas > 0){
                  if($cuenta_basurero_recibidas < 100){
                    echo '<span class="label label-success pull-right">'.$cuenta_basurero_recibidas.'</span></a></li>';
                }else{
                    echo '<span class="label label-success pull-right">+99</span></a></li>';
                }       
              }else{
                  echo '</a></li>';
              }
              
                          if($rol>20){  echo '<li><a id="basurero_enviada" href="#"><i class="fa fa-trash"></i><span>Basurero Enviadas</span>';}
              if($cuenta_basurero_enviadas > 0 and $rol>20){
                  if($cuenta_basurero_enviadas < 100){
                    echo '<span class="label label-success pull-right">'.$cuenta_basurero_enviadas.'</span></a></li>';
                }else{
                    echo '<span class="label label-success pull-right">+99</span></a></li>';
                }       
              }else{
                  echo '</a></li>';
              }
              
                          }
                        ?>

                                                </ul>

                                            </div>
                                        </div><!-- /.col (LEFT) -->

<div    class="col-md-9 col-sm-8">
<div class="box box-primary">
   <div class="box-body">
   <aside  class="box-body right-side">
      
      <div  id ="cajaNotif"class="box-body content-wrapper">
        <!-- Content Header (Page header) -->
                <!-- Main content -->
        
        <article  data-folio="<?php echo $result['NroFolio']; ?>" ></article>
                
                    <!-- title row -->
                    <div id="id_notificacion"
                    class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-envelope-o"></i> Notificación al folio: <?php echo $result['NroFolio']; ?>
                               
                              
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
					    <strong>De parte: </strong>
                        <?php echo $Usuario ?>
						<div class="pull-right">
                            <strong>
                            <?php $date = date_create($result['FechaCreacion']); 
		                        echo $dias[date_format($date,'w')]." ".date_format($date,'d')." de ".$meses[date_format($date,'n')-1]. " del ".date_format($date,'Y'); ?>  
							</strong> 
					    </div>
                    </div><!-- /.row -->
                    <hr>
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <p class="lead"><strong><?php echo $result['Titulo']; ?></strong></p>
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            <?php echo $result['Cuerpo']; ?>
                            </p>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                   
          <br />
           
                
      </div>    
        </aside><!-- /.right-side -->


                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col (MAIN) -->
                      </div>
                  </div><!-- MAILBOX END -->

                </section><!-- /.content -->
            </div>
        </div><!--/col-span-10-->
</div><!-- /Main -->

<!--Enviar una nueva notificacion-->
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-floppy-disk"></i> Enviar Notificación</h4>
            </div>
            <div class="modal-body">  
		    <!-- form start -->
			    <form role="form" id="form" name="form" action="#">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nueva notificación</h3>
                        </div><!-- /.box-header -->
						
                        <div class="box-body">
						
				            <div class="form-group">
					            <input type ="hidden" name="Usuario" id="Insertar_Emisor" class="form-control"  readonly="readonly"  value="<?php echo $user;?>">
					            <input type="hidden" name="FechaCreacion" id="FechaCreacion" class="form-control"  readonly="readonly" value="<?php echo date('Y-m-d H:i:s');?>">
					            <?php echo $usuario;?>
					            <div class="pull-right">
                                    Fecha: <?php $date2 = date_create(date('Y-m-d H:i:s')); 
		                            echo $dias[date_format($date2,'w')]." ".date_format($date2,'d')." de ".$meses[date_format($date2,'n')-1]. " del ".date_format($date2,'Y');?>
                                </div>				  
                            </div>   
				            <div class="form-group">
				                <div class="input-group">
                                    <span class="input-group-addon">Número Folio :</span>
                                     <select  id="NroFolio" class="form-control"name="NroFolio" >
                                          
                                            <?php foreach( $filas as $row ) { ?>
                                            <option value="<?php echo $row['NroFolio'];?>"><?php echo $row["NroFolio"];?></option><?php } ?>
									    </select>
	                            </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Para :</span>
                                        <select required= "required" multiple id="Destinatarios" class="form-control" name="Destinatarios[]" >                  
                                            <?php foreach( $filas2 as $row ) {if($row["nombre"]!=$usuario ){ ?>
                                            <option value="<?php echo $row["id_Usuario"];?>"><?php echo $row["nombre"];?></option><?php }} ?>
							            </select>      
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="Titulo" id="Insertar_Titulo" placeholder="Título:"/ required>
                            </div>
                            <div class="form-group">
                                <textarea name="Mensaje" id="Insertar_Mensaje" class="form-control" style="height: 150px" placeholder="Mensaje..." required></textarea>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
					            <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>
								
                            </div>
                            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Descartar</button>
                        </div><!-- /.box-footer -->
						
                    </div><!-- /. box -->
				</form><!-- /.form -->		
		    </div><!-- modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" src="js/gestion_folios/Notificaciones.js" ></script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>