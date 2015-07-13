<?php
include '../../../conexion/config.inc.php'
?>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
  <script src="scriptsRegistroEstudiantes.js"></script>

  <link href="css/datepicker.css" rel="stylesheet">
  <link href="css/prettify.css" rel="stylesheet">

  <script src="js/prettify.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <!--<script>
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
  </script>-->

  <script type="text/javascript">
    $(document).ready(function() {

      $("form").submit( //Se realiza cuando se ejecuta un "submit" en el formulario, el "submit" se encuentra en el boton "Envíar Solicitud
        function(e) {
          e.preventDefault();
          var data1 = {
            "identidad": $('#identidad').val(),
            "primerNombre": $('#primerNombre').val(),
            "segundoNombre": $('#segundoNombre').val(),
            "primerApellido": $('#primerApellido').val(),
            "segundoApellido": $('#segundoApellido').val(),
            "sexo": $('input[name="sexo"]:checked').val(),
            "fecha": $("#dp1").val(),
            "telefono": $('#telefono').val(),
            "correo": $('#correo').val(),
            "estCivil": $('#estCivil').val(),
            "nacionalidad": $('#nacionalidad').val(),
            "direccion": $('#direccion').val(),
            "ciudadOrigen": $('#ciudadOrigen').val(),
            "residenciaActual": $('#residenciaActual').val(),
            "numeroCuenta": $('#numeroCuenta').val(),

            "tipoEstudiante": $('#tipoEstudiante').val(),
            "planEstudio": $('#planEstudio').val(),
            "unidadesValorativas": $('#unidadesValorativas').val(),
            "aniosEstudio": $('#aniosEstudio').val(),
            "titulo": $('#titulo').val(),
            "orientacion": $('#orientacion').val(),
            "indiceAcademico": $('#indiceAcademico').val(),
            "mencionHonorifica": $('#mencionHonorifica').val()
          };
          $.ajax({
            async: true,
            type: "POST",
            // dataType: "html",
            // contentType: "application/x-www-form-urlencoded",
            url: "pages/SecretariaAcademica/RegistroEstudiantes/RegistrarEstudiante.php",
            data: data1,
            success: function(data) {
              $('#notificaciones').html(data);
            },
            timeout: 4000,
            error: problemasInsertar

          });
          //La función implemente ajax para enviar la información a otros 
          //documentos que realizaran otros procedimientos sin necesidad de refrescar toda la pagina
        });
    });

    function llegadaGuardar(dato) {
      alert("hola");

      $("#notificaciones").html(dato);
    }

    function insertarEstudiante() {
      var x = $("#notificaciones");
      x.html('Cargando...');
    }

    function problemasInsertar() {
      $("#notificaciones").text('Problemas en el servidor.');
    }
  </script>

  <body>
    <form role="form" id="form" method="post" class="form-horizontal" action="pages/SecretariaAcademica/RegistroEstudiantes/RegistrarEstudiante.php">
      <!-- .panel-heading -->
      <div class="panel-body">
        <div class="panel-group" id="accordion">
          <h2>Registro de Estudiante</h2>
          <div class="row">
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
                  <div class="form-group" id="cuenta">
                    <label class="col-sm-5 control-label">
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Número de Cuenta</label>
                    <div class="col-sm-7">
                      <input id="numeroCuenta" class="form-control" name="numeroCuenta" placeholder="Ejemplo: 20011001111" pattern="[0-9]{11}" required>
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
                    <label class="col-sm-5 control-label">
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Segundo Apellido</label>
                    <div class="col-sm-7">
                      <input id="segundoApellido" class="form-control" name="segundoApellido" required>
                    </div>
                  </div>
                  <div class="form-group" id="tel">
                    <label class="col-sm-5 control-label">
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Teléfono</label>
                    <div class="col-sm-7">
                      <input type="tel" id="telefono" class="form-control" name="telefono" placeholder="Ejemplo: 9999-9999" pattern="[0-9]{4}[\-][0-9]{4}" required>
                    </div>
                  </div>
                  <div class="form-group" id="correoE">
                    <label class="col-sm-5 control-label">
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Correo Electrónico</label>
                    <div class="col-sm-7">
                      <input type="email" id="correo" class="form-control" name="correo" pattern="[^ @]*@[^ @]*" placeholder="Ejemplo: correo@server.com" required>
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
                      <input type="date" min="1900-01-01" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask id="dp1" name="fecha" autocomplete="off" class="input-xlarge" format="yyyy-mm-dd" required>
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
                  <div class="form-group" id="nacionalidadOpcion">
                    <label class="col-sm-5 control-label">
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Nacionalidad</label>
                    <div class="col-sm-7">
                      <input id="nacionalidad" class="form-control" name="nacionalidad" required>
                    </div>
                  </div>
                  <div class="form-group" id="lugarOrigenOpcion">
                    <label class="col-sm-5 control-label">
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Lugar de Origen</label>
                    <div class="col-sm-7">
                      <select class="form-control" id="ciudadOrigen" name="ciudadOrigen">
                        <?php
                            $queryLugarOrigen = mysql_query("SELECT * FROM sa_ciudades");
                            while($row = mysql_fetch_assoc($queryLugarOrigen)){
                              echo "<option value='".$row['codigo']."'>".$row['nombre']."</option>";
                            } 
                          ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group" id="residenciaActualOpcion">
                    <label class="col-sm-5 control-label">
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Residencia Actual</label>
                    <div class="col-sm-7">
                      <select class="form-control" id="residenciaActual" name="residenciaActual">
                        <?php
                            $queryResidencia = mysql_query("SELECT * FROM sa_ciudades");
                            while($row = mysql_fetch_assoc($queryResidencia)){
                              echo "<option value='".$row['codigo']."'>".$row['nombre']."</option>";
                            } 
                          ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group" id="direccionOpcion">
                    <label class="col-sm-5 control-label">
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Dirección</label>
                    <div class="col-sm-7">
                      <textarea id="direccion" class="form-control" name="direccion" required></textarea>
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
                    <div class="form-group" id="tipoEstudianteOpcion">
                      <label class="col-sm-6 control-label">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Tipo de Estudiante</label>
                      <div class="col-sm-6">
                        <select class="form-control" id="tipoEstudiante" name="tipoEstudiante">
                          <?php
                            $queryTipoEstudiante = mysql_query("SELECT * FROM sa_tipos_estudiante");
                            while($row = mysql_fetch_assoc($queryTipoEstudiante)){
                              echo "<option value='".$row['codigo']."'>".$row['descripcion']."</option>";
                            } 
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group" id="plan">
                      <label class="col-sm-6 control-label">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Plan de Estudio</label>
                      <div class="col-sm-6">
                        <select class="form-control" id="planEstudio" name="planEstudio">
                          <?php
                            $queryPlanes = mysql_query("SELECT * FROM sa_planes_estudio");
                            while($row = mysql_fetch_assoc($queryPlanes)){
                              echo "<option value='".$row['codigo']."'>".$row['nombre']."</option>";
                            } 
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group" id="unidades">
                      <label class="col-sm-6 control-label">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Unidades Valorativas</label>
                      <div class="col-sm-6">
                        <input type="number" min="1" max="600" value="1" id="unidadesValorativas" class="form-control" name="unidadesValorativas" required>
                      </div>
                    </div>
                    <div class="form-group" id="anios">
                      <label class="col-sm-6 control-label">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Años de Estudio</label>
                      <div class="col-sm-6">
                        <input type="number" min="1" max="30" value="1" id="aniosEstudio" class="form-control" name="aniosEstudio" required>
                      </div>
                    </div>
                    <div class="form-group" id="tituloOpcion">
                      <label class="col-sm-6 control-label">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Título</label>
                      <div class="col-sm-6">
                        <select class="form-control" id="titulo" name="titulo">
                          <?php
                            $queryTitulos = mysql_query("SELECT * FROM titulo");
                            while($row = mysql_fetch_assoc($queryTitulos)){
                              echo "<option value='".$row['id_titulo']."'>".$row['titulo']."</option>";
                            } 
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group" id="orientacionOpcion">
                      <label class="col-sm-6 control-label">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Orientación</label>
                      <div class="col-sm-6">
                        <select class="form-control" id="orientacion" name="orientacion">
                          <?php
                            $queryTitulos = mysql_query("SELECT * FROM sa_orientaciones");
                            while($row = mysql_fetch_assoc($queryTitulos)){
                              echo "<option value='".$row['codigo']."'>".$row['descripcion']."</option>";
                            } 
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group" id="indice">
                      <label class="col-sm-6 control-label">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Índice Académico</label>
                      <div class="col-sm-6">
                        <input type="number" min="0" max="100" step="0.01" value="0.00" id="indiceAcademico" class="form-control" name="indiceAcademico" required>
                      </div>
                    </div>
                    <div class="form-group" id="mencionOpcion">
                      <label class="col-sm-6 control-label">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Mención Honorífica</label>
                      <div class="col-sm-6">
                        <select class="form-control" id="mencionHonorifica" name="mencionHonorifica">
                          <?php
                            $queryMencion = mysql_query("SELECT * FROM sa_menciones_honorificas");
                            while($row = mysql_fetch_assoc($queryMencion)){
                              echo "<option value='".$row['codigo']."'>".$row['descripcion']."</option>";
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
        <button type="submit" id="registrarEstudiante" class="ActualizarB btn btn-primary"> Guardar</button>
      </div>
      </div>
    </form>
  </body>

  </html>