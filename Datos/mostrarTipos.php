
<?php
include '../Datos/conexion.php';
$query = mysql_query("Select * from tipo_area", $enlace);
?>
<!DOCTYPE html>
<html lang="en">
    <head>

    </head>
    <body>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>   
                            <th>id</th>
                            <th>Nombre del Tipo</th>
                            <th>Observaciones</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contador = 0;
                        while ($row = mysql_fetch_array($query)) {
                            $id = $row['id_Tipo_Area'];
                            ?>
                            <tr>
                                <td><?php echo $row['id_Tipo_Area'] ?></td>
                                <td><?php echo $row['nombre'] ?></td>
                                <td><?php echo $row['observaciones'] ?></td>
                                <td>
                                    <a data-toggle="modal" data-target="#eModalNuevoTipoArea" class="editarTipoArea btn btn-info fa fa-pencil "></a>
                                    <a class="eliminarTipoArea btn btn-danger fa fa-trash-o"></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
                     <div class="modal fade" id="eModalNuevoTipoArea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form role="form" id="eform2" name="form" >
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Nuevo Plan Operativo Anual</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nombre del Tipo de Area</label>
                                            <input id="eNombreDeTArea" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Observacion</label>
                                            <textarea id="eObservacionDeTArea" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        <button  id="guardarR" class="btn btn-primary" >Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
        
    </body>


    <script>
        $(document).ready(function() {
            var eId1;
            $(".eliminarTipoArea").click(function() {
                var respuesta = confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
                if (respuesta)
                {
                    idTArea = $(this).parents("tr").find("td").eq(0).html();
                    dataTArea = {idTA: idTArea};
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        data:dataTArea,
                        //contentType: "application/x-www-form-urlencoded",
                        url: "Datos/eliminarTipoDeArea.php",
                        beforeSend: inicioEliminarArea,
                        success: eliminarTArea,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;
                }
            });
            $(".editarTipoArea").click(function() {
                eId1=$(this).parents("tr").find("td").eq(0).html();
                nTArea = $(this).parents("tr").find("td").eq(1).html();
                obsTArea = $(this).parents("tr").find("td").eq(2).html();
                
                $("#eNombreDeTArea").val(nTArea.toString());
                $("#eObservacionDeTArea").val(obsTArea.toString());
            });

            $("#eform2").submit(function(e) {
                e.preventDefault();
                $("#eModalNuevoTipoArea").modal('hide');
                  
                eDatosDeTArea = {
                    eId:eId1,
                    eNombreDTA: $("#eNombreDeTArea").val(),
                    eObservacionDTA: $("#eObservacionDeTArea").val()
                };
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    //contentType: "application/x-www-form-urlencoded",
                    //url: "Datos/insertarArea.php",
                    //beforeSend: inicioEnvio,
                    success: eGuardarTArea,
                    timeout: 4000,
                    error: problemas
                });
                //limpiarCamposArea();
                return false;
            });

            function eGuardarTArea()
            {
                $("#contenedorTiposDeArea").load('Datos/editarTipoDeArea.php', eDatosDeTArea);
            }
            function eliminarTArea()
            {
                $("#contenedorTiposDeArea").load('Datos/eliminarTipoDeArea.php', dataTArea);

            }

            function inicioEliminarArea()
            {
                var x = $("#contenedorTiposDeArea");
                x.html('Cargando...');
            }
            function problemas()
            {
                var x = $("#contenedorTiposDeArea");
                x.html('problemas...');
            }

        });
    </script>
</html>