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

  $adIdOrganizacion= $_POST['Id_Organizacion'];

  try{
    $sql = "SELECT * FROM organizacion WHERE Id_Organizacion=:adIdOrganizacion";

    $query = $db->prepare($sql);
    $query->bindParam(":adIdOrganizacion",$adIdOrganizacion);
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
                <th>IDOrganización</th>
                <th>NombreOrganización</th>
                <th>Ubicación</th>
				<th>Actualización</th>
                <th>Cancelar</th>				
            </tr>
        </thead>
        <tbody>
            <tr><form action='#'>
			    <td><p id="Id_Organizacion"><?php echo $result['Id_Organizacion']; ?></p></td>
				<td><input name='NombreOrganizacion' id="NombreOrganizacion" type ='text' maxlength="50" value="<?php echo htmlentities($result['NombreOrganizacion']); ?>" placeholder="<?php echo htmlentities($result['NombreOrganizacion']); ?>" ></td>
				<td><input name='Ubicacion' id="Ubicacion" type ='text' maxlength="300" value="<?php echo htmlentities($result['Ubicacion']); ?>" placeholder="<?php echo htmlentities($result['Ubicacion']); ?>" ></td>
               <td> <button type="button" id="actulizar_organizacion" data-id=<?php echo $result['Id_Organizacion']; ?> class="btn btn-primary pull-left" data-mode="actualizar" >Actualizar</button></td>
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
            NombreOrganizacion=$("#NombreOrganizacion").val();
            Ubicacion=$("#Ubicacion").val();
      data={
            Id_Organizacion:id,
            NombreOrganizacion:$("#NombreOrganizacion").val(),
            Ubicacion:$("#Ubicacion").val(),
            tipoProcedimiento:"actualizar_"
          };
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_organizacion.php", 
                success:actualizarOrganizacionFinalizado,
                timeout:4000,
          }); 
          return false;}
    });

    function actualizarOrganizacionFinalizado(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_organizacion.php',data);
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
                url:"pages/mantenimientos_gestion_folios/mantenimiento_organizacion.php", 
                success:CancelarOrganizacion,
                timeout:4000,
                error:problemas
          }); 
          
          return false;
        }
    });

    function CancelarOrganizacion(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_organizacion.php');
    }
</script>



<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>