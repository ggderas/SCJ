<html>
  
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">  
<meta http-equiv="Content-Script-Type" content="text/javascript"> 
<script type="text/javascript" src="js/jquery.js"></script>

<!--funcion para la busqueda de nombre y tipo estudiante-->
<script>
function realizaBusqueda(){
        /*Datos que se enviaran*/
        var parametros = {
                "Identidad" : $("#Identidad").val()
        };
        $.ajax({
                /*Se llama contenido del archivo php, que contiene el proceso de busqueda*/
                data:  parametros,
                url:   'pages/SecretariaAcademica/Tipo_Estudiante/tipoestudiantePL.php',
                type:  'post',
                /*Se recibe resultado del procedimiento almacenado*/
                success:  function (response) {
                        $("#busqueda").html(response);
                            /*El valor devuelto esta concatenado, se utiliza la funcion split para separar contenido*/
                            var element = response.split('*');
                            var elementoInputName = document.getElementById("Nombre");
                            var elementoInputType = document.getElementById("TipoE");
                            /*Se agrega resultado devuelto por procedimiento almacenado a sus respectivos textbox*/
                            elementoInputName.value= element[0];
                            elementoInputType.value= element[1];
                }
        });
}
</script>

<script>
/*Cargar contenido, obtenido por la funcion obtenerTipoEstudiante al cargar pagina*/
$( document ).ready(function()
{
    obtenerTipoEstudiante();
});

/*Funcion que carga el combobox con los tipos existentes en la base de datos*/
function obtenerTipoEstudiante(){
    /*Datos que se enviaran*/
        var parametros  =
    {
        accion : 1
    };
    
    $.ajax
    ({
        /*Se llama contenido del archivo php, que contiene el proceso de cargar datos*/
        type : "POST",
        url: "pages/SecretariaAcademica/Tipo_Estudiante/tipoestudiantePLcmbx.php",
        data: parametros,
        success: function(respuesta)
        {
            /*El valor devuelto es un arreglo*/
            var response = JSON.parse(respuesta);
            var options = '';
            /*Se ingresa cada valor del arreglo, al combobox*/
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
</script>
</head>

<body>
    <!--Elaboracion de interfaz-->
    <form  name="form_TEstudiante" method="post" class="form-horizontal">
        <div class="col-lg-7">
            <div class="panel-body">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class= "panel-heading">
                            Modificar el tipo de estudiante
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