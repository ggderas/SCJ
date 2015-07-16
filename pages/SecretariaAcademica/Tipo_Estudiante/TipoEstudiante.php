

<script>

$(document).ready(function(){

    obtenerTipoEstudiante();

    function realizaBusqueda(){

<html>
  
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">  
<meta http-equiv="Content-Script-Type" content="text/javascript"> 
<script type="text/javascript" src="js/jquery.js"></script>


<script>
function realizaBusqueda(){
        var parametros = {
                "Identidad" : $("#Identidad").val()
        };
        $.ajax({
                data:  parametros,
                url:   'pages/SecretariaAcademica/Tipo_Estudiante/tipoestudiantePL.php',
                type:  'post',
                success:  function (response) {
                        $("#busqueda").html(response);
                            var element = response.split('*');
                            var elementoInputName = document.getElementById("Nombre");
                            var elementoInputType = document.getElementById("TipoE");
                            elementoInputName.value= element[0];
                            elementoInputType.value= element[1];
                }
        });
    }

    function obtenerTipoEstudiante(){

<script>
$( document ).ready(function() 
{
    obtenerTipoEstudiante();
});

function obtenerTipoEstudiante(){
        var parametros  =
        {
            accion : 1
        };
        
        $.ajax
        ({
            type : "POST",
            url: "pages/SecretariaAcademica/Tipo_Estudiante/tipoestudiantePLcmbx.php",
            data: parametros,
            success: function(respuesta)
            {
                var response = JSON.parse(respuesta);
                var options = '';
                
                for (var index = 0;index < response.length; index++) 
                {
                    options += '<option value="' + response[index].codigoTipoEstudiante
                                + '">' + response[index].nombreTipoEstudiante + '</option>';
                }
                
                $("#cmbxNuevoTipoE").append(options);
            }
        });
    }
    /*Funcion que carga el combobox con los tipos existentes en la base de datos*/
    function modificarEstudiante(){
            /*Datos que se enviaran*/
            var parametros = {
                    "Identidad" : $("#Identidad").val(),
                    "cmbxNuevoTipoE": $('#cmbxNuevoTipoE').val()
            };
            $.ajax({
            /*El valor devuelto es un mensaje*/
                    data:  parametros,
                    url:   'pages/SecretariaAcademica/Tipo_Estudiante/tipoestudiantePLmod.php',
                    type:  'post',
                    success:  function (response) {
                            $("#resultado").html(response);
                    }
            });
    }
});
</script>


<div class="panel panel-default" >
    <div class="panel-heading"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Modificar el tipo de estudiante</div>
    <div class="panel-body" > 
        <div class="row" >
            <div class="col-lg-12" >
                <form class="form-horizontal" role="form" id="form" name="form" >
                        <div class="panel-body">
                            <div class="row form-group">
                                <div class="col-sm-8">
                                    <label >Número de Identidad</label>
                                    <input type="text" class="form-control" placeholder="Ejmpl: 0000-0000-00000" required pattern="[0-9]{4}[\-][0-9]{4}[\-][0-9]{5}" name="Identidad" id="Identidad"/>



<script>
function modificarEstudiante(){
        var parametros = {
                "Identidad" : $("#Identidad").val(),
                "cmbxNuevoTipoE": $('#cmbxNuevoTipoE').val()
        };
        $.ajax({
                data:  parametros,
                url:   'pages/SecretariaAcademica/Tipo_Estudiante/tipoestudiantePLmod.php',
                type:  'post',
                success:  function (response) {
                        $("#resultado").html(response);
                }
        });
}
</script>


<script>
function modificarEstudiante(){
        var parametros = {
                "Identidad" : $("#Identidad").val(),
                "cmbxNuevoTipoE": $('#cmbxNuevoTipoE').val()
        };
        $.ajax({
                data:  parametros,
                url:   'pages/SecretariaAcademica/Tipo_Estudiante/tipoestudiantePLmod.php',
                type:  'post',
                success:  function (response) {
                        $("#resultado").html(response);
                }
        });
}
</script>
</head>

<body>
    <form  name="form_TEstudiante" method="post" class="form-horizontal">
        <div class="col-lg-7">
            <div class="panel-body">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class= "panel-heading">
                            <h1 class="box-title">Modificar el tipo de estudiante</h1>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Número de Identidad</label>
                                    <input type="text" class="form-control" autofocus name="Identidad" id="Identidad" placeholder="Ejemplo:0000-0000-00000" required pattern="[0-9]{4}[\-][0-9]{4}[\-][0-9]{5}" title="Este no es un numero de identidad valido"/>
                                    <p align="right">            
                                    <br><button type="button" class="btn btn-primary" href="javascript:;" onclick="realizaBusqueda()" >Verificar</button>
                                    </p>
                                </div>


                            </div>
                            <div class="row form-group">
                                <div class="col-sm-8">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" id="Nombre" disabled="False"/>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-8">
                                    <label>Tipo de estudiante</label>
                                    <input type="text" class="form-control" id="TipoE" disabled="False"/>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-8">
                                    <label>Seleccione nuevo tipo estudiante</label>
                                    <select class="form-control" id="cmbxNuevoTipoE">
                                    </select>
                                </div>    
                            </div>
                        </div>
                        <div class = "row form-group" >
                            <div class="col-sm-8" >
                                <p align = "right"><button onclick="modificarEstudiante()" type="submit" href="javascript:;" class="btn btn-primary">Guardar</button></p>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

=======
>>>>>>> origin/master
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="Nombre" id="Nombre" disabled="False"/>
                                </div>
                                <div class="form-group">
                                    <label>Tipo de estudiante</label>
                                    <input type="text" class="form-control" name="TipoE" id="TipoE" disabled="False"/>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione nuevo tipo estudiante</label>
                                    <select class="form-control" id= "cmbxNuevoTipoE">
                                    </select>
                                </div>
                                <button type="button" class="btn btn-default" href="javascript:;" onclick="modificarEstudiante()" >Guardar</button>
                                <button type="reset" class="btn btn-default" >Cancelar</button>
                                <div id="resultado"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
</html>
