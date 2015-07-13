<?php

  $maindir = "../../";

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");
  
  if(isset($_GET['contenido']))
  {
    $contenido = $_GET['contenido'];
  }
else
  {
    $contenido = 'gestion_de_folios';
	$navbar_loc = 'contenido';
  }
  
require_once($maindir.'pages/navbar.php');

require_once("datos/datos_nuevo_folio.php");

  if(isset($_POST['idFolio'])){
    $FolioPara = $_POST['idFolio'];
  }

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

	    <aside class="right-side">
		    <?php 
			    if(isset($FolioPara)){
			        echo '<section class="content" id="section" data-folio="'.$FolioPara.'" data-pro="folio-respuesta">';
			    }else{
			        echo '<section class="content" id="section" data-pro="folio-nuevo">';
			    } 
			?>
    
	            <!-- begin box -->
	            <div class="box box-primary">  
				
				    <div class="box-header with-border">
					    <h3 class="box-title">Nuevo folio</h3>
						<div class="box-tools pull-right">
				            <button name="cancel" id="cancel" class="btn btn-box-tool"><i class="fa fa-times"></i> Cancelar </button>
						</div>
					</div><!-- /.box-header -->
	
	                <!-- begin box-body -->
	                <div class="box-body">
	                
	                <div class="row"><!-- left column -->
        
                        <div class="col-md-12">
						    <div class="stepwizard">
                                <div class="stepwizard-row setup-panel">
                                    <div class="stepwizard-step">
                                        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                        <p>Datos Generales</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                        <p>Datos de Almacenamiento</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                        <p>Datos del Seguimiento</p>
                                    </div>
                                </div>
                            </div>
                            <!-- form start -->
                            <form role="form" id="form" name="form" action="#">
                                <div class="row setup-content" id="step-1">
                                    <div class="col-xs-12">
                                        <div class="col-md-12">
                                            <h3> Datos Generales</h3>
											<div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"style="width: 200px"><strong>Número del folio</strong></span>
                                                    <input type="text" name="NroFolio" class="form-control" style="width: 550px" required="required" id="NroFolio" placeholder="Folio" maxlength="25">
                                                </div>	
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="width: 200px"><strong>Fecha del folio:</strong></span>
                                                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-m-d" data-link-field="dtp_input2" data-link-format="yyyy-m-d">
                                                        <input type="text" class="form-control" required="required" size="5" style="width: 512px" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask id="dp1" placeholder="yyyy-mm-dd" onkeypress="DenegarIngreso();">
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                    </div>   
                                                </div>            
                                            </div>	
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="width: 200px" ><strong>Persona referente</strong></span>
                                                    <input type="text" maxlength="50" name="personaReferente" class="form-control" style="width: 550px" required="required" id="personaReferente" placeholder="Persona Referente">
                                                </div>
                                            </div>
									        <div class="form-group">
										        <label>Tipo de folio</label>
                                                <div class="input-group">	    
                                                    <select id="TipoFolio" class="form-control" width="420" style="width: 420px" name="TipoFolio">
                                                        <option value=-1> -- Seleccione el tipo de folio -- </option>
                                                        <option value=0> folio de entrada</option>
                                                        <option value=1> folio de salida </option>
                                                    </select>
                                                </div>
                                            </div>
											<div class="form-group">
								                <label>Categoría del folio</label>
                                                <div class="input-group">
                                                    <select id="Categoria" class="form-control" width="420" style="width: 420px" name="Categoria">
                                                        <option value=-1> -- Seleccione la categoría del folio -- </option>
                                                        <?php while($filas = mysqli_fetch_assoc($result6)) { ?>
                                                        <option value="<?php echo $filas["Id_categoria"];?>"><?php echo $filas["NombreCategoria"];?></option><?php } mysqli_free_result($result6); mysqli_close($conexion); ?>
											        </select>
                                                </div>
                                            </div>
											<nav>
                                                <ul class="pager">
                                                    <li class="next"><a href="#" class="nextBtn">Siguiente <span aria-hidden="true">&rarr;</span></a></li>
                                                </ul>
                                            </nav>
                                            <!-- <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Siguiente</button> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row setup-content" id="step-2">
                                    <div class="col-xs-12">
                                        <div class="col-md-12">
                                            <h3> Datos de almacenamiento</h3>
											<h3 >Selecciones una organización o una unidad académica</h3>
										        <div class="col-sm-12">
											        <div class="col-sm-6">
										                <div class="form-group">
                                                            <div class="input-group">
                                                                <select id="Organizacion" class="form-control"name="Organizacion" >
                                                                    <option value=-1> -- Organización -- </option>
                                                                    <?php while($filas = mysqli_fetch_assoc($result2)) { ?>
                                                                    <option value="<?php echo $filas["Id_Organizacion"];?>"><?php echo $filas["NombreOrganizacion"];?></option><?php } mysqli_free_result($result2); ?>
														        </select>
                                                            </div>
                                                        </div>
											        </div>
									                <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <select id="unidadAcademica" class="form-control" name="unidadAcademica">
                                                                    <option value=-1> -- Unidad Académica -- </option>>
                                                                    <?php while($filas = mysqli_fetch_assoc($result1)) { ?>
                                                                    <option value="<?php echo $filas["Id_UnidadAcademica"];?>"><?php echo $filas["NombreUnidadAcademica"];?></option><?php } mysqli_free_result($result); ?>
														        </select>
                                                            </div>
                                                        </div>
											        </div>
													<p id="error_entidad" class="error_text" style="color:red"></p>
										        </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><strong>Descripción</strong></span>
                                                        <textarea id="Descripcion" class="form-control" name="Descripcion" required="required" rows="3" maxlength="300" placeholder="Ingrese una descripcion..."></textarea>
                                                    </div>
                                                </div>
												<div class="form-group">
											        <label>Ubicación física del folio</label>
                                                        <div class="input-group">          
                                                            <select id="ubicacionFisica"class="form-control" width="420" style="width: 420px" name="ubicacionFisica">
                                                                <option value=-1> -- Seleccione la ubicación física -- </option>
                                                                <?php while($filas = mysqli_fetch_assoc($result3)) { ?>
                                                                <option value="<?php echo $filas["Id_UbicacionArchivoFisico"];?>"><?php echo $filas["DescripcionUbicacionFisica"];?></option><?php } mysqli_free_result($result3); ?>
												            </select>
                                                        </div>
                                                </div>
                                                <div class="form-group">
												    <label>Prioridad del folio</label>
                                                        <div class="input-group">
                                                            <select id="Prioridad" class="form-control" width="420" style="width: 420px" name="Prioridad">
                                                                <option value=-1> -- Seleccione la prioridad del folio -- </option>
                                                                <?php while($filas = mysqli_fetch_assoc($result4)) { ?>
                                                                <option value="<?php echo $filas["Id_Prioridad"];?>"><?php echo $filas["DescripcionPrioridad"];?></option><?php } mysqli_free_result($result4); mysqli_close($conexion); ?>
											                </select>
                                                        </div>
                                                </div>
											<nav>
                                                <ul class="pager">
                                                    <li class="previous"><a href="#" class="prevBtn"><span aria-hidden="true">&larr;</span> Anterior</a></li>
                                                    <li class="next"><a href="#" class="nextBtn">Siguiente <span aria-hidden="true">&rarr;</span></a></li>
                                                </ul>
                                            </nav>
                                            <!-- <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Siguiente</button> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row setup-content" id="step-3">
                                    <div class="col-xs-12">
                                        <div class="col-md-12">
                                            <h3> Datos del seguimiento</h3>
											<div class="form-group">
											    <label>Persona encargada</label>
										            <div class="input-group">
                                                        <select id="Encargado" name="Encargado" class="form-control" width="420" style="width: 420px">
                                                            <option value=-1> -- Sin encargado -- </option>
                                                            <?php while($filas = mysqli_fetch_assoc($result7)) { ?>
                                                            <option value="<?php echo $filas["id_Usuario"];?>"><?php echo $filas["Nombre"];?></option><?php } mysqli_free_result($result7); mysqli_close($conexion); ?>
											            </select>
                                                    </div>
										    </div>
											<div class="form-group">
											    <label>Estado del seguimiento</label>
										        <div class="input-group">
                                                    <select id="Seguimiento" name="Seguimiento" class="form-control" width="420" style="width: 420px">
                                                        <option value=-1> -- Seleccione el estado del seguimiento -- </option>
                                                        <?php while($filas = mysqli_fetch_assoc($result5)) { ?>
                                                        <option value="<?php echo $filas["Id_Estado_Seguimiento"];?>"><?php echo $filas["DescripcionEstadoSeguimiento"];?></option><?php } mysqli_free_result($result5); mysqli_close($conexion); ?>
											        </select>
                                                </div>
										    </div>
									        <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input id="chkFinalizado" type="checkbox"/>
                                                        Comenzar seguimiento finalizado en este folio?
                                                    </label>
                                                </div>
                                            </div>
										    <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><strong>Notas d el seguimiento</strong></span>
                                                    <textarea id="NotasSeguimiento" maxlength="300" class="form-control" name="NotasSeguimiento" rows="5" placeholder="Ingrese una nota referente al sequimiento..."></textarea>
                                                </div>
                                            </div>
											<nav>
                                                <ul class="pager">
                                                    <li class="previous"><a href="#" class="prevBtn"><span aria-hidden="true">&larr;</span> Anterior</a></li>
                                                    <button id="fin" class="btn btn-success btn-lg pull-right fin" type="submit">Finalizar!</button>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- / .col-md-12 -->
                    </div><!-- /. row right column -->
	
	                </div><!-- /. box-body -->
	
	            </div><!-- /. box -->
				
	        </section>
		</aside><!-- /.right-side -->
		
    </div><!--/col-span-10-->
		
    </div><!-- /. row -->
	
</div><!-- /. container-fluid -->

<script>
    $( document ).ready(function() {
	
	    $('.next').click(function(){
		    if(validator()){
            $('.nav-tabs > .active').find('a').removeAttr('data-toggle', 'tab');
            $('.nav-tabs > .active').next('li').find('a').attr('data-toggle', 'tab').trigger('click');
			}
        });
		
        $('.back').click(function(){
		    if(validator()){
            $('.nav-tabs > .active').find('a').removeAttr('data-toggle', 'tab');
            $('.nav-tabs > .active').prev('li').find('a').attr('data-toggle', 'tab').trigger('click');
			}
        });
	
	    function validator(){
		
		    var valid = true;
		    $("#error").text("");
		
		    //valida el numero del folio
		     if(!$("#NroFolio").val()){
		        $("#NroFolio").addClass("has-warning");
			    $("#error").text("* Debe introducir el numero del folio n/");
			    valid = false;
		    }else{
		        $("#NroFolio").removeClass("has-warning");
				$("#error").focus();
		    }
		
		    //valida la fecha de creacion del folio
		    if(!$("#dp1").val()){
		        $("#dp1").addClass("has-warning");
			    $("#error").text("* Debe introducir la fecha de creacion del folio");
			    valid = false;
		    }else{
		        $("#da1").removeClass("has-warning");
				$("#error").focus();
		    }
		
		    return valid;
	    }
	
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
		
		$( "#Seguimiento" ).change(function () {
		    var sel = $( "#Seguimiento option:selected" ).text();
			if( sel.indexOf("finalizado") >= 0 || sel.indexOf("terminado") >= 0){
			    if($("#chkFinalizado").prop('checked') == false){
				    $('#chkFinalizado').prop('checked', 'disabled');
					$('#Seguimiento').prop('disabled', true);
                }	    
			}else{
			    if($("#chkFinalizado").prop('checked') == true){
				    $('#chkFinalizado').prop('checked', false);
                }	  
			}
		});
		
		$("#chkFinalizado").change(function () {
		    if($("#chkFinalizado").prop('checked') == true){
			    $('#Seguimiento').prop('disabled', 'disabled');
				$('#Seguimiento').val(5);
			}else{
			    $('#Seguimiento').prop('disabled', false);
				$('#Seguimiento').val(-1);
			}
		});
		
	});
</script>

<script type="text/javascript">
    function DenegarIngreso() {
		    event.returnValue = false;
		}
</script>

<script type="text/javascript" src="js/gestion_folios/crear_folio.js" ></script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>