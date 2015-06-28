<?php

  $maindir = "../../";

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");
  
  if(isset($_GET['contenido']))
  {
    $contenido = $_GET['contenido'];
  }else{
    $contenido = 'gestion_de_folios';
	$navbar_loc = 'contenido';
  }
  
  $NroFolio = $_POST['idFolio'];
  
  require_once($maindir.'pages/navbar.php');

  require_once('datos/obtener_datos_folio.php');

  require_once("datos/datos_nuevo_folio.php");

?>

<link href="css/datepicker.css" rel="stylesheet">
<link href="css/prettify.css" rel="stylesheet">
   
<script src="js/prettify.js"></script>
<script src="js/bootstrap-datepicker.js"></script>

<script>
    if (top.location != location) {
    top.location.href = document.location.href ;
  }
        $(function(){
            window.prettyPrint && prettyPrint();
            $('#dp1').datepicker({
                format: 'yyyy-mm-dd',
				language: "es",
                autoclose: true,
                todayBtn: true
            }).on('show', function() {
                var zIndexModal = $('#myModal').css('z-index');
                var zIndexFecha = $('.datepicker').css('z-index');
                $('.datepicker').css('z-index',zIndexModal+1);
            }).on('changeDate', function(ev){
                $('#dp1').datepicker('hide');
            });          

        });
</script>
<!-- Main -->
<div class="container-fluid">
<div class="row">
<?php
    require_once("navbar.php");
?>
    <div class="col-sm-10">
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Actualizar los datos del folio: <?php echo $result['NroFolio']; ?></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" id="form" name="form" action="#">
                                    <div class="box-body">
									    <div class="row">
					                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Numero del folio</span>
														<input type="hidden" id="NroFolioAnt" name="NroFolioAnt" value="<?php echo $result['NroFolio']; ?>">
                                                        <input type="text" name="NroFolio" class="form-control" disabled="disabled" id="NroFolio" placeholder="<?php echo $result['NroFolio']; ?>" value="<?php echo $result['NroFolio']; ?>" maxlength="25" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Fecha del folio:</span>
                                                        <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-m-d" data-link-field="dtp_input2" data-link-format="yyyy-m-d">
                                                            <input class="form-control" disabled="disabled" size="5" value="<?php echo $result['FechaEntrada']; ?>" style="width: 345px" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask id="dp1" required>
                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                        </div>   
                                                    </div>            
                                                </div>	
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Persona referente</span>
                                                        <input type="text" name="personaReferente" class="form-control" id="personaReferente" placeholder="<?php echo $result['PersonaReferente']; ?>" value="<?php echo $result['PersonaReferente']; ?>" title="Completa este campo" required>
                                                    </div>
                                                </div>
										        <h3 >Seleccione una organizacion o una unidad academica</h3>
												<br />
												<?php 
                                                    if($result['NombreUnidadAcademica'] == null or $result['NombreUnidadAcademica'] == ""){
                                                        echo "<strong>Organizacion referente: </strong>";  
                                                        echo $result['NombreOrganizacion'];
                                                    }elseif($result['NombreOrganizacion'] == null or $result['NombreOrganizacion'] == ""){
                                                        echo "<strong>Unidad Academica referente: </strong>";  
                                                        echo $result['NombreUnidadAcademica'];
                                                    }
                                                ?>
												<br />
								 		        <div class="col-sm-12">
											        <div class="col-sm-6">
										                <div class="form-group">
                                                            <div class="input-group">
                                                                <select id="Organizacion" class="form-control"name="Organizacion" <?php if($result['NombreOrganizacion'] == null or $result['NombreOrganizacion'] == ""){ echo "disabled";}?>>
                                                                    <option value=-1> -- Organizacion -- </option>
                                                                    <?php while($filas = mysqli_fetch_assoc($result2)) { ?>
                                                                    <option <?php if($result['NombreOrganizacion'] == $filas["NombreOrganizacion"]){ echo "selected"; } ?>
																	value="<?php echo $filas["Id_Organizacion"];?>"><?php echo $filas["NombreOrganizacion"];?></option><?php } mysqli_free_result($result2); ?>
														        </select>
                                                            </div>
                                                        </div>
											        </div>
									                <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <select id="unidadAcademica" class="form-control" name="unidadAcademica" <?php if($result['NombreUnidadAcademica'] == null or $result['NombreUnidadAcademica'] == ""){ echo "disabled";}?> >
                                                                    <option value=-1> -- Unidad Academica -- </option>>
                                                                    <?php while($filas = mysqli_fetch_assoc($result1)) { ?>
                                                                    <option <?php if($result['NombreUnidadAcademica'] == $filas["NombreUnidadAcademica"]){ echo "selected"; } ?> 
																	value="<?php echo $filas["Id_UnidadAcademica"];?>"><?php echo $filas["NombreUnidadAcademica"];?></option><?php } mysqli_free_result($result); ?>
														        </select>
                                                            </div>
                                                        </div>
											        </div>
										        </div>
										    <div class="form-group">
								                <label>Categoria del folio</label>
                                                <div class="input-group">
                                                    <select id="Categoria" class="form-control" width="420" style="width: 420px" name="Categoria">
                                                        <option value=-1> -- Seleccione la categoria del folio -- </option>
                                                        <?php while($filas = mysqli_fetch_assoc($result6)) { ?>
                                                        <option  <?php if($result['categoria'] == $filas["Id_categoria"]){ echo "selected"; } ?>
														value="<?php echo $filas["Id_categoria"];?>"><?php echo $filas["NombreCategoria"];?></option><?php } mysqli_free_result($result6); mysqli_close($conexion); ?>
											        </select>
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Descripcion</span>
                                                        <textarea id="Descripcion" class="form-control" name="Descripcion" rows="3" placeholder="<?php echo $result['DescripcionAsunto']; ?>" title="Completa este campo" required><?php echo $result['DescripcionAsunto']; ?></textarea>
                                                    </div>
                                                </div>
									        </div>
									        <div class="col-md-6">
									            <div class="form-group">
										            <label>Tipo de folio</label>
                                                    <div class="input-group">	    
                                                        <select id="TipoFolio" class="form-control" width="420" style="width: 420px" name="TipoFolio" required>
                                                            <option value=-1> Seleccione el tipo de folio </option>
                                                            <option value=0 <?php if($result['TipoFolio'] == 0){ echo "selected";} ?>> folio de entrada</option>
                                                            <option value=1 <?php if($result['TipoFolio'] == 1){ echo "selected";} ?>> folio de salida </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
											            <label>Ubicacion fisica del folio</label>
                                                        <select id="ubicacionFisica"class="form-control" width="420" style="width: 420px" name="ubicacionFisica" required>
                                                            <option value=-1> Seleccione la ubicacion fisica </option>
                                                            <?php while($filas = mysqli_fetch_assoc($result3)) { ?>
                                                            <option  <?php if($result['UbicacionFisica'] == $filas["Id_UbicacionArchivoFisico"]){ echo "selected";} ?> value="<?php echo $filas["Id_UbicacionArchivoFisico"];?>"><?php echo $filas["DescripcionUbicacionFisica"];?></option><?php } mysqli_free_result($result3); ?>
												        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
											            <label>Categoria del folio</label>
                                                        <select id="ubicacionFisica"class="form-control" width="420" style="width: 420px" name="ubicacionFisica" required>
                                                            <option value=-1> Seleccione la ubicacion fisica </option>
                                                            <?php while($filas = mysqli_fetch_assoc($result3)) { ?>
                                                            <option  <?php if($result['UbicacionFisica'] == $filas["Id_UbicacionArchivoFisico"]){ echo "selected";} ?> value="<?php echo $filas["Id_UbicacionArchivoFisico"];?>"><?php echo $filas["DescripcionUbicacionFisica"];?></option><?php } mysqli_free_result($result3); ?>
												        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group">
											            <label>Prioridad del folio</label>
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
                                                    </div>
                                                </div>
                                            </div>
								        </div>
							        </div><!-- /.box-body -->
							    <div class="row">
								    <div class="col-md-12">
                                        <div class="box-footer">
                                            <button name="submit" id="submit" class="btn btn-success" style="width:200px;"><i class="glyphicon glyphicon-check"></i> Actualizar </button>
										    <button name="cancel" id="cancel" class="btn btn-default" style="width:200px;"><i class="glyphicon glyphicon-floppy-remove"></i> Cancelar</button>
                                        </div>
									</div>
								</div>
                                </form>
                            </div><!-- /.box -->

                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </div><!--/col-span-10-->

</div>
<!-- /Main -->

<script>
    $( document ).ready(function() {
	
        $( "#unidadAcademica" ).change(function() {
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
                $('#unidadAcademica').prop('disabled', false);
            }
            else {
	            $('#unidadAcademica').val(-1);
                $('#unidadAcademica').prop('disabled', 'disabled');
            }
        });
	});
</script>

<script type="text/javascript" src="js/gestion_folios/actualizar_folio.js" ></script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>