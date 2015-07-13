<?php

  $maindir = "../../";

  if(isset($_GET['contenido']))
  {
    $contenido = $_GET['contenido'];
  }
  else
  {
    $contenido = 'gestion_de_folios';
	$navbar_loc = 'mantenimiento';
  }

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");
  
  require_once($maindir.'pages/navbar.php');

  require_once($maindir."conexion/config.inc.php");

  if(isset($_POST['tipoProcedimiento'])){
    $tipoProcedimiento =  $_POST['tipoProcedimiento'];
    if($tipoProcedimiento == 'insertar'){
      require_once("mantenimiento_categorias_folios/InsertarCategoriasFolios.php");
    }elseif($tipoProcedimiento == 'actualizar_'){
      require_once("mantenimiento_categorias_folios/ActualizarCategoriasFoliosCodigo.php");
    }elseif($tipoProcedimiento == 'eliminar'){
      require_once("mantenimiento_categorias_folios/EliminarCategoriasFolios.php");
    }
  }

  $query = $db->prepare("SELECT * FROM categorias_folios");
  $query->execute();
    $rows = $query->fetchAll();
        if($rows){
            $categorias_folios = 1;
        }else{
            $categorias_folios = 0;
        }
    $query = null;
    $db = null;

?>

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

      <div class="box-header">
        <h3 class="box-title">Mantenimiento de la tabla Categoría Folios <a class="btn btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i>Insertar</a></h3>
      </div><!-- /.box-header -->

      <div class="box-body table-responsive">
      <table id="tabla_categorias_folios" class='table table-bordered table-striped'>
        <thead>
            <tr>
              <th>Id_categoria</th>
              <th>NombreCategoría</th>
              <th>DescripciónCategoría</th>
              <th>Actualización</th>
              <th>Eliminación</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($rows as $row) {   
            $Id_categoria = $row['Id_categoria'];
        ?>
        
            <tr>
               <td><?php echo $row['Id_categoria']; ?></td>
                <td><?php echo $row['NombreCategoria']; ?></td>
                <td><?php echo $row['DescripcionCategoria']; ?></td>
<?php

echo '<td><a class="btn btn-block btn-primary" data-mode="actualizar" data-id="'.$Id_categoria.'" href="#">Actualizar</a></td>';
echo '<td><a class="btn btn-block btn-primary" data-mode="eliminar" data-id="'.$Id_categoria.'" href="#"></i>Eliminar</a></td>';

?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    </div>
 
    </section><!-- /.content -->
    </div><!-- /col-10 -->                
  </div><!-- end row -->
</div><!-- end container fluid -->

<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	  <form role="form" id="form" name="form" action="#">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-floppy-disk"></i> Insertar una nueva Categorías Folios</h4>
      </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">Nombre de la Categoría del Folio</span>
                <input name="NombreCategoria" id="Insertar_NombreCategoria" type="text" class="form-control" placeholder="NombreCategoria" maxlength="50" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">Descripción de la categoría del folio</span>
                <input name="DescripcionCategoria" id="Insertar_DescripcionCategoria" type="text" class="form-control" placeholder="DescripcionCategoria" maxlength="250" required>
              </div>
            </div>       
          </div> 
          <div class="modal-footer clearfix">
            <button name="submit" id="submit" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-pencil"></i> Insertar</button>
          </div>
		</form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Script para inicializar el funcionamiento de la tabla -->
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#tabla_categorias_folios').dataTable({
	
	"order": [[ 0, "asc" ]],
	"fnDrawCallback": function( oSettings ) {
	
	  $(".btn-primary").unbind('click');
	
	  $(".btn-primary").on('click',function(){
          mode = $(this).data('mode');
          id = $(this).data('id');
          if(mode == "actualizar"){
            data={
              Id_categoria:id,
              tipoProcedimiento:"actualizar"
            };
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_categorias_folios/ActualizarCategoriasFolios.php", 
                success:actualizarCategoriasFolios,
                timeout:4000,
                error:problemas
            }); 
            return false;
          }else if(mode == "eliminar"){
              data={
                Id_categoria:id,
                tipoProcedimiento:"eliminar"
              };
              if (confirm('Esta seguro que desea eliminar este registro?')) {
              $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_categorias_folios.php", 
                success:eliminarCategoriasFolios,
                timeout:4000,
                error:problemas
              }); 
            }
            return false;
          }
        });
	  }
	}); // tabla_categorias_folios es el id de la tabla
  });
  
  function eliminarCategoriasFolios(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_categorias_folios.php',data);
    }
  function actualizarCategoriasFolios(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_categorias_folios/ActualizarCategoriasFolios.php',data);
    }
</script>

<!-- Script necesario para que la tabla se ajuste a el tamanio de la pag-->
<script type="text/javascript">
  // For demo to fit into DataTables site builder...
  $('#tabla_categorias_folios')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
</script>

<script type="text/javascript" src="js/gestion_folios/mantenimiento_categorias_folios.js" ></script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>
