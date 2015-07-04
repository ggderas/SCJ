<?php
$id = $_POST['ide'];
$nombre;
session_start();
include '../Datos/conexion.php';

$query = mysql_query("SELECT * FROM poa where id_Poa='" . $id . "'", $enlace);
while ($row = mysql_fetch_array($query)) {
    $nombre = $row['nombre'];
    $_SESSION['inicio_Poa']=$row['fecha_de_Inicio'];
    $_SESSION['fin_Poa']=$row['fecha_Fin'];
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
    $("#contenedor").load('pages/crearEdificios.php');
     //$("#contenedor").load('../cargarPOAs.php');
}
 
 
 $(document).on("click",".verObjetivo",function() {
    
   
                    id1 = $(this).parents("tr").find("td").eq(0).html();
                    // alert(id1);      
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
 $(document).on("click",".eliminarObjetivo",function() {
 
                    var respuesta = confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
                    if (respuesta)
                    {
                        id2 = $(this).parents("tr").find("td").eq(0).html();
                        // alert(id2)

                        data2 = {id: id2, idPOA: $("#idPOA").val()};
                        $.ajax({
                            async: true,
                            type: "POST",
                            dataType: "html",
                            contentType: "application/x-www-form-urlencoded",
                            //url: "Datos/eliminarObjetivo.php",
                            //beforeSend: inicioEliminar,
                            success: llegadaElminarObjetivo,
                            timeout: 4000,
                            error: problemas
                        });
                        return false;
                    }
                 
     
     
     
 });
 $(document).on("click",".editarObjetivo",function() {
     
                   id = $(this).parents("tr").find("td").eq(0).html();
                    // alert(id);      
                    data4 = {idObj: id,
                        
                        idPOA:$('#idPOA').val()
                    };
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        //: "application/x-www-form-urlencoded",
                        //url: "pages/editarPOA.php",
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
                    $("#myModal").modal('hide');
                    //var pnombre = $("#titulo").val();
                    // alert(pnombre);
                    data = {def: $("#def").val(),
                        area: $("#area").val(),
                        tipArea: $("#tipArea").val(),
                        res: $("#res").val(),
                        id: $("#idPOA").val()
                    };
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "Datos/insertarObjetivo.php",
                        beforeSend: inicioEnvio,
                        success: llegadaGuardarObjetivo,
                        timeout: 4000,
                        error: problemas
                    });

                    limpiarCamposObjetivos();
                    return false;

                });

            });

            function llegadaEditarObjetivo()
            {
                $("#cuerpoEditarObjetivo").load('pages/editarObjetivo.php', data4);
                $('#editarObjetivo').modal('show');
            }
            function limpiarCamposObjetivos() {
                $("#def").val('');
                $("#area").val('');
                $("#tipArea").val(0);
                $("#res").val('');
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
            function llegadaElminarObjetivo()
            {
                $("#contenedor2").load('Datos/eliminarObjetivo.php', data2);
            }
            function llegadaGuardarObjetivo()
            {
                $("#contenedor2").load('Datos/insertarObjetivo.php', data);
                //$("#contenedor2").load('Datos/cargarObjetivos.php',data2);
            }

            function problemas()
            {
                $("#contenedor2").text('Problemas en el servidor.');
            }


        </script>


    </head>

    <body>

        <input type="hidden" id="idPOA" value="<?php echo $id; ?>">     

        <div class="col-lg-12">

            <div class="row">            
                <div class="panel panel-default">
                    <a id="retornoEdificio" href="#"><i class="fa fa-table fa-fw"></i>Edificio:<strong> <?php echo " ".$nombre; ?></strong></a>
                    
                </div>
                
                          
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="col-lg-8">
                                            <button class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                                Nuevo Objetivo
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <label >Mis Objetivos </label>
                                    </h4>
                                </div>
                                <div >
                                    <div id="contenedor2" class="panel-body">








                                        <?php
                                        $query2 = mysql_query("SELECT * FROM objetivos_institucionales where id_Poa='" . $id . "'", $enlace);
                                        ?>    




                                      
                                            <div class="box-body table-responsive">
                        <table id="tabla_prioridad" class='table table-bordered table-striped'>
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Definicion</th>
                                                            <th>Area Estrategica</th>
                                                            <th>Resultado</th>
                                                            <th>Area que Pertenece</th>                                            
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        while ($row = mysql_fetch_array($query2)) {
                                                            $id = $row['id_Objetivo'];
                                                            ?>
                                                            <tr>
                                                                <td ><?php echo $id ?></td>
                                                                <td><div class="text" id="definicion-<?php echo $id ?>"><?php echo $row['definicion'] ?></div></td>
                                                                <td><div class="text" id="area-<?php echo $id ?>"><?php echo $row['area_Estrategica'] ?></div></td>
                                                                <td><div class="text" id="resultado-<?php echo $id ?>"><?php echo $row['resultados_Esperados'] ?></div></td>
                                                                <td><div class="text" id="campo-<?php echo $id ?>"><?php echo $row['id_Area'] ?></div></td>

                                                                <td><a class="verObjetivo btn btn-success  fa fa-arrow-right "></a>
                                                                    <a class="editarObjetivo btn btn-info fa fa-pencil "></a>
                                                                    <a class="eliminarObjetivo btn btn-danger fa fa-trash-o"></a>
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
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Agregar Nuevo Objetivo</h4>
                    </div>
                    <div class="modal-body">
                        <form role='form' id="form" name="form">
                            <div class="form-group">
                                <label>Definición </label>
                                <textarea id="def" class="form-control" rows="2" required 
                                          pattern="[^0-9]"
                                          ></textarea>
                            </div>
                            <div class="form-group">
                                <label>Area Estrategica </label>
                                <textarea id="area" class="form-control" rows="2" required
                                          pattern="[^0-9]"
                                          ></textarea>
                            </div>
                            <div class="form-group">
                                <label>Resultado</label>
                                <textarea id="res" class="form-control" rows="2" required
                                          pattern="[^0-9]"
                                          ></textarea>
                            </div>
                            <div class="form-group">
                                <label>Area a la que pertenece </label>
                                <select id="tipArea" class="form-control">
                                    <option value="0">Seleccione..</option>
                                    <?php
                                    $consulta = "SELECT * FROM area";

                                    if ($resultado = $conectar->query($consulta)) {

                                        while ($fila = $resultado->fetch_row()) {
                                            $id = $fila[0];
                                            $area = $fila[1];
                                            ?>
                                            <option value="<?php echo $id; ?>"><?php echo $area; ?></option>
                                            <?php
                                        }
                                        $resultado->close();
                                    }
                                    ?>
                                </select>
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



        <div class="modal fade" id="editarObjetivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Editar Objetivo Institucional</h4>
                    </div>
                    <div class="modal-body" id="cuerpoEditarObjetivo">

                    </div>

                </div>
            </div>

        </div> 










    </body>

</html>

<?php
mysql_close($enlace);
?>