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
  
  require_once("datos1/datos_nuevo_folio.php");

  $adNroFolio= $_POST['NroFolio'];

  try{
    $sql = "SELECT folios.NroFolio, folios.PersonaReferente, folios.UnidadAcademica, unidad_academica.NombreUnidadAcademica, folios.Organizacion, 
	    organizacion.NombreOrganizacion,folios.categoria, categorias_folios.NombreCategoria, folios.TipoFolio,folios.FechaEntrada, folios.FechaCreacion, folios.UbicacionFisica, 
		ubicacion_archivofisico.DescripcionUbicacionFisica ,folios.Prioridad  ,prioridad.DescripcionPrioridad, folios.DescripcionAsunto 
    	FROM folios INNER JOIN ubicacion_archivofisico ON folios.UbicacionFisica = ubicacion_archivofisico.Id_UbicacionArchivoFisico 
    	INNER JOIN prioridad ON folios.Prioridad = prioridad.Id_Prioridad 
		INNER JOIN categorias_folios ON folios.categoria = categorias_folios.Id_categoria
    	LEFT JOIN unidad_academica ON folios.UnidadAcademica = unidad_academica.Id_UnidadAcademica 
    	LEFT JOIN organizacion ON folios.Organizacion = organizacion.Id_Organizacion WHERE NroFolio =:adNroFolio";

    $query = $db->prepare($sql);
    $query->bindParam(":adNroFolio",$adNroFolio);
    $query->execute();
    $result = $query->fetch();
    $query = null;
    $db = null;
  }catch(PDOExecption $e){

  }

?>

<link href="css/datepicker.css" rel="stylesheet">
<link href="css/prettify.css" rel="stylesheet">
   
<script src="js/prettify.js"></script>
<script src="js/bootstrap-datepicker.js"></script>

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
            <form action='#'>
			<tr>
			    <td>NroFolio</td>
			    <td>
				<input type="hidden" id="NroFolioAnt" name="NroFolioAnt" value="<?php echo $result['NroFolio']; ?>">
				<input name="NroFolio" id="NroFolio" type="text" maxlength="25" value="<?php echo $result['NroFolio']; ?>" required></td>
		     </tr>
			 <tr>
			     <td>FechaCreación</td>
			     <td><input name='FechaCreacion' id="FechaCreacion" type ='text' maxlength="10" value="<?php echo htmlentities($result['FechaCreacion']); ?>" placeholder="<?php echo htmlentities($result['FechaCreacion']); ?>" required></td>
			 </tr>
			  <tr>
			  <td>FechaEntrada</td>
			  <td>
			  <input name='FechaEntrada' id="FechaEntrada" disabled="disabled" type ='text' maxlength="10" value="<?php echo htmlentities($result['FechaEntrada']); ?>" placeholder="<?php echo htmlentities($result['FechaEntrada']); ?>" required></td>
			  </tr>
				<tr>
			  <td>PersonaReferente</td>
			  <td><input name='PersonaReferente' id="PersonaReferente" type ='text' maxlength="50" value="<?php echo htmlentities($result['PersonaReferente']); ?>" placeholder="<?php echo htmlentities($result['PersonaReferente']); ?>" ></td>
			  </tr>
			  <tr>
			  <td>UnidadAcademica</td>
			  <td>
			    <select id="UnidadAcademica" class="form-control" name="UnidadAcademica" style="width: 420px" <?php if($result['NombreUnidadAcademica'] == null or $result['NombreUnidadAcademica'] == ""){ echo "disabled";}?>>
                                                                    <option value=-1> -- Unidad Académica -- </option>
                                                                    <?php while($filas = mysqli_fetch_assoc($result1)) { ?>
                                                                    <option <?php if($result['NombreUnidadAcademica'] == $filas["NombreUnidadAcademica"]){ echo "selected"; } ?> 
																	value="<?php echo $filas["Id_UnidadAcademica"];?>"><?php echo $filas["NombreUnidadAcademica"];?></option><?php } mysqli_free_result($result1); ?>
														        </select>

                                                            
		      </td>
			  </tr>
			  <tr>
			  <td>Organización</td>
			  <td> <select id="Organizacion" class="form-control"name="Organizacion" style="width: 420px" <?php if($result['NombreOrganizacion'] == null or $result['NombreOrganizacion'] == ""){ echo "disabled";}?>>
                                                                    <option value=-1> -- Organización -- </option>
                                                                    <?php while($filas = mysqli_fetch_assoc($result2)) { ?>
                                                                    <option <?php if($result['NombreOrganizacion'] == $filas["NombreOrganizacion"]){ echo "selected"; } ?>
																	value="<?php echo $filas["Id_Organizacion"];?>"><?php echo $filas["NombreOrganizacion"];?></option><?php } mysqli_free_result($result2); ?>
														        </select>
		      </td>
			  </tr>
			  <tr>
			  <td>Categoría</td>
			  <td> <select id="Categoria" class="form-control"name="Categoria" style="width: 420px">
                                                                    <option value=-1> -- Categoría -- </option>
                                                                    <?php while($filas = mysqli_fetch_assoc($result6)) { ?>
                                                                    <option <?php if($result['categoria'] == $filas["Id_categoria"]){ echo "selected"; } ?>
																	value="<?php echo $filas["Id_categoria"];?>"><?php echo $filas["NombreCategoria"];?></option><?php } mysqli_free_result($result6); ?>
														        </select>
		      </td>
			  </tr>
			  <tr>
			  <td>DescripcionAsunto</td>
			  <td><input name='DescripcionAsunto' id="DescripcionAsunto" type ='text' style="width: 420px" maxlength="300"  value="<?php echo htmlentities($result['DescripcionAsunto']); ?>" placeholder="<?php echo htmlentities($result['DescripcionAsunto']); ?>" ></td>
			  </tr>
			  <tr>
			  <td>TipoFolio</td>
			  <td><select id="TipoFolio" class="form-control" width="420" style="width: 420px" name="TipoFolio" required>
                                                            <option value=-1> Seleccione el tipo de folio </option>
                                                            <option value=0 <?php if($result['TipoFolio'] == 0){ echo "selected";} ?>> folio de entrada</option>
                                                            <option value=1 <?php if($result['TipoFolio'] == 1){ echo "selected";} ?>> folio de salida </option>
                                                        </select>
			  </td>
			  </tr>
			  <tr>
			  <td>UbicaciónFísica</td>
			  <td> <select id="UbicacionFisica"class="form-control" width="420" style="width: 420px" name="ubicacionFisica" required>
                                                            <option value=-1> Seleccione la ubicación física </option>
                                                            <?php while($filas = mysqli_fetch_assoc($result3)) { ?>
                                                            <option  <?php if($result['UbicacionFisica'] == $filas["Id_UbicacionArchivoFisico"]){ echo "selected";} ?> value="<?php echo $filas["Id_UbicacionArchivoFisico"];?>"><?php echo $filas["DescripcionUbicacionFisica"];?></option><?php } mysqli_free_result($result3); ?>
												        </select>
			  </td>
			  </tr>
			  <tr>
			  <td>Prioridad</td>
			  <td>
			  <input type="hidden" id="PrioridadAnt" name="PrioridadAnt" value="<?php echo $result['Prioridad']; ?>">
			  <select id="Prioridad" class="form-control" width="420" style="width: 420px" name="Prioridad" required>
                                                            <option value=-1> Seleccione la prioridad del folio </option>
                                                            <?php while($filas = mysqli_fetch_assoc($result4)) { ?>
                                                            <option 
															<?php if($result['Prioridad'] == $filas["Id_Prioridad"])
															{ echo "selected";} 
															?> value=<?php echo $filas["Id_Prioridad"];?> > 
															<?php echo $filas["DescripcionPrioridad"];?>
															</option><?php } mysqli_free_result($result4); mysqli_close($conexion); ?>
											            </select>
			   </td>
			  </tr>
			  <tr>
               <td> <button type="button" id="actulizar_folios" class="btn btn-primary pull-left" data-mode="actualizar" >Actualizar</button></td>
			   <td><a class="btn btn-primary" data-toggle="modal" data-target="#compose-modal" data-mode="cancelar"><i class="fa fa-pencil"></i>Cancelar</a></td>
			   </tr>
             </form>			
    </table>
                
  </div><!-- /.table-responsive -->	

    </section><!-- /.content -->
    </div><!-- /col-10 -->                
  </div><!-- end row -->
</div><!-- end container fluid -->

<script>
    if (top.location != location) {
    top.location.href = document.location.href ;
    }
    $(function(){
            window.prettyPrint && prettyPrint();
            $('#FechaEntrada').datepicker({
                format: 'yyyy-mm-dd',
				language: "es",
                autoclose: true,
                todayBtn: true
            }).on('show', function() {
                var zIndexModal = $('#myModal').css('z-index');
                var zIndexFecha = $('.datepicker').css('z-index');
                $('.datepicker').css('z-index',zIndexModal+1);
            }).on('changeDate', function(ev){
                $('#FechaEntrada').datetimepicker('hide');
            }); 
			
            $('#FechaCreacion').datepicker({
                format: 'yyyy-mm-dd',
				language: "es",
                autoclose: true,
                todayBtn: true
            }).on('show', function() {
                var zIndexModal = $('#myModal').css('z-index');
                var zIndexFecha = $('.datepicker').css('z-index');
                $('.datepicker').css('z-index',zIndexModal+1);
            }).on('changeDate', function(ev){
                $('#FechaCreacion').datepicker('hide');
            });    			

    });
</script>

<script type="text/javascript">
    $( "#UnidadAcademica" ).change(function() {
            var unidadAcademica = this.value;	
	        if (unidadAcademica == -1) {
                $('#Organizacion').prop('disabled', false);
            }
            else {
	            $('#Organizacion').val(-1);
                $('#Organizacion').prop('disabled', 'disabled');
            }
        });
	
	$( "#Organizacion" ).change(function() {
            var organizacion = this.value;	
	        if (organizacion == -1) {
                $('#UnidadAcademica').prop('disabled', false);
            }
            else {
	            $('#UnidadAcademica').val(-1);
                $('#UnidadAcademica').prop('disabled', 'disabled');
            }
    });

    $(".btn-primary").on('click',function(){
	  mode = $(this).data('mode');
      if(mode == "actualizar"){
      data={
	        NroFolioAnt:$("#NroFolioAnt").val(),
            NroFolio:$("#NroFolio").val(),
            FechaCreacion:$("#FechaCreacion").val(),
            FechaEntrada:$("#FechaEntrada").val(),
			PersonaReferente:$("#PersonaReferente").val(),
			UnidadAcademica:$("#UnidadAcademica").val(),
			Organizacion:$("#Organizacion").val(),
			Categoria:$("#Categoria").val(),
			DescripcionAsunto:$("#DescripcionAsunto").val(),
			TipoFolio:$("#TipoFolio").val(),
			UbicacionFisica:$("#UbicacionFisica").val(),
			Prioridad:$("#Prioridad").val(),
			prioridadAnt:$("#PrioridadAnt").val(),
            tipoProcedimiento:"actualizar_"
          };
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_folios.php", 
                success:actualizarFolioFinalizado,
                timeout:4000,
          }); 
          return false;
	  }else  if(mode == "cancelar"){       
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_folios.php", 
                success:CancelarFolio,
                timeout:4000,
                error:problemas
          }); 
          
          return false;
        }
    });

    function actualizarFolioFinalizado(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_folios.php',data);
    }
	
	function CancelarFolio(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_folios.php');
    }
</script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>