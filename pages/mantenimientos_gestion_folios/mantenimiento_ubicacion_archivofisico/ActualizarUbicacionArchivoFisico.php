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

  $adId_UbicacionArchivoFisico = $_POST['Id_UbicacionArchivoFisico'];

  try{
    $sql = "SELECT * FROM ubicacion_archivofisico WHERE Id_UbicacionArchivoFisico = :adId_UbicacionArchivoFisico";

    $query = $db->prepare($sql);
    $query->bindParam(":adId_UbicacionArchivoFisico",$adId_UbicacionArchivoFisico);
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
                <th>Id_UbicaciónArchivoFísico</th>
                <th>DescripciónUbicaciónFisica</th>
                <th>Capacidad</th>
				<th>TotalIngresados</th>
				<th>HabilitadoParaAlmacenar</th>
				<th>Actualización</th>
                <th>Cancelar</th> 				
            </tr>
        </thead>
        <tbody>
            <tr><form action='#'>
			    <td><p id="Id_UbicacionArchivoFisico"><?php echo $result['Id_UbicacionArchivoFisico']; ?></p></td>
				<td><input name='DescripcionUbicacionFisica' id="DescripcionUbicacionFisica" type ='text' maxlength="100" value="<?php echo htmlentities($result['DescripcionUbicacionFisica']); ?>" placeholder="<?php echo htmlentities($result['DescripcionUbicacionFisica']); ?>" ></td>
				<td><input name='Capacidad' id="Capacidad" type ='text' maxlength="10" onkeypress="ValidaSoloNumeros();" value="<?php echo htmlentities($result['Capacidad']); ?>" placeholder="<?php echo htmlentities($result['Capacidad']); ?>" ></td>
				<td><input name='TotalIngresados' id="TotalIngresados" type ='text' maxlength="10" onkeypress="ValidaSoloNumeros();" value="<?php echo htmlentities($result['TotalIngresados']); ?>" placeholder="<?php echo htmlentities($result['TotalIngresados']); ?>" ></td>
				<td>
				<div class="form-group">
                <div class="input-group">
				  <div class="input-group">
                    <select id="HabilitadoParaAlmacenar" class="form-control" width="420" style="width: 420px" name="HabilitadoParaAlmacenar">
					<?php
					    if($result['HabilitadoParaAlmacenar'] == 1){
						    echo '<option value=1 selected> Habilitado </option>';
							echo '<option value=0> Deshabilitado </option>';
						}else{
						    echo '<option value=1> Habilitado </option>';
							echo '<option value=0 selected> Deshabilitado </option>';
						}
					?>
				    </select>
                  </div>
                </div>
                </div>       
				</td>
               <td> <button type="button" id="actulizar_ubicacion_archivofisico" data-id=<?php echo $result['Id_UbicacionArchivoFisico']; ?> class="btn btn-primary pull-left" data-mode="actualizar">Actualizar</button></td>
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
          data={
            Id_UbicacionArchivoFisico:id,
            DescripcionUbicacionFisica:$("#DescripcionUbicacionFisica").val(),
            Capacidad:$("#Capacidad").val(),
			TotalIngresados:$("#TotalIngresados").val(),
			HabilitadoParaAlmacenar:$("#HabilitadoParaAlmacenar").val(),
            tipoProcedimiento:"actualizar_"
          };
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_archivofisico.php", 
                success:actualizarUbicacionArchivoFisicoFinalizado,
                timeout:4000
          }); 
          return false;
		  }else if(mode == "cancelar"){       
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_archivofisico.php", 
                success:CancelarUbicacionArchivoFisico,
                timeout:4000,
                error:problemas
          }); 
          
          return false;
        }
    });

    function actualizarUbicacionArchivoFisicoFinalizado(){
            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_archivofisico.php',data);
    }
	function CancelarUbicacionArchivoFisico(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_archivofisico.php');
    }
	function ValidaSoloNumeros() {
      if ((event.keyCode < 48) || (event.keyCode > 57)) 
        event.returnValue = false;
    }
</script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>
