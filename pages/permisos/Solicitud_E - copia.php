
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
                    <h1 class="page-header">Solicitud para Empleados</h1>
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
													
													echo " <h5><label>Nombre :  </label>";
													echo " ";
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
                                            <p>	<input type="time" name="horai" min=9:00 max=17:00 step=900 id="horai" value="1:00 pm" required></p>
                                      
                                            <label>Hora Finalización:</label>
                                            <p><input type="time" name="horaf" min=9:00 max=17:00 step=900 id="horaf" value="2:00 pm" required></p>									

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
