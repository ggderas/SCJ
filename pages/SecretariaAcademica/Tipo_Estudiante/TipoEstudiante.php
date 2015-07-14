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
</script>

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