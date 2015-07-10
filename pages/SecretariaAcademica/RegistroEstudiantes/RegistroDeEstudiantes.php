<?php
include '../../../Datos/conexion.php'
?>
<script type="text/javascript" src="js/jquery.js">
</script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script src="scriptsRegistroEstudiantes.js"></script>

<link href="css/datepicker.css" rel="stylesheet">
<link href="css/prettify.css" rel="stylesheet">

<script src="js/prettify.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script>
  if (top.location != location) {
    top.location.href = document.location.href;
  }
  $(function() {
    window.prettyPrint && prettyPrint();
    $('#dp1').datepicker({
      format: 'yyyy-mm-dd',
      language: "es",
      autoclose: true,
      todayBtn: true
    }).on('show', function() {
      var zIndexModal = $('#myModal').css('z-index');
      var zIndexFecha = $('.datepicker').css('z-index');
      $('.datepicker').css('z-index', zIndexModal + 1);
    }).on('changeDate', function(ev) {
      $('#dp1').datepicker('hide');
    });

  });
</script>

<script>
  $(document).ready(function(){

  }
</script>

<body>
  <form role="form" id="form" method="post" class="form-horizontal" action="pages/SecretariaAcade/RegistroDocentes/RegistrarDocente.php">
    <!-- .panel-heading -->
    <div class="panel-body">
      <div class="panel-group" id="accordion">
        <h2>Registro de Estudiante</h2>
        <div class="row">
          <div class="panel-group" id="accordion">
            <div class="col-md-6">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <label>
                      <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Datos Generales del Estudiante</label>
                  </h4>
                </div>
                <div class="panel-body">
                  <!--<div>-->
                    <div class="form-group" id="identi">
                      <label class="col-sm-5 control-label">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Número de Identidad</label>
                      <div class="col-sm-7">
                        <input id="identidad" class="form-control" name="identidad" placeholder="Ejemplo: 0000-0000-00000" pattern="[0-9]{4}[\-][0-9]{4}[\-][0-9]{5}" required>
                      </div>
                    </div>
                    <div class="form-group" id="primerN">
                      <label class="col-sm-5 control-label">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Primer nombre</label>
                      <div class="col-sm-7">
                        <input id="primerNombre" class="form-control" name="primerNombre" required>
                      </div>
                    </div>
                    <div class="form-group" id="Snombre">
                      <label class="col-sm-5 control-label"> Segundo nombre</label>
                      <div class="col-sm-7">
                        <input id="segundoNombre" class="form-control" name="segundoNombre">
                      </div>
                    </div>
                    <div class="form-group" id="pApellido">
                      <label class="col-sm-5 control-label">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Primer Apellido</label>
                      <div class="col-sm-7">
                        <input id="primerApellido" class="form-control" name="primerApellido" required>
                      </div>
                    </div>
                    <div class="form-group" id="sApellido">
                      <label class="col-sm-5 control-label"> Segundo Apellido</label>
                      <div class="col-sm-7">
                        <input id="segundoApellido" class="form-control" name="segundoApellido">
                      </div>
                    </div>
                    <div class="form-group" id="tel">
                      <label class="col-sm-5 control-label">
                        <span aria-hidden="true"></span> Teléfono</label>
                      <div class="col-sm-7">
                        <input id="telefono" class="form-control" name="telefono" placeholder="Ejemplo: 9999-9999" pattern="[0-9]{4}[\-][0-9]{4}">
                      </div>
                    </div>
                    <div class="form-group" id="correoE">
                      <label class="col-sm-5 control-label">
                        <span aria-hidden="true"></span> Correo Electrónico</label>
                          <div class="col-sm-7">
                            <input type="email" id="correo" class="form-control" name="correo" pattern="[^ @]*@[^ @]*" placeholder="Ejemplo: correo@server.com">
                          </div>
                      </div>
                    <!--</div>-->
                    <div class="form-group" id="sexoOpcion" name="sex">
                      <label class="col-sm-5 control-label">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Sexo</label>
                      <div class="col-sm-7">
                        <input type="radio" name="sexo" id="sexoFem" value="F" checked>&nbsp;Femenino
                        <br>
                        <input type="radio" name="sexo" id="sexoMas" value="M">&nbsp;Masculino
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-5 control-label" data-link-field="dtp_input2">
                        <strong>
                          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Fecha de Nacimiento</strong>
                      </label>
                      <div class="date form_date col-md-5">
                        <input type="date" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask id="dp1" name="fecha" autocomplete="off" class="input-xlarge" format="yyyy-mm-dd" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-5 control-label">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Estado civil</label>
                      <div class="col-sm-7">
                        <select class="form-control" id="estCivil" name="estCivil">
                          <option>Soltero</option>
                          <option>Casado</option>
                          <option>Divorciado</option>
                          <option>Viudo</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group" id="lugarOrigenOpcion">
                      <label class="col-sm-5 control-label">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Lugar de Origen</label>
                      <div class="col-sm-7">
                        <select class="form-control" id="lugar" name="lugarDeOrigen">
                          <?php
                            $queryLugarOrigen = mysql_query("SELECT nombre FROM sa_ciudades");
                            while($row = mysql_fetch_assoc($queryLugarOrigen)){
                              echo "<option>".$row['nombre']."</option>";
                            } 
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group" id="residenciaActualOpcion">
                      <label class="col-sm-5 control-label">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Residencia Actual</label>
                      <div class="col-sm-7">
                        <select class="form-control" id="residencia" name="residenciaActual">
                          <?php
                            $queryResidencia = mysql_query("SELECT nombre FROM sa_ciudades");
                            while($row = mysql_fetch_assoc($queryResidencia)){
                              echo "<option>".$row['nombre']."</option>";
                            } 
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <label>
                      <span class="glyphicon glyphicon-book" aria-hidden="true"></span> Información Académica</label>
                  </h4>
                </div>
                <div class="panel-body">
                  <div>
                    <div class="form-group" id="tipoEstudiante">
                      <label class="col-sm-5 control-label">
                        <span aria-hidden="true"></span> Tipo de Estudiante</label>
                      <div class="col-sm-7">
                        <select class="form-control" id="tipoEstudiante" name="tipoEstudiante">
                          <?php
                            $queryTipoEstudiante = mysql_query("SELECT descripcion FROM sa_tipos_estudiante");
                            while($row = mysql_fetch_assoc($queryTipoEstudiante)){
                              echo "<option>".$row['descripcion']."</option>";
                            } 
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group" id="plan">
                      <label class="col-sm-5 control-label">
                        <span aria-hidden="true"></span> Plan de Estudio</label>
                      <div class="col-sm-7">
                        <select class="form-control" id="planEstudio" name="planDeEstudio">
                          <?php
                            $queryPlanes = mysql_query("SELECT nombre FROM sa_planes_estudio");
                            while($row = mysql_fetch_assoc($queryPlanes)){
                              echo "<option>".$row['nombre']."</option>";
                            } 
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group" id="unidades">
                      <label class="col-sm-5 control-label">
                        <span aria-hidden="true"></span> Unidades Valorativas</label>
                      <div class="col-sm-7">
                        <input type="number" min="1" max="600" value="1" id="unidadesValorativas" class="form-control" name="unidadesValorativas" required>
                      </div>
                    </div>
                    <div class="form-group" id="anios">
                      <label class="col-sm-5 control-label"> Años de Estudio</label>
                      <div class="col-sm-7">
                        <input type="number" min="1" max="100" value="1" id="aniosEstudio" class="form-control" name="aniosDeEstudio">
                      </div>
                    </div>
                    <div class="form-group" id="titulo">
                      <label class="col-sm-5 control-label">
                        <span aria-hidden="true"></span> Título</label>
                      <div class="col-sm-7">
                        <select class="form-control" id="titulo" name="titulo">
                          <?php
                            $queryTitulos = mysql_query("SELECT titulo FROM titulo");
                            while($row = mysql_fetch_assoc($queryTitulos)){
                              echo "<option>".$row['titulo']."</option>";
                            } 
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group" id="indice">
                      <label class="col-sm-5 control-label"> Índice Académico</label>
                      <div class="col-sm-7">
                        <input type="number" min="0" max="100" step="0.01" value = "0.00"id="indiceAcademico" class="form-control" name="indiceAcademico">
                      </div>
                    </div>
                    <div class="form-group" id="mencion">
                      <label class="col-sm-5 control-label">
                        <span aria-hidden="true"></span> Mención Honorífica</label>
                      <div class="col-sm-7">
                        <select class="form-control" id="mencionHonorifica" name="mencionHonorifica">
                          <?php
                            $queryMencion = mysql_query("SELECT descripcion FROM sa_menciones_honorificas");
                            while($row = mysql_fetch_assoc($queryMencion)){
                              echo "<option>".$row['descripcion']."</option>";
                            } 
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="notificaciones"></div>
        <div id="noti1" class="alert alert-info" role="alert">IMPORTANTE: Los campos marcados con el signo
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> son obligatorios.</div>
        </br>
        <button type="submit" id="registrarEstudiante" class="ActualizarB btn btn-primary"> Guardar</button>
      </div>
    </div>
  </form>

</body>

</html>
