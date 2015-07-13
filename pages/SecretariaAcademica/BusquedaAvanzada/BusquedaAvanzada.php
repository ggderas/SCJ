<script>


$( document ).ready(function() 
{
    obtenerTipoSolicitud();
});

$('#filtrar').click(function(event) {
   event.preventDefault();
   
   var datos =  {
      "nIdentidad": $('#nIdentidad').val(),
      "fecha":$('fecha').val(),
      "tipoSolicitud":$('cmbTipoSolicitud').val()
   };
    $.ajax({
        async: true,
        type: "POST",
        // dataType: "html",
        // contentType: "application/x-www-form-urlencoded",
        url: "pages/SecretariaAcademica/BusquedaAvanzada/ajax_busquedaAvanzada.php",
        data: datos,
        success: function(data){
            var response = JSON.parse(data);
            var options = '';

            for (var index = 0;index < response.length; index++) 
            {
               options += "<tr>" +
                                "<td>" + response[index].numeroIdentidad + "</td>" +
                                "<td>" + response[index].Nombre + "</td>" +
                                "<td>" + response[index].numeroCuenta + "</td>" +
                                "<td>" + response[index].indiceAcademico + "</td>" +
                                "<td>" + response[index].tipoEstudiante + "</td>" +
                                "<td>" + response[index].tipoSolicitud + "</td>" +
                                "<td>" + response[index].fecha + "</td>" +                    
                          "</tr>";
            }

            $('#cuerpoTabla').append(options);
        },
        timeout: 4000,
        beforeSend: antesdemandar
    });

});

function antesdemandar(){
  var x = $("#notificaciones");
  x.html('Cargando...');
}


// Habilita y deshabilita los inputs

function cambiarEstadoInput(codigoInput)
{
    var htmlElement = document.getElementById(codigoInput);
    
    if(htmlElement.disabled)
    {
        htmlElement.disabled = false;
    }
    else
    {
        htmlElement.disabled = true;
    }
}


function obtenerTipoSolicitud()
{
    var parametros  =
    {
        accion : 1
    };
    
    $.ajax
    ({
      // mandamos estos el jason a la direcion especificada.
        type : "POST",
        url: "pages/SecretariaAcademica/BusquedaAvanzada/ajax_busquedaAvanzada.php",
        data: parametros,
        success: function(respuesta) // En esta recibimos el json enviado como respuesta en el formulario anterior.
        {
            var response = JSON.parse(respuesta);
            var options = '';
            
            for (var index = 0;index < response.length; index++) 
            {
                options += '<option value="' + response[index].codigoTipoSolicitud
                            + '">' + response[index].nombreTipoSolicitud + '</option>';
            }
            
            $("#cmbTipoSolicitud").append(options);
        }
    });
}

</script>
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
            $('#txtFechaSolicitud').datepicker({
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

 <div class="panel panel-primary">
   <div class="panel-heading">
      <h4 class="panel-title">
          <label><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Busqueda avanzada</label>
      </h4>
   </div>
   <div class = "panel-body">
   <br>
   <br>
   <div id = "notificaciones"></div>
<section onload="">
  <div class = "col-sm-12">
    
          <div class="row">
              <div class="col-lg-3">
                  <label>
                      <input id = "nIdentidad" required pattern="[0-9]{4}[\-][0-9]{4}[\-][0-9]{5}" placeholder="Ejemplo:0000-0000-00000" onchange="cambiarEstadoInput('txtNumeroIdentidad')" type="checkbox"> Número de identidad
                  </label>    
              </div>
              <div class="col-lg-9">
                  <input pattern="[0-9]{4}[\-][0-9]{4}[\-][0-9]{5}" placeholder="Ejemplo:0000-0000-00000" disabled="true" class="form-control" id="txtNumeroIdentidad" type="text">        
              </div>      
          </div>
          <br/>
          <div class="row">
                <div class="col-lg-3">
                    <label>
                        <input id= "fecha" onchange="cambiarEstadoInput('txtFechaSolicitud')" type="checkbox"> Fecha de solicitud
                    </label>    
                </div>
                <div class="col-lg-9">
                    <input disabled="true" data-inputmask="'alias': 'dd/mm/yyyy'" format="yyyy-mm-dd" class="form-control" id="txtFechaSolicitud" placeholder="yyyy-mm-dd" type="date">        
                </div>      
          </div> 
          <br/>
          <div class="row">
              <div class="col-lg-3">
                  <label>
                      <input id = "tipoSolicitud"  onchange="cambiarEstadoInput('cmbTipoSolicitud')" type="checkbox"> Tipo de solicitud
                  </label>    
              </div>
              <div class="col-lg-9">
                <div class="form-group">
                    <select disabled="true" class="form-control" id="cmbTipoSolicitud">
                        <option value="NULL">Seleccione una opción</option>
                    </select>
                </div>          
              </div>      
          </div>
          <p align="right">
            <button id="filtrar" class="ActualizarB btn btn-primary">Filtrar</button>
          </p>

        <!-- Creamos la tabla para mostrar las solicitudes -->
      <div class="box-body table-responsive ">
         <table id = "tablaBusquedaAvanzada" class='table table-bordered table-striped display' cellspacing="0" >
            <thead >
              <tr>
                <th>Identidad</th>
                <th>Nombre</th>
                <th>Nº Cuenta</th>
                <th>Indice Academico</th>
                <th>Tipo Estudiante</th>
                <th>Tipo de solicitud</th>
                <th>Fecha de solicitud</th>
              </tr>
            </thead>
            <tbody id = "cuerpoTabla">
              
            </tbody>
          </table>
      </div>
    </div>
    <button type="submit" id="CrearPDF" class="ActualizarB btn btn-primary">Generar reporte</button>
  </section>
  </div>
</div>


