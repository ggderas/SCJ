<?php
if(!isset($_SESSION))
{
    session_start();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio de sesión</title>

        <link rel="stylesheet" type="text/css" href="css/flatly/flatly.css">

    </head>  
    <body>
        <div class="page-header"></div>
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Inicio de sesión</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" id="formInicioSesion">
                        <fieldset>
                            <div class="form-group" id="divtxtNombreUsuario">
                                <label for="txtNombreUsuario" class="col-lg-3 control-label">Nombre de usuario</label>
                                <div class="col-lg-9">
                                    <input onchange="txtNombreUsuarioEsValido = validaTamano(this.id, 100)" type="text" class="form-control" id="txtNombreUsuario" name="txtNombreUsuario" placeholder="Escribe tu usuario">
                                </div>
                            </div>             
                            <div class="form-group"id="divtxtPassword">
                                <label for="inputClave" class="col-lg-3 control-label">Clave</label>
                                <div class="col-lg-9">
                                    <input onchange="txtPasswordEsValido = validaTamano(this.id, 100)" type="password" class="form-control" name="txtPassword"  id="txtPassword" placeholder="Escribe tu clave">
                                </div>
                                
                                <label for="inputClave" class="col-lg-3 control-label"></label>
                                <div class="col-lg-9">
                                    <p id="txtMensajeError" class="text-danger hidden"><strong>Usuario o clave incorrecta</strong></p>
                                </div>                                
                                
                            </div>                            
                            <div class="form-group">
                                <label class="col-lg-3 control-label"></label>
                                <div class="col-lg-9">
                                    <button onclick="iniciarSesion()" type="button" class="btn btn-info">Ingresar</button>                                    
                                </div>
                            </div>                             
                        </fieldset>
                    </form>
                </div>
            </div>            
        </div>
        <div class="col-lg-3"></div>                    
        
        
        <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="css/bootstrap/bootstrap.min.js"></script>
        
        <script type="text/javascript" src="js/js_index.js"></script>
        
        
    </body>
</html>
