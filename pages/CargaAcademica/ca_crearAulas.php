<?php

$codigoEdificio = $_POST['codigoEdificio'];

include '../../Datos/conexion.php';

$query = mysql_query("SELECT * FROM edificios WHERE Edificio_ID = " . $codigoEdificio,  $enlace);
while ($row = mysql_fetch_array($query)) {
    $nombreEdificio = $row['descripcion'];
}
?>


<!DOCTYPE html>
<html lang="es">

    <head>
        
        <script type="text/javascript">


        $(document).ready(function () {
            $('#tabla_prioridad').dataTable({
                "order": [[0, "asc"]],
                "destroy": true,
                "fnDrawCallback": function (oSettings) {



                }
                ,
                "language":
                {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se han encontrado registros",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(Filtrado de _MAX_ registros)"   ,
                    "search": "Buscar",
                    "paginate":
                            {
                                "previous": "Anterior",
                                "next" : "Siguiente"
                            }
                }
            }); // example es el id de la tabla
        });

    </script>
    <!-- Script necesario para que la tabla se ajuste a el tamanio de la pag-->
    <script type="text/javascript">
        // For demo to fit into DataTables site builder...
        $('#tabla_prioridad')
                .removeClass('display')
                .addClass('table table-striped table-bordered');
    </script>
        
        
        
        <script>


 $(document).on("click","#retornoEdificio",function() {
       $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        //url:"pages/crearPOA.php",    
        // url:"../cargarPOAs.php",  
        //beforeSend:inicioEnvio,
        success:llegadaCrear,
        timeout:4000,
        error:problemas
    }); 
    return false;

     
     
     
 });
 
 
   function llegadaCrear()
{
    $("#contenedor").load('pages/CargaAcademica/ca_crearEdificios.php');
     //$("#contenedor").load('../cargarPOAs.php');
}
 
 
 $(document).on("click",".verObjetivo",function() {
    
   
                    id1 = $(this).parents("tr").find("td").eq(0).html();
                    data1 = {ide: id1};
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "pages/crearIndicador.php",
                        //beforeSend: inicioVer,
                        success: llegadaVerObjetivo,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;
                
     
     
     
 });
 $(document).on("click",".eliminarAula",function() {
 
                    var respuesta = confirm("¿Esta seguro de que desea eliminar el aula seleccionada?");
                    if (respuesta)
                    {
                        id2 = $(this).parents("tr").find("td").eq(0).html();
                        // alert(id2)

                        data2 = 
                        {
                            codigoAula: id2,
                            numeroAula : $("#numeroAula").val(),
                            accion : 3,
                            codigoEdificio : <?php echo $codigoEdificio; ?>                            
                        };
                        $.ajax({
                            async: true,
                            type: "POST",
                            dataType: "html",
                            contentType: "application/x-www-form-urlencoded",
                            url: "Datos/ca_gestionar_aulas.php",
                            //beforeSend: inicioEliminar,
                            success: llegadaElminarAula,
                            timeout: 4000,
                            error: problemas
                        });
                        return false;
                    }
                 
     
     
     
 });
 $(document).on("click",".editarAula",function() {
     
                   id = $(this).parents("tr").find("td").eq(0).html();
                    // alert(id);      
                    data4 = 
                    {
                        codigoAula: id,
                        codigoEdificio : <?php echo $codigoEdificio; ?>                
                    };
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        //: "application/x-www-form-urlencoded",
                        url: "pages/editarAula.php",
                        //beforeSend: inicioEliminar,
                        success: llegadaEditarObjetivo,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;

                 
     
     
 });

            $(document).ready(function() {


                $("#form").submit(function(e) {
                    e.preventDefault();
                    $("#myModalAula").modal('hide');
                    //var pnombre = $("#titulo").val();
                    // alert(pnombre);
                    data = 
                    {
                        numeroAula : $("#numeroAula").val(),
                        accion : 1,
                        codigoEdificio : <?php echo $codigoEdificio; ?>
                    };
                    
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "Datos/ca_gestionar_aulas.php",
                        beforeSend: inicioEnvio,
                        success: llegadaGuardarAula,
                        timeout: 4000,
                        error: problemas
                    });

                    limpiarCamposObjetivos();
                    return false;

                });

            });

            function llegadaEditarObjetivo()
            {
                $("#cuerpoEditar").load('pages/editarAula.php', data4);
                $('#editarAulaForm').modal('show');
            }
            function limpiarCamposObjetivos() {
                $("#numeroAula").val('');
            }


            function inicioEliminar()
            {
                var x = $("#contenedor2");
                x.html('Cargando...');
            }
            function inicioVer()
            {
                var x = $("#contenedor");
                x.html('Cargando...');
            }
            function inicioEnvio()
            {
                var x = $("#contenedor2");
                x.html('Cargando...');
            }
            function llegadaVerObjetivo()
            {
                $("#contenedor").load('pages/crearIndicador.php', data1);
            }
            function llegadaElminarAula()
            {
                $("#contenedor2").load('Datos/ca_gestionar_aulas.php', data2);
            }
            function llegadaGuardarAula()
            {
                $("#contenedor2").load('Datos/ca_gestionar_aulas.php', data);
                //$("#contenedor2").load('Datos/cargarObjetivos.php',data2);
            }

            function problemas()
            {
                $("#contenedor2").text('Problemas en el servidor.');
            }


        </script>


    </head>

    <body>

        <input type="hidden" id="codigoEdificio" value="<?php echo $codigoEdificio; ?>">     

        <div class="col-lg-12">

            <div class="row">            
                <div class="panel panel-default">
                    <a id="retornoEdificio" href="#"><i class="fa fa-table fa-fw"></i>Edificio: <strong> <?php echo " ".$nombreEdificio; ?></strong></a>
                    
                </div>
                
                          
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="col-lg-8">
                                            <button class="btn btn-success" data-toggle="modal" data-target="#myModalAula">
                                                Crear nueva aula
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <label >Aulas </label>
                                    </h4>
                                </div>
                                <div >
                                    <div id="contenedor2" class="panel-body">
                                        <?php include '../../Datos/ca_cargarAulas.php'; ?>
                                    </div>
                                </div>
                            </div> 

                    
        </div>
        <div class="modal fade" id="myModalAula" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Agregar nueva aula</h4>
                    </div>
                    <div class="modal-body">
                        <form role='form' id="form" name="form">
                            <div class="form-group">
                                <label>Número de aula </label>
                                <input id="numeroAula"  class="form-control"  required="" onblur="validar()">
                            </div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button  class="btn btn-primary" >Guardar</button>
                            </div>

                        </form>

                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>  



        <div class="modal fade" id="editarAulaForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Editar aula</h4>
                    </div>
                    <div class="modal-body" id="cuerpoEditar">

                    </div>

                </div>
            </div>

        </div> 



    </body>

</html>

<?php
mysql_close($enlace);
?>