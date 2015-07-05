
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $("form").submit(//Se realiza cuando se ejecuta un "submit" en el formulario, el "submit" se encuentra en el boton "Envíar Solicitud
            function(e) {
                e.preventDefault();
                var peticion = $('form').attr('action');
                data = {
                    identidad:$('#identidad').val(),
                    primerNombre:$('#primerNombre').val(),
                    segundoNombre:$('#segundoNombre').val(),
                    primerApellido:$('#primerApellido').val(),
                    segundoApellido:$('#segundoApellido').val(),
                    sexo:document.querySelector('input[name="sexo"]:checked').value,
                    fecha:$('#fecha').val(),
                    telefono:$('#telefono').val(),
                    email:$('#correo').val(),
                    estCivil:$('#estCivil').val(),
                    nacionalidad:$('#nacionalidad').val(),
                    ciudadNatal: $('#ciudadNatal').val(),
                }
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    url: peticion,
                    success: llegadaGuardar(data),
                    beforeSend: insertarDocente,
                    timeout: 4000,
                    error: problemasInsertar
                    
                }); 
                //La función implemente ajax para enviar la información a otros 
                //documentos que realizaran otros procedimientos sin necesidad de refrescar toda la pagina
            });
        });
        function llegadaGuardar(datos)
        {
            $("#notificaciones").html(datos);
        }

        function insertarDocente()
        {
            var x = $("#notificaciones");
            x.html('Cargando...');
        }

        function problemasInsertar()
        {
            $("#notificaciones").text('Problemas en el servidor.');
        }
    
</script>

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

            <body>
                  <form role="form" id="form" method="post" class="form-horizontal" action="pages/CargaAcademica/RegistroDocentes/RegistrarDocente.php">
                    <!-- .panel-heading -->
                    <div class="panel-body">
                        <h1>Información Personal de Docentes</h1></br>
                        <div class="panel-group" id="accordion">
                                <h1>Nuevo Docente</h1></br>
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <label><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Datos Generales del Docente</label>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-lg-8">
                                                <div class="form-group" id="identi">
                                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Número de Identidad</label>
                                                    <div class="col-sm-7"><input id="identidad" class="form-control" name="identidad" placeholder="Ejemplo:0000-0000-00000" required pattern="[0-9]{4}[\-][0-9]{4}[\-][0-9]{5}"></div>
                                                </div>
                                                <div class="form-group" id="primerN">
                                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Primer nombre</label>
                                                    <div class="col-sm-7"><input id="primerNombre" class="form-control" name="primerNombre" required></div>
                                                </div>
                                                <div class="form-group" id="Snombre">
                                                    <label class="col-sm-5 control-label"> Segundo nombre</label>
                                                    <div class="col-sm-7"><input id="segundoNombre" class="form-control" name="segundoNombre"></div>
                                                </div>
                                                <div class="form-group" id="pApellido">
                                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Primer Apellido</label>
                                                    <div class="col-sm-7"><input id="primerApellido" class="form-control" name="primerApellido" required></div>
                                                </div>
                                                <div class="form-group" id="sApellido">
                                                    <label class="col-sm-5 control-label"> Segundo Apellido</label>
                                                    <div class="col-sm-7"><input id="segundoApellido" class="form-control" name="segundoApellido"></div>
                                                </div>
                                                 <div class="form-group" id="tel">
                                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Telefono</label>
                                                    <div class="col-sm-7"><input id="telefono" class="form-control" name="telefono" required></div>
                                                </div>
                                                <div class="form-group" id="correo">
                                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Correo</label>
                                                    <div class="col-sm-7"><input id="correo" class="form-control" name="correo" required></div>
                                                </div>
                                                <div class="form-group" id="sexoOpcion" name="sex">
                                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Sexo</label>
                                                    <div class="col-sm-7">
                                                        <input type="radio" name="sexo" id="sexoFem" value="F" checked>&nbsp;Femenino 
                                                        <br>
                                                        <input type="radio" name="sexo" id="sexoMas" value="M">&nbsp;Masculino
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Ciudad Natal</label>
                                                    <div class="col-sm-7"><input id="CiudadNatal" class="form-control" name="ciudadNatal"></div>

                                                <div class="form-group" id="nacio">
                                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Nacionalidad</label>
                                                    <div class="col-sm-7"><input id="nacionalidad" class="form-control" name="nacionalidad" required></div>
                                                </div>
                                                <div class="form-group" id="cnatal">
                                                    <label class="col-sm-5 control-label"> Ciudad Natal</label>
                                                    <div class="col-sm-7"><input id="ciudadNatal" class="form-control" name="ciudadNatal"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label" data-link-field="dtp_input2"><strong><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Fecha de Nacimiento</strong></label>
                                                    <div class="date form_date col-md-5"><input type="date" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask id="dp1" name="fecha" autocomplete="off" class="input-xlarge" format="yyyy-mm-dd" required><br></div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Estado civil</label>
                                                    <div class="col-sm-7"><select class="form-control" id="estCivil" name="estCivil">
                                                            <option>Soltero</option>
                                                            <option>Casado</option>
                                                            <option>Divorciado</option>
                                                            <option>Viudo</option>
                                                        </select></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id= "notificaciones"></div>
                                <div id= "noti1" class="alert alert-info" role="alert">IMPORTANTE: Los campos marcados con el signo <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> son obligatorios.</div>
                            </br><button type="submit" id="CrearDocente" class="ActualizarB btn btn-primary">Guardar Información</button>
                        </div>
                    </div>
                </form>
            </body>
</html>

