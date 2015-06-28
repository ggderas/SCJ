<?php
include '../Datos/conexion.php';

$def = $_POST['def'];
$area = $_POST['area'];
$tipArea = $_POST['tipArea'];
$res = $_POST['res'];
$idPOA = $_POST['id'];

$consulta = $conectar->prepare("CALL pa_insertar_objetivos_institucionales(?,?,?,?,?)");
$consulta->bind_param('sssii', $def, $area, $res, $tipArea, $idPOA);
$resultado = $consulta->execute();

if ($resultado == 1) {
    echo '<div id="resultado" class="alert alert-success">
        se ha Creado un nuevo Objetivo Institucional
         
         </div>';
} else {
    echo '<div id="resultado" class="alert alert-danger">
        No se Inserto ningun Nuevo elemento 
         
         </div>';
}

//include 'cargarObjetivos.php';
//$ide= $_POST['id'];
//include '../Datos/conexion.php';
// aqui falta aplicar el filtro para que solo carge los Objetivos de Un solo POA
//$query = mysql_query("SELECT * FROM objetivos_institucionales",$enlace);
$query = mysql_query("SELECT * FROM objetivos_institucionales where id_Poa='" . $idPOA . "'", $enlace);
?>



<!DOCTYPE html>
<html lang="en">

    <head>


<script type="text/javascript">

        $(document).ready(function () {
            $('#tabla_prioridad').dataTable({
                "order": [[0, "asc"]],
                "fnDrawCallback": function (oSettings) {


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




    </head>

    <body>
        <div class="panel-body">
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