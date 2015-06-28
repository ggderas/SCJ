<?php
$id = $_POST['ide'];
$nombreObjetivo;
$nombrePoa;

//echo $id;
include '../Datos/conexion.php';
$query = mysql_query("SELECT objetivos_institucionales.id_Objetivo,objetivos_institucionales.definicion,objetivos_institucionales.id_Poa,poa.nombre FROM objetivos_institucionales inner join poa on objetivos_institucionales.id_Poa=poa.id_Poa where  objetivos_institucionales.id_Objetivo='" . $id . "'", $enlace);
while ($row = mysql_fetch_array($query)) {
    $nombreObjetivo = $row['definicion'];
    $nombrePoa = $row['nombre'];
    $idObj = $row['id_Objetivo'];
    $idPoa = $row['id_Poa'];
    
}
?>


<!DOCTYPE html>
<html lang="es">

    <head>
        
        <script type="text/javascript">

        $(document).ready(function () {
            $('#tabla_prioridad').dataTable({
                "order": [[0, "asc"]],
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
            
             $(document).on("click","#retonoPOA",function() {
                 
                
                    
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
    $("#contenedor").load('pages/crearPOA.php');
     //$("#contenedor").load('../cargarPOAs.php');
}             
             
             $(document).on("click","#retonoOBJ",function() {
                 
             
                    //id = $(this).parents("tr").find("td").eq(0).html();
                    //alert(id);
                    id=$("#idPoa").val();
                    data1 = {ide: id};
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        //url: "pages/crearObjetivo.php",
                        //beforeSend: inicioVer,
                        success: llegadaRetornoObj,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;
                 
              
             });
             
              function llegadaRetornoObj()
            {
                $("#contenedor").load('pages/crearObjetivo.php', data1);
            }
             
             
             
             $(document).on("click",".verIndicador",function() {
                 
                
                    id = $(this).parents("tr").find("td").eq(0).html();
                // alert(id);      
                data = {ide: id};
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    url: "pages/crearActividad.php",
                   // beforeSend: inicioVer,
                    success: llegadaVer,
                    timeout: 4000,
                    error: problemas
                });
                return false;
               
                 
                 
             });
             
             $(document).on("click",".eliminarIndicador",function() {
                 
                
                    var respuesta = confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
                if (respuesta)
                {
                    id2 = $(this).parents("tr").find("td").eq(0).html();
                    // alert(id2);      
                    data2 = {ide: id2, obj: $("#idObj").val()};
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        //url: "Datos/eliminarIndicador.php",
                        //beforeSend: inicioEliminar,
                        success: llegadaEliminar,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;
                }
                
                 
                 
             });
             
             $(document).on("click",".editarIndicador",function() {
             
             


                    id = $(this).parents("tr").find("td").eq(0).html();
                    // alert(id);      
                    data4 = {idInd: id,
                        idObj: $('#idObj').val()
                    };
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        //: "application/x-www-form-urlencoded",
                        //url: "pages/editarPOA.php",
                        //beforeSend: inicioEliminar,
                        success: llegadaEditarIndicador,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;

                 
                 
                 
             });
             
             
             
            $(document).ready(function() {
      

                $("#form2").submit(function(e) {
                    e.preventDefault();
                    $("#myModal").modal('hide');
                    data1 = {ind: $("#indicador").val(),
                    def: $("#definicion").val(),
                    obj: $("#idObj").val()

                };
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    url: "Datos/insertarIndicador.php",
                    //beforeSend: inicioEnvio,
                    success: llegadaGuardar,
                    timeout: 4000,
                    error: problemas
                });
               

                    limpiarCamposIndicador();
                    return false;

                });


            });
            function limpiarCamposIndicador()
            {
                $("#definicion").val('');
                $("#indicador").val('');
            }
            
            function llegadaEditarIndicador()
            {
                $("#cuerpoEditarIndicador").load('pages/editarIndicador.php', data4);
                $('#editarIndicador').modal('show');
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

            function inicioEliminar()
            {
                var x = $("#contenedor2");
                x.html('Cargando...');
            }

            function llegadaVer()
            {
                $("#contenedor").load('pages/crearActividad.php', data);
            }

            function llegadaEliminar()
            {
                $("#contenedor2").load('Datos/eliminarIndicador.php', data2);
            }

            function llegadaGuardar()
            {
                $("#contenedor2").load('Datos/insertarIndicador.php', data1);
                //$("#contenedor2").load('Datos/cargarObjetivos.php',data);
            }

            function problemas()
            {
                $("#contenedor2").text('Problemas en el servidor.');
            }


        </script>


    </head>

    <body>

        <input type="hidden" id="idObj" value="<?php echo $idObj; ?>">  
        <input type="hidden" id="idPoa" value="<?php echo $idPoa; ?>">  
        <div class="col-lg-12">

            <div class="row"> 
                <div class="panel panel-default">
                    <a id="retonoPOA" href="#"><i class="fa fa-table fa-fw"></i>POA:<strong> <?php echo " ".$nombrePoa; ?></strong></a>
                    <a id="retonoOBJ" href="#"><i class="fa fa-table fa-fw"></i>OBJETIVO:<strong> <?php echo " ".$nombreObjetivo; ?> </strong></a>
                </div>


                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="col-lg-8">
                                            <button class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                                Nuevo Indicador
                                            </button>
                                        </div> 
                                    </div>
                                </div>
                            
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <label >Mis Indicadores</label>
                                    </h4>
                                </div>
                                <div >
                                    <div id="contenedor2" class="panel-body">
                                        <?php
                                        //include '../Datos/cargarIndicadores.php'; 
//include '../Datos/conexion.php';
// aqui falta aplicar el filtro para que solo carge los indicadores de un solo objetivo
                                        $query = mysql_query("SELECT objetivos_institucionales.id_Objetivo,indicadores.id_Indicadores,indicadores.nombre,indicadores.descripcion FROM indicadores inner join objetivos_institucionales on indicadores.id_ObjetivosInsitucionales = objetivos_institucionales.id_Objetivo where indicadores.id_ObjetivosInsitucionales='" . $id . "'", $enlace);
                                        ?>

                                            <div class="box-body table-responsive">
                        <table id="tabla_prioridad" class='table table-bordered table-striped'>
                                                    <thead>
                                                        <tr>  
                                                            <th>Id</th>
                                                            <th>Nombre</th>
                                                            <th>Descripcion </th>                                                                                    
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        while ($row = mysql_fetch_array($query)) {
                                                            $id = $row['id_Indicadores'];
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row['id_Indicadores'] ?></td>
                                                                <td><div class="text" id="nombre-<?php echo $id ?>"><?php echo $row['nombre'] ?></div></td>
                                                                <td><div class="text" id="descripcion-<?php echo $id ?>"><?php echo $row['descripcion'] ?></div></td>                        

                                                                <td><a class="verIndicador btn btn-success  fa fa-arrow-right "></a>
                                                                    <a class="editarIndicador btn btn-info fa fa-pencil "></a>
                                                                    <a class="eliminarIndicador  btn btn-danger fa fa-trash-o"></a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                           








                                    </div>
                                </div>
                            </div> 

                        </div>
                    </div>
                    <!-- .panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>




        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Agregar Nuevo Indicador</h4>
                    </div>
                    <div class="modal-body">

                        <form id="form2" role='form2' name="form2">

                            <div class="form-group">
                                <label>Indicador</label>
                                <textarea id="indicador" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Descripcion</label>
                                <textarea id="definicion" class="form-control" rows="2" required></textarea>
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

<div class="modal fade" id="editarIndicador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Editar Un Indicador</h4>
                    </div>
                    <div class="modal-body" id="cuerpoEditarIndicador">

                    </div>

                </div>
            </div>

        </div> 










    </body>

</html>

