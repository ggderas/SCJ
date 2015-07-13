<<<<<<< HEAD
<html lang="es">
    <head></head>
=======
<link href="css/datepicker.css" rel="stylesheet">
<link href="css/prettify.css" rel="stylesheet">
   
<script src="js/prettify.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
>>>>>>> ClaudioPaz
    <body>
          <form role="form" id="form" method="post" class="form-horizontal" action="#">
            <!-- .panel-heading -->
            <div class="panel-body">
<<<<<<< HEAD
                <h1>Información Personal de Docentes</h1></br>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-primary">
=======
                <h1>Nuevo Docente</h1></br>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
>>>>>>> ClaudioPaz
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <label><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Datos Generales del Docente</label>
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Número de Identidad</label>
                                    <div class="col-sm-7"><input id="identidad" class="form-control" name="identidad" required pattern="[0-9]{4}[\-][0-9]{4}[\-][0-9]{5}"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Primer nombre</label>
                                    <div class="col-sm-7"><input id="primerNombre" class="form-control" name="primerNombre" required></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label">Segundo nombre</label>
                                    <div class="col-sm-7"><input id="segundoNombre" class="form-control" name="segundoNombre" ></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Primer Apellido</label>
                                    <div class="col-sm-7"><input id="primerApellido" class="form-control" name="primerApellido" required></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Segundo Apellido</label>
                                    <div class="col-sm-7"><input id="segundoApellido" class="form-control" name="segundoApellido" ></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Telefono</label>
                                    <div class="col-sm-7"><input id="telefono" class="form-control" name="telefono" required pattern="[0-9]{4}[\-][0-9]{4}[\-][0-9]{5}"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Titulo</label>
<<<<<<< HEAD
                                    <div class="col-sm-7"><input id="titulo" class="form-control" name="titulo">Titulo</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Titulo</label>
                                    <div class="col-sm-7"><input id="CiudadNatal" class="form-control" name="ciudadNatal">Ciudad Natal</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Titulo</label>
                                    <div class="col-sm-7"><input id="Correo" class="form-control" name="correo">Correo Eletronico</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Sexo</label>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Nacionalidad</label>
                                    <div class="col-sm-7"><input id="nacionalidad" class="form-control" name="nacionalidad"  required></div>
=======
                                    <div class="col-sm-7"><input id="titulo" class="form-control" name="titulo"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Ciudad Natal</label>
                                    <div class="col-sm-7"><input id="CiudadNatal" class="form-control" name="ciudadNatal"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Correo Electronico</label>
                                    <div class="col-sm-7"><input id="Correo" class="form-control" name="correo"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Sexo</label>
                                    <input type="radio" name="sex" value="male">Masculino<br>
                                    <input type="radio" name="sex" value="female">Feminino
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Nacionalidad</label>
                                    <div class="col-sm-7"><select class="form-control" id="nacionalidad" name="nacionalidad"></select>
                                        <br>
>>>>>>> ClaudioPaz
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><strong><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Fecha de Nacimiento</strong></label>
                                    <div class="col-sm-7"><input id="fecha" type="date" name="fecha" autocomplete="off" class="input-xlarge" format="yyyy-mm-dd" required><br></div>
<<<<<<< HEAD
=======
                                    
>>>>>>> ClaudioPaz
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Estado civil</label>
                                    <div class="col-sm-7"><select class="form-control" id="estCivil" name="estCivil">
                                        </select>
                                                
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </br><button type="submit" id="actualizar" class="ActualizarB btn btn-primary">Guardar Información</button>
        </div>
        </form>
    </body>
<<<<<<< HEAD
</html>
=======
>>>>>>> ClaudioPaz
