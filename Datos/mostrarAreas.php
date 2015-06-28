
<?php
include '../Datos/conexion.php';
$query = mysql_query("Select distinct area.id_area,area.nombre, tipo_area.nombre as n, tipo_area.id_tipo_area as idT, area.observacion from area,tipo_area where area.id_tipo_area=tipo_area.id_tipo_area order by area.id_area desc", $enlace);

$sql = mysql_query("Select * from tipo_area", $enlace);
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
                            <th>id Area</th>
                            <th>Nombre</th>
                            <th>Tipo de Area</th>
                            <th>Observaciones</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contador = 0;
                        while ($row = mysql_fetch_array($query)) {
                            $id = $row['id_area'];
                            ?>
                            <tr>
                                <td ><?php echo $row['id_area'] ?></td>
                                <td><?php echo $row['nombre'] ?></td>
                                <td id="<?php echo $row['idT'] ?>"><?php echo $row['n'] ?></td>
                                <td><?php echo $row['observacion'] ?></td>
                                <td>
                                    <a class="editarArea btn btn-info fa fa-pencil" data-toggle="modal" data-target="#miModalDeArea"></a>
                                    <a class="eliminarArea btn btn-danger fa fa-trash-o"></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="miModalDeArea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" id="eFormXX" name="form" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Nueva Area</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nombre del Area</label>
                                <input id="editarNombreDeArea" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="eTipoArea">
                                    <option>Seleccione</option>
                                    <?php
                                    $cont = 0;
                                    while ($row = mysql_fetch_array($sql)) {
                                        echo'<option name="' . $cont . '" Value="' . $row['id_Tipo_Area'] . '">' . $row['nombre'] . '</option>';
                                        $contador++;
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Observacion</label>
                                <textarea id="editarObsDeArea" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button  id="guardaredicion" class="btn btn-primary" >Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </body>
</html>

<script>
    $(document).ready(function() {
        var idd;
        $(".editarArea").click(function() {
            idd = $(this).parents("tr").find("td").eq(0).html();
            aNombre = $(this).parents("tr").find("td").eq(1).html();
            aIdTipo = $(this).parents("tr").find("td").eq(2).attr('id').valueOf();
            aObs = $(this).parents("tr").find("td").eq(3).html();

            $("#editarNombreDeArea").val(aNombre.toString());
            $("#editarObsDeArea").val(aObs.toString());
            $("#eTipoArea").val(aIdTipo);
        });

        $(".eliminarArea").click(function() {
            var respuesta = confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
            if (respuesta)
            {
                id = $(this).parents("tr").find("td").eq(0).html();
                dataArea = {idA: id}
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    //contentType: "application/x-www-form-urlencoded",
                    //url: "Datos/insertarArea.php",
                    beforeSend: inicio,
                    success: eliminarArea,
                    timeout: 4000,
                    error: problemas
                });
            }
        });


        $("#eFormXX").submit(function(e) {
            e.preventDefault();
            $("#miModalDeArea").modal('hide');
            datosEditados = {
                idTAS: idd,
                nombreDA: $("#editarNombreDeArea").val(),
                tipoDA: $("#eTipoArea").val(),
                observacionDA: $("#editarObsDeArea").val()

            };

            $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                //contentType: "application/x-www-form-urlencoded",
                //url: "Datos/insertarArea.php",
                //beforeSend: inicioEnvio,
                success: guardarEdicionArea,
                timeout: 4000,
                error: problemas
            });

            //limpiarCamposArea();
            return false;
        });

        function eliminarArea()
        {
            $("#contenedor2").load('Datos/eliminarArea.php', dataArea);
        }

        function guardarEdicionArea()
        {
            $("#contenedor2").load('Datos/editarArea.php', datosEditados);
        }

        function inicio()
        {
            var x = $("#contenedor2");
            x.html('Cargando...');
        }

        function problemas()
        {
            var x = $("#contenedor2");
            x.html('problemas en el servidor...');
        }
    }
    );</script>
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            $("#resultado").fadeOut(1500);
        }, 3000);
    });
</script>
</html>

