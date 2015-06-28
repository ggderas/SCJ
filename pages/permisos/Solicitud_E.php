<?php
//Este codigo hace una validación de la sesión del usuario y del tiempo que esta lleva inactiva, para proceder a cerrarla
$maindir = "../../";
require_once($maindir . "funciones/check_session.php");

require_once($maindir . "funciones/timeout.php");
?>

<?php
	//Esta seccion obtiene el nombre de usuario que ha iniciado sesión y lo guarda en una variable
	$idEmpleado = $_POST['no_empleado'];
	$idusuario = $_SESSION['user_id'];

	include("../../conexion/conn.php");  
	$conexion = mysqli_connect($host, $username, $password, $dbname);
	$rec = mysqli_query($conexion, "select departamento_laboral.nombre_departamento from departamento_laboral where Id_departamento_laboral in( SELECT Id_departamento FROM empleado where No_Empleado ='$idEmpleado')");
	$row = mysqli_fetch_array($rec);
	//consulta datos del empleado
	
	$rec7 = mysqli_query($conexion, "Select empleado.No_Empleado, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido,empleado.No_Empleado from persona 
			inner join empleado on persona.N_identidad=empleado.N_identidad
			where empleado.No_Empleado ='".$idEmpleado."'");
													
													
	$row7= mysqli_fetch_array($rec7);
	//consulta de cantidad de Dias en el mes 
	$Solicitudes_mes= mysqli_query($conexion, "Select COUNT(permisos.id_Permisos)
	as Solicitudes from permisos where No_Empleado= '".$row7['No_Empleado']."' and MONTH(fecha )= MONTH(NOW()) and YEAR(fecha)=YEAR(NOW())
	 and estado='Aprobado'" );
	$row_solicitud = mysqli_fetch_array($Solicitudes_mes);

	
	//$result = mysqli_query($conexion, "SELECT No_Empleado FROM usuario  where id_Usuario='$idEmpleado'");
	//$row2 = mysqli_fetch_array($result);
	
	//$fquery = mysqli_query($conexion, "select fecha_solicitud, DATE_FORMAT(fecha, '%Y-%m-%d') from permisos inner join usuario on permisos.No_Empleado=usuario.No_Empleado where usuario.No_Empleado='".$row2['No_Empleado']."'");
	//$frow = mysqli_fetch_array($fquery);
?> 


<!--Las siguientes dos líneas hacen referencia a un par de archivos javascript que permite la utilizacion de algunas librerías -->
<!--<script type="text/javascript" src="../SistemaCienciasJuridicas/js/jquery-2.1.3.js"></script>-->
<script>

//Esta función se realiza cuando el documento ya esta listo
    $(document).ready(function() {

        $("form").submit(//Se realiza cuando se ejecuta un "submit" en el formulario, el "submit" se encuentra en el boton "Envíar Solicitud"
		
						function(e) {

							e.preventDefault();
							
								data = {
									idusuario: "<?php echo $idusuario; ?>",
									no_empleado: "<?php echo $idEmpleado; ?>", 
									nombre: $('input:text[name=nombre]').val(),
									area: "<?php echo $row['nombre_departamento']?>",
									motivo: $('select[name=motivo]').val(),
									edificio: $('select[name=edificio]').val(),
									horaf: $("#horaf").val(),
									horai: $("#horai").val(),
									fecha: $("#fecha").val(),
									cantidad: $("#cantidad").val()
								
								};  //la seccion de codigo anterior almacena en un conjunto data las variables que 
								//la funcion enviara para que se ejecute la consulta en el archivo php
							
							$.ajax({
								async: true,
								type: "POST",
								// dataType: "html",
								// contentType: "application/x-www-form-urlencoded",
								url: "../SistemaCienciasJuridicas/pages/permisos/IsolicitudE.php",
								success: llegadaGuardar,
								data: data,
								timeout: 4000,
								error: problemas
							}); //La función implemente ajax para enviar la información a otros 
							//documentos que realizaran otros procedimientos sin necesidad de refrescar toda la pagina
							return false;
						}
						
		
		);
    });

    function llegadaGuardar(datos)
    {
        $("#bt2").fadeOut("slow");
        alert(datos);
        $("#div_contenido").load('pages/permisos/permisos_principal.php', data);
    }



</script>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

<!--<script type="text/javascript" src="../sl/jquery-2.1.3.js"></script>
<script language="javascript" type="text/javascript"></script>-->

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
    </head>

    <body>

       
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Solicitud</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Llene los campos con la información solicitada
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form id="formulario">
                                       
										<div class="form-group">
                                       

												   <?php
													echo " <h5><label>Codigo :  </label>";
													echo strtoupper ($row7['No_Empleado']);
													echo " ";
													echo " <h5><label>Nombre :  </label>";
													
													echo strtoupper ($row7['Primer_nombre']);
													
													echo " ";
													echo strtoupper ($row7['Segundo_nombre']);
													echo " ";
													echo strtoupper ($row7['Primer_apellido']);
													echo " ";
													echo strtoupper ($row7['Segundo_Apellido']);
																									
													//mysqli_close($conexion);
                                                ?>

                                        </div>

                                        <div color: 'black' class="form-group" >
										<?php
											echo "<h5>";
											echo "<label>Departamento:</label>";
											echo " ";
												echo strtoupper ($row['nombre_departamento']);
												echo "</h5>";

										?>											
                                        </div>
											  <div>										 
											
													<?php
											echo "<h5>";
											echo "<label>Dias aprobados este mes:</label>";
											echo " ";
												echo strtoupper ($row_solicitud['Solicitudes']);
												echo "</h5>";

													?>	
                                            
											</div>
                                        <div class="form-group">
                                            <label>Solicito permiso por motivo de :</label>
                                            <select class="form-control" Id="motivo" name="motivo">


											<?php
											/* Este codigo jala los datos que hay en la tabla de motivos y los muestra en el 
											  combobox */
											  
												$rec1 = mysqli_query($conexion, "SELECT descripcion from motivos");
												while ($row = mysqli_fetch_array($rec1)) {
													echo "<option>";
													echo $row['descripcion'];
													echo "</option>";
												}
											?>
											</select>                                       
                                        </div>
										
                                        <div class="form-group">
                                            <label>Edificio donde tiene registrada su asistencia :</label>
                                            <select class="form-control" Id="edificio" name="edificio">
                                                <?php
													$rec2 = mysqli_query($conexion, "SELECT descripcion from edificios");
													while ($row = mysqli_fetch_array($rec2)) {
														echo "<option>";
														echo $row['descripcion'];
														echo "</option>";
													}
													mysqli_close($conexion);
                                                ?>
                                            </select>                                       
                                        </div>
                                        <div>
                                            <label>Cantidad de dias:</label>											 

                                            <p> <input type="number" id="cantidad" name="cantidad" min="0" max="5" value="0" required ></p>
                                        </div>
									
                                        <div>
                                            <label>Fecha:</label>

                                            <p> <input type="date" id="fecha" name="datepicker" required ></p>												
                                        <table>
                                            <tr><label>Hora Inicio:</label>											
                                            <p>	<input type="time" name="horai" min=6:00 max=22:00 step=900 id="horai" value="1:00 pm" required></p>
                                      
                                            <label>Hora Finalización:</label>
                                            <p><input type="time" name="horaf" min=6:00 max=22:00 step=900 id="horaf" value="2:00 pm" required></p>									

                                            <div>
                                                <input id="bt" class="btn btn-primary" type="submit"  value="Enviar Solicitud" /></td>
                                                <div id="respuesta"></div>
                                            </div> </tr>
											</table>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
    </body>
</html>
