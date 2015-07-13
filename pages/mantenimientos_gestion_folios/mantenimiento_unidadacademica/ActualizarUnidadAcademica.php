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

  $adId_UnidadAcademica= $_POST['Id_UnidadAcademica'];

  try{
    $sql = "SELECT * FROM unidad_academica WHERE Id_UnidadAcademica =:adId_UnidadAcademica";

    $query = $db->prepare($sql);
    $query->bindParam(":adId_UnidadAcademica",$adId_UnidadAcademica);
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
                <th>ID_UnidadAcadémica</th>
                <th>NombreUnidadAcadémica</th>
                <th>UbicaciónUnidadAcadémica</th>
				<th>Actualización</th>
                <th>Cancelar</th>				
            </tr>
        </thead>
        <tbody>
            <tr><form action='#'>
			    <td><p id="Id_UnidadAcademica"><?php echo $result['Id_UnidadAcademica']; ?></p></td>
				<td><input name='NombreUnidadAcademica' id="NombreUnidadAcademica" type ='text' maxlength="50" value="<?php echo htmlentities($result['NombreUnidadAcademica']); ?>" placeholder="<?php echo htmlentities($result['NombreUnidadAcademica']); ?>" ></td>
				<td><input name='UbicacionUnidadAcademica' id="UbicacionUnidadAcademica" type ='text' maxlength="300" value="<?php echo htmlentities($result['UbicacionUnidadAcademica']); ?>" placeholder="<?php echo htmlentities($result['UbicacionUnidadAcademica']); ?>" ></td>
               <td> <button type="button" id="actulizar_unidadacademica" data-id=<?php echo $result['Id_UnidadAcademica']; ?> class="btn btn-primary pull-left" data-mode="actualizar">Actualizar</button></td>
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
            NombreUnidadAcademica=$("#NombreUnidadAcademica").val();
            UbicacionUnidadAcademica=$("#UbicacionUnidadAcademica").val();
      data={
            Id_UnidadAcademica:id,
            NombreUnidadAcademica:$("#NombreUnidadAcademica").val(),
            UbicacionUnidadAcademica:$("#UbicacionUnidadAcademica").val(),
            tipoProcedimiento:"actualizar_"
          };
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_unidadacademica.php", 
                success:actualizarUnidadAcademicaFinalizado,
                timeout:4000,
          }); 
          return false;}
    });

    function actualizarUnidadAcademicaFinalizado(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_unidadacademica.php',data);
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
                url:"pages/mantenimientos_gestion_folios/mantenimiento_unidadacademica.php", 
                success:CancelarUnidadAcademica,
                timeout:4000,
                error:problemas
          }); 
          
          return false;
        }
    });

    function CancelarUnidadAcademica(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_unidadacademica.php');
    }
</script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>
