<html>

<head>
<script type="text/javascript" src="js/jquery.js"></script>

<script>
$( document ).ready(function() 
{
    obtenerTipoEstudiante();
});

function realizaProceso(valorInput){
        var parametros = {
                "Identidad" : $("#Identidad").val()
        };
        $.ajax({
                data:  parametros,
                url:   'pages/SecretariaAcademica/Tipo_Estudiante/tipoestudiantePL.php',
                type:  'post',
                success:  function (response) {
                        $("#resultado").html(response);
                        var element = response.split('/');
                        var elementoInputName = document.getElementById("Nombre");
                        var elementoInputType = document.getElementById("TipoE");
                        elementoInputName.value= element[0];
                        elementoInputType.value= element[1];
                }
        });
}
</script>

<script>

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
</head>

<body>
<div class="container">
	<div class="Row">
		<div class="col-md-6">
			<form  name="form_TEstudiante" method="post">
				<div class="row">
				    <div class="col-lg-12">
				        <h1 class="page-header">Modificar el tipo de estudiante</h1>
				    </div>
			    </div>
				<div class="panel-body">
					<div class="form-group">
						<label >Número de Identidad</label>
						<input type="text" class="form-control" autofocus name="Identidad" id="Identidad" placeholder="Ejemplo:0000-0000-00000"/>
						<button type="button" class="btn btn-primary" href="javascript:;" onclick="realizaProceso($('#Identidad').val());return false;" >Verificar</button>
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
						<select class="form-control" id="cmbxNuevoTipoE">
						</select>
					</div>
					<button type="submit" class="btn btn-default">Guardar</button>
					<button type="button" class="btn btn-default">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
