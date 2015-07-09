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
                                <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <label><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Información Estudiantil</label>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Estado civil</label>
                                                    <div class="col-sm-7"><select class="form-control" id="estCivil" name="estCivil">
                                                            <option></option>
                                                            <option>Casado</option>
                                                            <option>Divorciado</option>
                                                            <option>Viudo</option>
                                                        </select></div>
                                                </div>
                                                <div class="form-group" id="correo" >
                                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Correo electrónico</label>
                                                    <div class="col-sm-7"><input id="email" type="email" placeholder="Ejemplo@hotmail.com" class="form-control" name="email" required></div>
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