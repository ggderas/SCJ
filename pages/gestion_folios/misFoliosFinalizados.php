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

  if(isset($_POST['tipoFolio'])){
    $tipoFolio = $_POST['tipoFolio'];
    if($tipoFolio == 'foliosEntrada'){
	  require_once('datos/datos_folios_entrada.php');
	}elseif($tipoFolio == 'foliosSalida'){
	  require_once('datos/datos_folios_salida.php');
	}else{
	  require_once('datos/DatosFoliosSeguimientosFinalizados.php');
	}
  }else{
	require_once('datos/DatosFoliosSeguimientosFinalizados.php');
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

                    <!-- MAILBOX BEGIN -->
                    <div class="mailbox row">
                        <div class="col-xs-12">
                            <div class="box box-solid">
								<a class="btn btn-primary" data-mode="cancelar1"><i class="fa fa-check-square"></i> Seguimientos Finalizado</a>
					            <a class="btn btn-primary" data-mode="cancelar"><i class="fa fa-binoculars"></i> Seguimientos Sin Finalizadar</a>
								<div class="box-body">
								    
                                    <div class="row">
                                        
                                        <div class="col-md-12 col-sm-12">
                            <div class="box">
                                <div class="box-header">
                                    <h1>Folios con seguimiento finalizado</h1>
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
												<th>Fecha Finalizado</th>
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
            $FechaFinal =$row['FechaFinal'];
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
				echo "<td> ".$FechaFinal." </td>";
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
												<th>Fecha Finalizado</th>
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
	  "order": [[ 6, "desc" ]],
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
	
	$(".btn-primary").on('click',function(){
        mode = $(this).data('mode');
         if(mode == "cancelar"){       
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/misFolios.php", 
                success:CancelarOrganizacion,
                timeout:4000,
                error:problemas
          }); 
          
          return false;
        }else if(mode == "cancelar1"){       
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/misFoliosFinalizados.php", 
                success:CancelarOrganizacion1,
                timeout:4000,
                error:problemas
          }); 
          
          return false;
        }
    });
  });
  
    function CancelarOrganizacion(){

            $("#div_contenido").load('pages/gestion_folios/misFolios.php');
    }
	
	function CancelarOrganizacion1(){

            $("#div_contenido").load('pages/gestion_folios/misFoliosFinalizados.php');
    }
	
	function llegadaVer(){

        $("#div_contenido").load('pages/gestion_folios/datos_folio.php',data);
    }
</script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>