
<script type="text/javascript">
   /* Script que permite cargar todos los elementos de la tabla para mostrar los datos que estan
    Almacenados en la base de datos */
$(document).ready(function() {

    cargarCiudades(); //Hacemos el llamado para que se cargue la tabla siempre que se cargue la pag.

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
                    cargarCiudades();
                },
                url: "pages/SecretariaAcademica/Mantenimiento/CiudadOrigen/eliminarCiudad.php",
                timeout: 4000
            });
        }                 
    });


 /* Este evento se levanta cuando se le da click a el boton de editar */
   $(document).on("click",".editar",function (e){
        e.preventDefault();
        $("#Mdiv_editarCiudades").html("");
        var datos = { 
            
            id:  $(this).data('id') 
        };
        $.ajax({
            async: true,
            type: "POST",
            url: "pages/SecretariaAcademica/Mantenimiento/CiudadOrigen/actualizarCiudad.php",
            data: datos,
            dataType: "html",
            success: function(data){
                var response = JSON.parse(data);
                var options = '';
                /* En esta seccion llenamos los datos que se van a editar el modal*/ 
                for (var index = 0;index < response.length; index++) 
                {
                   options +=   '<div class="form-group">'+
                                    '<label>Codigo de la Ciudad</label>'+
                                    '<input id="codCiudad" disabled = "true" data-id="' + response[index].codCiudad + '" placeholder="' + response[index].codCiudad + '" class="form-control">'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<label>Nombre de la Ciudad</label>'+
                                    '<input id="nombreCiudad1" placeholder="'+response[index].nombreCiudad+'" class="form-control">'+
                                '</div>';
                }
                /* Insertamos dentro del div del modal los datos obtenidos en la base de datos */
                $("#Mdiv_editarCiudades").append(options);

                /* Cuando ya tenemos listo el modal con los datos que queriamos abrimos el modal */
                $('#compose-modal-modificar').modal('show');
            },
            timeout: 4000
        });

    });

    /* Evento se levanta cuando queremos insertar una nueva Ciudad */

    $("#formInsertar").submit(function (e){
        e.preventDefault();
        var datos = {
            nombreCiudad: $("#nombreCiudad").val()
        }
        $.ajax({
            async: true,
            type: "POST",
            url: "pages/SecretariaAcademica/Mantenimiento/CiudadOrigen/insertarCiudad.php",
            data: datos,
            dataType: "html",
            success: function(data){   
                $("#notificaciones").html(data);
                $("#notificaciones").fadeOut(3500);
                cargarCiudades();
            },
            timeout: 4000
        });

    });

    
    /* Esta funcion es llamada al principio, es la encargada de actualizar la tabla que muestra
        las ciudades que estan en el sistema en ese momento, se recarga cada vez que se elimina o se 
        actualiza */
    function cargarCiudades(){
        var datos = {
            accion: 1
         };

        $.ajax({
            async: true,
            type: "POST",
            url: "pages/SecretariaAcademica/Mantenimiento/CiudadOrigen/cargarCiudadesOrigen.php",
            data: datos,
            dataType: "html",
            success: function(data){
                var response = JSON.parse(data);
                var options = '';
                /* Seccion para llenar la tabla */
                for (var index = 0;index < response.length; index++) 
                {
                   options += '<tr>' +
                                    '<td>' + response[index].codCiudad + '</td>' +
                                    '<td>' + response[index].nombreCiudad + '</td>' +
                                    '<td><center>'+
                                        '<button data-id = "'+ response[index].codCiudad +'" href= "#" class = "editar btn_editar btn btn-info"  data-toggle="modal" data-target = ""><i class="glyphicon glyphicon-edit"></i></button>'+
                                    '</td></center>' +
                                    '<td><center>'+
                                        '<button data-id = "'+ response[index].codCiudad +'" href= "#" class = "elimina btn_editar btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>'+
                                    '</td></center>' +             
                              '</tr>';
                }

            
                $("#cTablaCiudades").html(options);

                /* Script que permite a la tabla hacer busquedas dentro de ella
                    y ordenarla deacuerdo a lo que se presenta en ella.*/
                $('#tableCiudad').dataTable(); 
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
                codigo: $("#codCiudad").data('id'),
                nombre: $("#nombreCiudad1").val()
            };
            $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                data: datosEditados,
                contentType: "application/x-www-form-urlencoded",
                url: "pages/SecretariaAcademica/Mantenimiento/CiudadOrigen/submitModal.php",
                success: function(data){ 
                    $("#notificaciones1").html(data);
                    $("#notificaciones1").fadeOut(4500000);
                    cargarCiudades();
                },
                timeout: 4000
            });
        });
});

</script>


<!-- Div para cargar informacion recibida por el servidor -->
<div id = "notificaciones"></div>

<!-- Seccion para que el usuario indique la nueva ciudad que quiere ingresar -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <label><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Ingreso de datos de la ciudad </label>
            </div>
            <div class="panel-body">
                <div>
                       <div id= "noti1" class="alert alert-info" role="alert"><center>Por favor ingrese los datos que acontinuacion se le piden</center></div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <form id = "formInsertar" role="form" action="#" method="POST">
                            <div id="Nciudad" class="form-group">
                                <label>Nombre Ciudad</label>
                                <input placeholder = "Se necesita un nombre" type="text"  class="form-control" name="nombreCiudad" id="nombreCiudad" required >
                                <p class="help-block">Ejemplo: Tegucigalpa, Ceiba, San Pedro Sula</p>
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

<!-- Seccion usada para mostrar la tabla de las ciudades que estan presentes en el sistema -->
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <label><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Ciudades de Origen</label>
        </div>
        <div class="panel-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <section class="content">
                            <div class="table-responsive">
                                <table id= "tableCiudad" border="1" class='table table-bordered table-hover'>
                                    <thead>
                                        <tr>
                                            <th>Cod Ciudad</th>
                                            <th>Nombre Ciudad</th>   
                                            <th>Actualización</th>  
                                            <th>Eliminar</th>                  
                                        </tr>
                                    </thead>
                                    <tbody id = "cTablaCiudades">
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

<!-- Modal para editar las ciudades -->

<div  class="modal fade" id="compose-modal-modificar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" id="form_Modificar" name="form_insertar" action="#">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Modificar Ciudad</h4>
                </div>
                <div class = "modal-body">
                    <div id= "Mdiv_editarCiudades">
                        
                    </div>                
                </div>
                <div class="modal-footer">
                    <button  id="guardaredicion" class="btn btn-primary" >Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>






