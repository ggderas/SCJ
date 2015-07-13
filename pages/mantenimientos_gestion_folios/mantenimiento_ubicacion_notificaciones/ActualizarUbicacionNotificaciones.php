<?php

  $maindir = "../../../";

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

  $adId_UbicacionNotificaciones = $_POST['Id_UbicacionNotificaciones'];

  try{
    $sql = "SELECT * FROM ubicacion_notificaciones WHERE Id_UbicacionNotificaciones = :adId_UbicacionNotificaciones";

    $query = $db->prepare($sql);
    $query->bindParam(":adId_UbicacionNotificaciones",$adId_UbicacionNotificaciones);
    $query->execute();
    $result = $query->fetch();
    $query = null;
    $db = null;
  }catch(PDOExecption $e){

  }

?>

<div class="container-fluid">
<div class="row">
<?php 
    require_once("../../gestion_folios/navbar.php");
?>
    <div class="col-sm-10">

    <section class="content">

                <!-- Content Header (Page header) -->
                <section class="content-header no-margin">
                    <h1 class="text-center">
                        Mantenimiento de Datos
                    </h1>
                </section>

  <div class="table-responsive">
	<table border="1" class='table table-bordered table-hover'>
        <thead>
            <tr>
                <th>Id_UbicaciónNotificaciones</th>
                <th>DescripciónUbicaciónNotificaciones</th>
				<th>Actualización</th>
                 <th>Cancelar</th>				
            </tr>
        </thead>
        <tbody>
            <tr><form action='#'>
			    <td><p id="Id_UbicacionNotificaciones"><?php echo $result['Id_UbicacionNotificaciones']; ?></p></td>
				<td><input name='DescripcionUbicacionNotificaciones' id="DescripcionUbicacionNotificaciones" type ='text' maxlength="50" value="<?php echo htmlentities($result['DescripcionUbicacionNotificaciones']); ?>" placeholder="<?php echo htmlentities($result['DescripcionUbicacionNotificaciones']); ?>" ></td>				
               <td> <button type="button" id="actulizar_ubicacion_notificaciones" data-id=<?php echo $result['Id_UbicacionNotificaciones']; ?> class="btn btn-primary pull-left" data-mode="actualizar">Actualizar</button></td>
			   <td><a class="btn btn-primary" data-toggle="modal" data-target="#compose-modal" data-mode="cancelar"><i class="fa fa-pencil"></i>Cancelar</a></td>
             </form>			
            </tr>
        </tbody>
    </table>
                
  </div><!-- /.table-responsive -->	

    </section><!-- /.content -->
    </div><!-- /col-10 -->                
  </div><!-- end row -->
</div><!-- end container fluid -->

<script type="text/javascript">
    $(".btn-primary").on('click',function(){
mode = $(this).data('mode');
  if(mode == "actualizar"){  
            id = $(this).data('id');
            DescripcionUbicacionNotificaciones=$("#DescripcionUbicacionNotificaciones").val();           
      data={
            Id_UbicacionNotificaciones:id,
            DescripcionUbicacionNotificaciones:$("#DescripcionUbicacionNotificaciones").val(),
            tipoProcedimiento:"actualizar_"
          };
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_notificaciones.php", 
                success:actualizarUbicacionNotificacionesFinalizado,
                timeout:4000,
          }); 
          return false;}
    });

    function actualizarUbicacionNotificacionesFinalizado(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_notificaciones.php',data);
    }
</script>

<script type="text/javascript">
    $(".btn-primary").on('click',function(){
        mode = $(this).data('mode');
         if(mode == "cancelar"){       
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_notificaciones.php", 
                success:CancelarUbicacionNotificaciones,
                timeout:4000,
                error:problemas
          }); 
          
          return false;
        }
    });

    function CancelarUbicacionNotificaciones(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_notificaciones.php');
    }
</script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>