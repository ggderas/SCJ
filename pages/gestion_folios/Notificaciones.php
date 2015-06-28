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

   $user = $_SESSION['nombreUsuario'];

  if(isset($_POST['tipoProcedimiento'])){
    $tipoProcedimiento =  $_POST['tipoProcedimiento'];
    if($tipoProcedimiento == 'insertar'){
      require_once("gestion_de_folios/Enviar_notificacion.php");
    }
  }


$query2 = $db->prepare( "SELECT NroFolio  FROM folios");
$query2->execute();
$filas = $query2->fetchAll();
        if($filas){
            //$number_of_rows = $rows->rowCount();
            $folio = 1;
        }else{
            $numero_filas = 0;
            $notificacion = 0;
        }
    $query2 = null;
    

//Consulta para cargar los usuarios al combobox
$query3 = $db->prepare("SELECT * FROM usuario");
$query3->execute();
$filas2 = $query3->fetchAll();
        if($filas2){
            //$number_of_rows = $rows->rowCount();
            $usuario= 1;
        }else{
            $numero_filas = 0;
            $notificacion = 0;
        }
    $query3 = null;

 //Consulta para ver el idUsuario   
$query5 = $db->prepare( "SELECT *  FROM usuario WHERE nombre ='".$user."'");
$query5->execute();
$filas3 = $query5->fetchAll();
foreach( $filas3 as $row ){ 
     
            $usuario2 = $row['id_Usuario'];
            }


//Consulta para ver las notificaciones Enviadas
  $query = $db->prepare("SELECT NroFolio,Titulo,FechaCreacion FROM notificaciones_folios WHERE IdEmisor=(SELECT id_Usuario FROM usuario WHERE nombre='".$user."')");
    $query->execute();
    $rows = $query->fetchAll();
        if($rows){
            //$number_of_rows = $rows->rowCount();
            $notificacion = 1;
        }else{
            $number_of_rows = 0;
            $notificacion = 0;
        }
    $query = null;
    

//Consulta para ver las notificaciones Recibidas
 $query4 = $db->prepare("SELECT NroFolio,Titulo,FechaCreacion FROM notificaciones_folios WHERE Id_Notificacion=(SELECT Id_Notificacion from usuario_notificado WHERE Id_Usuario=(SELECT id_Usuario from usuario where nombre ='".$user."'))");
    $query4->execute();
    $rows2 = $query4->fetchAll();
        if($rows2){
            //$number_of_rows = $rows->rowCount();
            $notificacion = 1;
        }else{
            $number_of_rows = 0;
            $notificacion = 0;
        }
    $query4 = null;


?>

<!-- Main -->
<div class="container-fluid">
<div class="row">
    <?php 
        require_once("navbar.php");
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



                    <div class="mailbox row">
                        <div class="col-xs-12">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3">
                                            <!-- BOXES are complex enough to move the .box-header around.
                                                 This is an example of having the box header within the box body -->
                                            <div class="box-header">
                                                <i class="fa fa-inbox"></i>
                                                <h3 class="box-title"> Notificaciones </h3>
                                            </div>
                                            <!-- compose message btn -->
                                            <!-- <a class="btn btn-block btn-primary" id="nuevo_folio" href="javascript:ajax_('pages/gestion_folios/nuevo_folio.php');"><i class="fa fa-pencil"></i> Nuevo Folio</a> -->
                                            <!-- Navigation - folders-->
                                         <a class="btn btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i>Nueva Notificacion</a>
                                            <div style="margin-top: 15px;">
                                                <ul class="nav nav-pills nav-stacked">
                            
                                                    <li class="active"><a href="#"><i class="fa fa-inbox"></i>Notificaciones (14)</a></li>
                                                    <li><a href="#"><i class="glyphicon glyphicon-download-alt"></i> Recibidas </a></li>
                                                    <li><a href="#tabla_folios"><i class="glyphicon glyphicon-send"></i> Enviadas</a></li>
                                                    <li><a href="#tabla_folios"><i class="glyphicon glyphicon-send"></i> Basurero</a></li>
                                                </ul>
                                            </div>
                                        </div><!-- /.col (LEFT) -->
                                        <div class="col-md-9 col-sm-8">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Notificaciones </h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="tabla_folios" class="table table-bordered table-striped">
                                      
<?php 
        if($notificacion == 1){

echo <<<HTML
                                        <thead>
                                            <tr>
                                                <th>Numero de Folio</th>
                                                <th>Titulo</th>
                                                <th>Fecha</th>
                                                
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
HTML;

            foreach( $rows as $row ){ 
     
            $NroFolio = $row['NroFolio'];
            $Titulo = $row['Titulo'];
        
            $FechaCreacion = $row['FechaCreacion'];
          

                echo "<tr data-id='".$NroFolio."'>";
                echo <<<HTML
                <td><a href="#">$NroFolio</a></td>

HTML;
                //echo <<<HTML <td><a href='javascript:ajax_("'$url'");'>$NroFolio</a></td>HTML;
                echo <<<HTML
                <td><a href="#">$Titulo</a></td>

HTML;
                echo <<<HTML
                <td><a href="#">$FechaCreacion</a></td>

HTML;
                
                
                echo "</tr>";

            }
                
echo <<<HTML
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Numero de Folio</th>
                                                <th>Titulo</th>
                                                <th>Fecha</th>
                                               
                                                
                                            </tr>
                                        </tfoot>
HTML;

        }
        else
        {
            echo "<tr>";
            echo "<td>No hay ninguna notificacion disponible</td>";
            echo "</tr>";
        }

?>
                                        
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                                        </div><!-- /.col (RIGHT) -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col (MAIN) -->
                      </div>
                  </div><!-- MAILBOX END -->
</section><!-- /.content -->
</div>
</div><!--/col-span-10-->

</div><!-- /Main -->

<!-- Formulario modal para componer una nueva notificacion -->
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-floppy-disk"></i> Enviar Notificacion</h4>
      </div>
	  <!-- form start -->
      <form role="form" id="form" name="form" action="#">
          <div class="modal-body">  
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Componer nueva notificacion</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				  <div class="form-group">
                    <input type="hidden" name="Usuario" id="Insertar_Emisor" class="form-control"  readonly="readonly"  value="<?php echo $usuario2;?>"/>
					<input type="hidden" name="FechaCreacion" id="FechaCreacion" class="form-control"  readonly="readonly" value="<?php echo date('Y-m-d');?>" />
					<?php echo $user;?>
					<div class="pull-right">
                      Fecha: <?php echo date('Y-m-d');?>
                    </div>					  
                  </div>   
				  <div class="form-group">
				    <div class="input-group">
                      <span class="input-group-addon">Numero Folio :</span>
                      <select id="NroFolio" class="form-control"name="NroFolio" >
                                            <option value=-1> -- Seleccione -- </option>
                                            <?php foreach( $filas as $row ) { ?>
                                            <option value="<?php echo $row["NroFolio"];?>"><?php echo $row["NroFolio"];?></option><?php } 
                                             ?></select>
	                </div>
                  </div>
                  <div class="form-group">
				    <div class="input-group">
				      <span class="input-group-addon">Para :</span>
                      <select id="Destinatarios" class="form-control"name="Destinatarios" >
                                            <option value=-1> -- Seleccione -- </option>
                                            <?php foreach( $filas2 as $row ) { ?>
                                            <option value="<?php echo $row["idUsuario"];?>"><?php echo $row["nombre"];?></option><?php } 
                                             ?></select>
	                </div>
                  </div>
                  <div class="form-group">
                    <input class="form-control" name="Titulo" id="Insertar_Titulo" placeholder="Titulo:"/ required>
                  </div>
                  <div class="form-group">
                    <textarea name="Mensaje" id="Insertar_Mensaje" class="form-control" style="height: 150px" placeholder="Mensaje..." required></textarea>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <div class="pull-right">
                    <button type="submit" name="submit" id="notificacion" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>
                  </div>
                  <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Descartar</button>
                </div><!-- /.box-footer -->
              </div><!-- /. box -->
      </div><!-- /.modal-content -->
	</form><!-- /.form -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Script para inicializar el funcionamiento de la tabla -->
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#tabla_notificaciones').dataTable(); // example es el id de la tabla
  } );
</script>

<!-- Script necesario para que la tabla se ajuste a el tamanio de la pag-->
<script type="text/javascript">
  // For demo to fit into DataTables site builder...
  $('#tabla_notificaciones')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
</script>

<script type="text/javascript" src="js/gestion_folios/Notificacion.js" ></script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>
