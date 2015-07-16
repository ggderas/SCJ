
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

//Se realiza cuando se ejecuta un "submit" en el formulario, el "submit" se encuentra en el boton "Registrar Docente"
        $("form").submit(
            function(e) {
                e.preventDefault();    
                var data1 = {
                        "identidad":$('#identidad').val(),
                        "primerNombre":$('#primerNombre').val(),
                        "segundoNombre":$('#segundoNombre').val(),
                        "primerApellido":$('#primerApellido').val(),
                        "segundoApellido":$('#segundoApellido').val(),
                        "sexo":$('input[name="sexo"]:checked').val(),
                        "fecha":$("#dp1").val(),
                        "telefono":$('#telefono').val(),
                        "email":$('#correo').val(),
                        "estCivil":$('#estCivil').val(),
                        "nacionalidad":$('#nacionalidad').val(),
                        "direccion": $('#direccion').val(),
                        "nempleado": $('#nempleado').val()
                    };
                $.ajax({
                    async: true,
                    type: "POST",
                    url: "pages/CargaAcademica/RegistroDocentes/RegistrarDocente.php",
                    data: data1,
                    success: function(data){
                        alert("dasd");
                        $('#notificaciones').html(data);
                        $("#notificaciones").fadeOut(1500);
                    },
                    timeout: 4000,
                    error: problemasInsertar
                    
                }); 
                /*Esta funcion permite enviar parametros a otro archivo.php sin necesidada
                 de recargar toda la pag*/
            });
        });
        //Funcion para Introducir el mensaje dentro de un div que muestra la respuesta del servidor
        function llegadaGuardar(dato)
        {
            $("#notificaciones").html(dato);
        }
        //Esta funcion permite mostrar un mensaje antes de que el servidor acepte la solicitud
        function insertarDocente()
        {
            var x = $("#notificaciones");
            x.html('Cargando...');
        }
        // Se levanta en caso de haber un error no contemplado

        function problemasInsertar()
        {
            $("#notificaciones").text('Problemas en el servidor.');
        }

    
</script>
<!-- Seccion en la cual agrego la funcion para poder mostrar un seleccionador de fecha 
     para el usuario -->
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

<!-- Fin de la seecion de seleccionador de fecha -->
<!-- Inicio formulario para recorger datos -->
            <body>
                  <form role="form" id="form" method="post" class="form-horizontal" action="pages/CargaAcademica/RegistroDocentes/RegistrarDocente.php">
                    <!-- .panel-heading -->
                    <div class="panel-body">
                        <h1>Información Personal de Docentes</h1></br>
                        <div class="panel-group" id="accordion">
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
                                                <div class="form-group" id="empleado">
                                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Número de empleado</label>
                                                    <div class="col-sm-7"><input type = "number" id="nempleado" class="form-control" name="nempleado"></div>
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
                                                    <div class="col-sm-7"><input type= "tel" id="telefono" class="form-control" name="telefono" placeholder="Ejemplo:00-00-00-00" required pattern="[0-9]{2}[\-][0-9]{2}[\-][0-9]{2}[\-][0-9]{2}" required></div>
                                                </div>
                                                <div class="form-group" id="divCorreo">
                                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Correo</label>
                                                    <div class="col-sm-7"><input type= "text" id="correo" class="form-control" name="correo" pattern="[^ @]*@[^ @]*" required></div>
                                                </div>

                                                <div class="form-group" id="sexoOpcion" name="sex">
                                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Sexo</label>
                                                    <div class="col-sm-7">
                                                        <input type="radio" name="sexo" id="sexo" value="F" >&nbsp;Femenino 
                                                        <br>
                                                        <input type="radio" name="sexo" id="sexo" value="M" checked>&nbsp;Masculino
                                                    </div>
                                                </div>
                                                <div class="form-group" id="nacio">
                                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Nacionalidad</label>
                                                    <div class="col-sm-7"><input id="nacionalidad" class="form-control" name="nacionalidad" required></div>
                                                </div>
                                                <div class="form-group" id="direc">
                                                    <label class="col-sm-5 control-label"> Dirección</label>
                                                    <div class="col-sm-7"><input id="direccion" class="form-control" name="ciudadNatal"></div>
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
                                <!-- Div necesario para mostrar los posibles errores levantados por el servidor
                                de bases ded datos -->
                                <div id= "notificaciones"></div>
                                <div id= "noti1" class="alert alert-info" role="alert">IMPORTANTE: Los campos marcados con el signo <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> son obligatorios.</div>
                            </br><button type="submit" id="CrearDocente" class="ActualizarB btn btn-primary">Guardar Información</button>
                        </div>
                    </div>
                </form>
            </body>

