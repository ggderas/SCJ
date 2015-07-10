<script >

    $(document).ready(function () {
                $("form").submit(function (e) {
                    e.preventDefault();

                          
                           data2 = {identidad: $("#identidad").val(),
                            solicitud: $("#solicitud").val(),
                            periodo: $("#periodo").val()
                        };
                                            
                        $.ajax({
                            async: true,
                            type: "POST",
                            dataType: "html",
                            contentType: "application/x-www-form-urlencoded",
                            url: "Datos/insertarNuevaSolicitudEstudiante.php",
                            beforeSend: inicioEnvio,
                            success: llegadaGuardar,
                            timeout: 4000,
                            //error: problemas
                        });
                        //limpiarCampos();
                        return false;
                });            
            });

            
             function llegadaGuardar()
            {
                $("#contenedor2").load('Datos/insertarNuevaSolicitudEstudiante.php',data2);
            }
             function inicioEnvio()
            {
                var x = $("#contenedor2");
                x.html('Cargando...');
            }
            
            
            
                        
             $(document).on("focusout","#identidad",function () {
                 
                    id =$("#identidad").val();
                    //alert(id);      
                    //data1 = {id: id};
                    
                    var datos = {id:id}; //Array 
                    $.ajax({
                        async: true,
                        type: "POST",
                        data:datos,
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "Datos/ObtenerDatosEstudiante.php",
                        //beforeSend: inicioVer,
                        success: function(response){
                            
                            var arr = JSON.parse(response);
                            
                            $("#nombre").val(arr[0].nombre);
                            $("#tipoEstudiante").val(arr[0].descripcion);
                        },
                        timeout: 4000,
                        //error: problemas
                    });
                    return false;

             });
             
             
             
             $(document).on("focusout","#identidad",function () {
                 
                    id =$("#identidad").val();
                    //alert(id);      
                    //data1 = {id: id};
                    var datos = 
                        {
                            id:id
                        }; //Array 
                    
                    $.ajax({
                        async: true,
                        type: "POST",
                        data:datos,
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "Datos/ObtenerTipoSolicitud.php",
                        //beforeSend: inicioVer,
                        success: function(response){
                                                       
                            var arr = JSON.parse(response);
                            
                            var options = '';
                            
                            for (var index = 0; index < arr.length; index++) 
                            {
                                var codigoTipoSolicitud = arr[index].codigoTipoSolicitud;
                                var nombreTipoSolicitud = arr[index].nombreSolicitud;
                                
                                options += '<option value="' + codigoTipoSolicitud + '">' +
                                            nombreTipoSolicitud + '</option>';
                            }
                            
                            $("#selectTiposSolicitud").html(options);                                                        
                            
                        },
                        timeout: 4000,
                        //error: problemas
                    });
                    return false;
             });

</script>



<html lang="es">
    <head>
        <title>Gestión de Solicitudes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale=1">
    </head>
    <body>
        <div  id="contenedor2">
            
        </div>                               
            <div class="panel panel-primary">
                <div class="panel-heading"><h2>Solicitud de Estudiante</h2></div>
                
                <div class="panel-body ">
                    <form class="form-horizontal" role="form" id="form" name="form">
                        
                        <div class="row form-group">                                                                                                                     
                            <label class=" col-sm-2 control-label" >Periodo</label>
                            <div class="col-sm-6">                            
                                <select class="form-control" id="solicitud" name="solicitud">
                                    <option value='1'>1</option>
                                    <option value='2'>2</option>
                                    <option value='3'>3</option>
                                    <option value='4'>4</option>
                                    <option value='5'>5</option>
                                </select>
                            </div>                        
                        </div>
                         
                        <div class="row form-group" >                    
                            <label class=" col-sm-2 control-label"id="2" >N° identidad</label>                       
                            <div class="col-sm-6">                            
                                <input type="text" class="form-control" id="identidad" name="identidad" placeholder="Ejmpl: 0000-0000-00000"required>                                
                            </div>                                                                                                                         
                        </div>
                
                        <div class="row form-group">
                            <label class=" col-sm-2 control-label" >Nombre</label>
                            <div class="col-sm-6">                            
                                <input type="text" class="form-control" id="nombre" name="nombre" required disabled="">                                
                            </div>
                        </div>
                
                        <div class="row form-group">
                            <label class=" col-sm-2 control-label" >Tipo estudiante</label>
                            <div class="col-sm-6">                            
                                <input type="text" class="form-control" id="tipoEstudiante" name="tipoEstudiante" required disabled="">                                
                            </div>
                        </div>                
                         
                        <div class="row form-group">
                            <label class=" col-sm-2 control-label" >Solicitud</label>
                            <div class="col-sm-6">                            
                                <select class="form-control" id="selectTiposSolicitud" name="solicitud">
                                 </select>
                            </div>
                        </div>
                       
                        <div class="row">
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-6">
                                <button class="btn btn-primary btn-primary col-sm-offset-10" ><span class=" glyphicon glyphicon-floppy-disk"></span>Guardar</button>           
                            </div>
                            
                        </div>                                                                  
                    </form>
                </div>                                    
            </div>                        
    </body>
</html>
