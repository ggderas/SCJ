<?php
include '../Datos/conexion.php';
require_once("../conexion/config.inc.php");

$id = $_POST['id'];
$idPOA = $_POST['idPOA'];
$consulta = $db->prepare("CALL pa_eliminar_objetivo_institucional(?, @mensaje, @codMensaje)");
$consulta->bindParam(1, $id, PDO::PARAM_INT);
$resultado = $consulta->execute();

$output = $db->query("select @mensaje, @codMensaje")->fetch(PDO::FETCH_ASSOC);
$mensaje = $output['@mensaje'];
$codMensaje = $output['@codMensaje'];

if ($mensaje == NULL) {
    echo '<div id="resultado" class="alert alert-success">
        Se ha eliminado el objetivo institucional.</div>';
} else {
    echo '<div id="resultado" class="alert alert-danger">
         ' . $mensaje . '</div>';
}

$query = mysql_query("SELECT * FROM objetivos_institucionales where id_Poa='" . $idPOA . "'", $enlace);
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
                            <th></th>                                          
                            <th>Definicion</th>
                            <th>Area Estrategica</th>
                            <th>Resultado</th>
                            <th>Area que Pertenece</th>                                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysql_fetch_array($query)) {
                            $id = $row['id_Objetivo'];
                            ?>
                            <tr>
                                <td><?php echo $row['id_Objetivo'] ?></td>
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
            <!-- /.table-responsive -->
        </div>



        <script>


            $(document).ready(function() {


                $(".verObjetivo ").click(function() {
                    id1 = $(this).parents("tr").find("td").eq(0).html();
                    // alert(id1);      
                    data1 = {ide: id1};
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "pages/crearIndicador.php",
                        beforeSend: inicioVer,
                        success: llegadaVerObjetivo,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;
                });
                $(".eliminarObjetivo").click(function() {
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
                            url: "Datos/eliminarObjetivo.php",
                            beforeSend: inicioEliminar,
                            success: llegadaElminarObjetivo,
                            timeout: 4000,
                            error: problemas
                        });
                        return false;
                    }
                });

                $(".editarObjetivo").click(function() {


                    id = $(this).parents("tr").find("td").eq(0).html();
                    // alert(id);      
                    data4 = {id: id};
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


            });
            function llegadaEditarObjetivo()
            {
                $("#cuerpoEditarObjetivo").load('pages/editarObjetivo.php', data4);
                $('#editarObjetivo').modal('show');
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

        <script type="text/javascript">
            $(document).ready(function() {
                setTimeout(function() {
                    $("#resultado").fadeOut(1500);
                }, 3000);

            });
        </script>

    </body>

</html>


