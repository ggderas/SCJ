
<script type="text/javascript">
   /* Script que permite cargar todos los elementos de la tabla para mostrar los datos que estan
    Almacenados en la base de datos */
$(document).ready(function() {

    cargarPlanes(); //Hacemos el llamado para que se cargue la tabla siempre que se cargue la pag.

    /* Este evento se levanta cada vez que le damos click al bottton eliminar */
    $(document).on("click",".elimina",function () {
             
        var respuesta = confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
        if (respuesta)
        {
            var id = $(this).data('id');

            var data = 
            {
                codigo: id
            };
            $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                data: data,
                contentType: "application/x-www-form-urlencoded",
                success: function(data){
                    $("#notificaciones1").html(data);
                    $("#notificaciones1").fadeOut(1500);
                    cargarPlanes();
                },
                url: "pages/SecretariaAcademica/Mantenimiento/PlanesEstudio/eliminarPlan.php",
                timeout: 4000
            });
        }                 
    });


 /* Este evento se levanta cuando se le da click a el boton de editar */
   $(document).on("click",".editar",function (e){
        e.preventDefault();
        $("#Mdiv_editarPlanes").html("");
        var datos = { 
            
            id:  $(this).data('id') 
        };
        $.ajax({
            async: true,
            type: "POST",
            url: "pages/SecretariaAcademica/Mantenimiento/PlanesEstudio/actualizarPlanes.php",
            data: datos,
            dataType: "html",
            success: function(data){
                var response = JSON.parse(data);
                var options = '';
                /* En esta seccion llenamos los datos que se van a editar el modal*/ 
                for (var index = 0;index < response.length; index++) 
                {
                   options +=   '<div class="form-group">'+
                                    '<label>Codigo del Plane de estudio</label>'+
                                    '<input id="codPlan" disabled = "true" data-id="' + response[index].codPlan + '" placeholder="' + response[index].codPlan + '" class="form-control">'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<label>Nombre del Plan de estudio</label>'+
                                    '<input id="nombrePlan1" placeholder="'+response[index].nombrePlan+'" class="form-control">'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<label>Unidades Valorativas</label>'+
                                    '<input id="uvPlan" placeholder="'+response[index].uvPlan+'" class="form-control">'+
                                '</div>';
                }
                /* Insertamos dentro del div del modal los datos obtenidos en la base de datos */
                $("#Mdiv_editarPlanes").append(options);

                /* Cuando ya tenemos listo el modal con los datos que queriamos abrimos el modal */
                $('#compose-modal-modificar').modal('show');
            },
            timeout: 4000
        });

    });

    /* Evento se levanta cuando queremos insertar un Nuevo Plan */

    $("#formInsertar").submit(function (e){
        e.preventDefault();
        var datos = {
            nombrePlan: $("#nombrePlan").val(),
            uvPlan: $("#uvPlan").val()
        }
        $.ajax({
            async: true,
            type: "POST",
            url: "pages/SecretariaAcademica/Mantenimiento/PlanesEstudio/insertarPlan.php",
            data: datos,
            dataType: "html",
            success: function(data){   
                $("#notificaciones").html(data);
                $("#notificaciones").fadeOut(3500);
                cargarPlanes();
            },
            timeout: 4000
        });

    });

    
    /* Esta funcion es llamada al principio, es la encargada de actualizar la tabla que muestra
        las ciudades que estan en el sistema en ese momento, se recarga cada vez que se elimina o se 
        actualiza */
    function cargarPlanes(){
        var datos = {
            accion: 1
         };

        $.ajax({
            async: true,
            type: "POST",
            url: "pages/SecretariaAcademica/Mantenimiento/PlanesEstudio/cargarPlanesEstudio.php",
            data: datos,
            dataType: "html",
            success: function(data){
                var response = JSON.parse(data);
                var options = '';
                /* Seccion para llenar la tabla */
                for (var index = 0;index < response.length; index++) 
                {
                   options += '<tr>' +
                                    '<td>' + response[index].codPlan + '</td>' +
                                    '<td>' + response[index].nombrePlan + '</td>' +
                                    '<td>' + response[index].uv + '</td>' +
                                    '<td><center>'+
                                        '<button data-id = "'+ response[index].codPlan +'" href= "#" class = "editar btn_editar btn btn-info"  data-toggle="modal" data-target = ""><i class="glyphicon glyphicon-edit"></i></button>'+
                                    '</td></center>' +
                                    '<td><center>'+
                                        '<button data-id = "'+ response[index].codPlan +'" href= "#" class = "elimina btn_editar btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>'+
                                    '</td></center>' +             
                              '</tr>';
                }

            
                $("#cTablaPlanes").html(options);

                /* Script que permite a la tabla hacer busquedas dentro de ella
                    y ordenarla deacuerdo a lo que se presenta en ella. */
                $('#tablePlanes').dataTable(); 
            },
            timeout: 4000
        }); 
    }

    /* Seccion que se manda a llamar cuando dentro de la modal aceptamos e indicamos que lo que queremos 
    modificar ya se hiso */

    $("#form_Modificar").submit(function(e) {
            e.preventDefault();
            $("#compose-modal-modificar").modal('hide');
            datosEditados = {
                codigo: $("#codPlan").data('id'),
                nombre: $("#nombrePlan1").val(),
                uv: $("#uvPlan").val()
            };
            $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                data: datosEditados,
                contentType: "application/x-www-form-urlencoded",
                url: "pages/SecretariaAcademica/Mantenimiento/PlanesEstudio/submitModal.php",
                success: function(data){ 
                    $("#notificaciones1").html(data);
                    $("#notificaciones1").fadeOut(4500000);
                    cargarPlanes();
                },
                timeout: 4000
            });
        });
});

</script>


<!-- Div para cargar informacion recibida por el servidor -->
<div id = "notificaciones"></div>

<!-- Seccion para que el usuario indique el nuevo plan de estudio que quiere ingresar -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <label><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Nuevo Plan de Estudios </label>
            </div>
            <div class="panel-body">
                <div>
                       <div id= "noti1" class="alert alert-info" role="alert"><center>Por favor ingrese los datos que acontinuacion se le piden</center></div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <form id = "formInsertar" role="form" action="#" method="POST">
                            <div id="Nplan" class="form-group">
                                <label>Nombre Plan de Estudio</label>
                                <input placeholder = "Se necesita un nombre" type="text"  class="form-control" name="nombrePlan" id="nombrePlan" required >
                            </div>
                            <div id="UV" class="form-group">
                                <label>Unidades Valorativas</label>
                                <input placeholder = "Univades Valorativas" type="number"  class="form-control" name="uvPlan" id="uvPlan" required >
                            </div>
                            <button type="submit" name="submit"  id="submit" class="submit btn btn-primary" >Agregar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- En este div se muestran todos los mensajes con respecto a la creacion y eliminacion dentro de la 
    que el servidor responda -->
<div id = "notificaciones1"></div>

<!-- Seccion usada para mostrar la tabla de los planes de estudio que estan presentes en el sistema -->
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <label><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Planes de Estudio</label>
        </div>
        <div class="panel-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <section class="content">
                            <div class="table-responsive">
                                <table id= "tablePlanes" border="1" class='table table-bordered table-hover'>
                                    <thead>
                                        <tr>
                                            <th>Cod Plan </th>
                                            <th>Nombre Plan</th>
                                            <th>Unidades Valorativas</th>   
                                            <th>Actualización</th>  
                                            <th>Eliminar</th>                  
                                        </tr>
                                    </thead>
                                    <tbody id = "cTablaPlanes">
                                        <!-- Contenido de la tabla generado atravez de la consulta a 
                                            la base de datos -->
                                    </tbody>
                                </table>       
                            </div>
                        </section>
                    </div>                
                </div>
            </div>       
        </div>
    </div>
</div>

<!-- Modal para editar los Planes de estudio -->

<div  class="modal fade" id="compose-modal-modificar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" id="form_Modificar" name="form_Modificar" action="#">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Modificar Planes de estudio</h4>
                </div>
                <div class = "modal-body">
                    <div id= "Mdiv_editarPlanes">
                        
                    </div>                
                </div>
                <div class="modal-footer">
                    <button  id="guardaredicion" class="btn btn-primary" >Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>






