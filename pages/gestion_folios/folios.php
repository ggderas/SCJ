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

  if(isset($_POST['tipoProcedimiento'])){
    $tipoProcedimiento = $_POST['tipoProcedimiento'];
    if($tipoProcedimiento == 'insertar' || $tipoProcedimiento == 'insertar_con_folio_respuesta'){
      require_once("insertar_nuevo_folio.php");
	}elseif($tipoProcedimiento == 'actualizar_folio_'){
	  require_once("actualizar_datos_folio_codigo.php");
	}
  }

  if(isset($_POST['tipoFolio'])){
    $tipo = $_POST['tipoFolio'];
    if($tipo == 'foliosEntrada'){
	  require_once('datos/datos_folios_entrada.php');
	}elseif($tipo == 'foliosSalida'){
	  require_once('datos/datos_folios_salida.php');
	}else{
	  require_once('datos/datos_folios.php');
	}
  }else{
	require_once('datos/datos_folios.php');
  }

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
                                                <i class="fa fa-inbox"></i>
                                                <h3 class="box-title"> Folios </h3>
												
                                            </div>
                                            <!-- compose message btn -->
                                            <!-- <a class="btn btn-block btn-primary" id="nuevo_folio" href="javascript:ajax_('pages/gestion_folios/nuevo_folio.php');"><i class="fa fa-pencil"></i> Nuevo Folio</a> -->
                                            <!-- Navigation - folders-->
                                            <a class="btn btn-block btn-primary" id="nuevo_folio"><i class="fa fa-pencil"></i> Nuevo Folio</a>
											<a class="btn btn-block btn btn-info" id="folios_pdf"><i class="fa fa-print"></i> Reporte Folios Diarios</a>
                                            <div style="margin-top: 15px;">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li class="header">Tipos de folios</li>
                                                <?php
												    if(isset($_POST['tipoFolio'])){
													    $tipoFolio = $_POST['tipoFolio'];
													    if($tipoFolio == 'todos'){
														    echo '<li class="active"><a id="todosFolios" href="#"><i class="fa fa-inbox"></i> Folios </a></li>';    
														}else{
														    echo '<li><a id="todosFolios" href="#"><i class="fa fa-inbox"></i> Folios </a></li>';
														}
												
														if($tipoFolio == 'foliosEntrada' || $tipoFolio == "0"){
														    echo '<li	 class="active"><a id="foliosEntrada" href="#"><i class="glyphicon glyphicon-download-alt"></i> Folios de Entrada </a></li>';
														}else{
														    echo '<li><a id="foliosEntrada" href="#"><i class="glyphicon glyphicon-download-alt"></i> Folios de Entrada </a></li>';
														}
														
														if($tipoFolio == 'foliosSalida' || $tipoFolio == "1"){
														    echo '<li class="active"><a id="foliosSalida" href="#"><i class="glyphicon glyphicon-send"></i> Folios de Salida</a></li>';
														}else{
														    echo '<li><a id="foliosSalida" href="#"><i class="glyphicon glyphicon-send"></i> Folios de Salida</a></li>';
														}
													}else{
													    echo '<li class="active"><a id="todosFolios" href="#"><i class="fa fa-inbox"></i> Folios </a></li>';    
														echo '<li><a id="foliosSalida" href="#"><i class="glyphicon glyphicon-download-alt"></i> Folios de Entrada </a></li>';
														echo '<li><a id="foliosEntrada" href="#"><i class="glyphicon glyphicon-send"></i> Folios de Salida</a></li>';
													}
												?>													                                          
                                                </ul>
                                            </div>
                                        </div><!-- /.col (LEFT) -->
                                        <div class="col-md-9 col-sm-8">
                            <div class="box">
                                <div class="box-header">
								<?php
						            if(isset($_POST['tipoFolio'])){
									    $tipoFolio = $_POST['tipoFolio'];
									    if($tipoFolio == 'todos'){
											echo '<h3 class="box-title">Folios</h3>';    
										}elseif($tipoFolio == 'foliosSalida'){
									        echo '<h3 class="box-title">Folios de salida</h3>';
										}elseif($tipoFolio == 'foliosEntrada'){
										    echo '<h3 class="box-title">Folios de entrada</h3>';
										}
									}
							    ?>	
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
<?php 
        if($folios == 1){
echo <<<HTML
                                    <table id="tabla_folios" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Folio</th>
                                                <th>P. Referente</th>
                                                <th>Entidad</th>
												<th>Categoria</th>
                                                <th>Tipo de folio</th>
                                                <th>Fecha de entrada</th>
                                            </tr>
                                        </thead>
                                        <tbody>
HTML;

            foreach( $rows as $row ){ 
     
            $NroFolio = $row['NroFolio'];
            $PersonaReferente = $row['PersonaReferente'];
            $ENTIDAD = $row['ENTIDAD'];
			$categoria = $row['NombreCategoria'];
            $FechaEntrada = $row['FechaEntrada'];
            $TipoFolio = $row['TipoFolio'];

                echo <<<HTML
				<tr data-id='$NroFolio'>
                <td><a href="#">$NroFolio</a></td>
                <td><a href="#">$PersonaReferente</a></td>
                <td><a href="#">$ENTIDAD</a></td>
				<td><a href="#">$categoria</a></td>

HTML;
                if ($TipoFolio == 0) {
                    echo "<td> Entrada </td>";
                }else{
                    echo "<td> Salida </td>";
                }
                echo "<td> ".$FechaEntrada." </td>";
                echo "</tr>";

            }
                
echo <<<HTML
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Folio</th>
                                                <th>P. Referente</th>
                                                <th>Entidad</th>
												<th>Categoria</th>
                                                <th>Tipo de folio</th>
                                                <th>Fecha de entrada</th>
                                            </tr>
                                        </tfoot>
									</table>
HTML;

        }
        else
        {
            echo "<tr>";
            echo "<td>No hay ningun folio disponible</td>";
            echo "</tr>";
        }

?>
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

<!-- Script para inicializar el funcionamiento de la tabla -->
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#tabla_folios').dataTable({
	  "order": [[ 5, "desc" ]],
	  "fnDrawCallback": function( oSettings ) {
	    $(".table-striped").find('tr[data-id]').unbind('click');
	  
        $(".table-striped").find('tr[data-id]').on('click', function () {
          id = $(this).data('id');
          data ={ idFolio:id};     
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/datos_folio.php", 
                success:llegadaVer,
                timeout:4000,
                error:problemas
            }); 
            return false;
        });
      }
	}); // example es el id de la tabla
	
	$('#tabla_folios')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
	
	$("#folios_pdf").click(function() {
			window.open('pages/gestion_folios/folios_diarios_pdf.php');
	   	});	
  });
</script>

<script type="text/javascript" src="js/gestion_folios/folios.js" ></script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>
