<?php
include '../Datos/conexion.php';
require_once("../conexion/config.inc.php");

$cor = $_POST['cor'];
$act = $_POST['act'];
$sup = $_POST['sup'];
$jus = $_POST['jus'];
$ver = $_POST['ver'];
$pob = $_POST['pob'];
$ini = $_POST['inicio'];
$fin = $_POST['fin'];
$idInd = $_POST['id'];


$consulta = $conectar->prepare("CALL pa_insertar_actividad(?,?,?,?,?,?,?,?,?, @mensaje, @codMensaje)");

$consulta->bind_param('issssssss', $idInd, $act, $cor, $sup, $jus, $ver, $pob, $ini, $fin);
$resultado = $consulta->execute();

$output = $db->query("select @mensaje, @codMensaje")->fetch(PDO::FETCH_ASSOC);
$mensaje = $output['@mensaje'];
$codMensaje = $output['@codMensaje'];

if ($mensaje == NULL) {
    echo '<div id="resultado" class="alert alert-success">
        La actividad se ha creado exitosamente.</div>';
} else {
    echo '<div id="resultado" class="alert alert-danger">
         ' . $mensaje . '</div>';
}
//include 'cargarPOAs.php';


//include 'cargarObjetivos.php';
//$ide= $_POST['id'];
//include '../Datos/conexion.php';
// aqui falta aplicar el filtro para que solo carge los Objetivos de Un solo POA
//$query = mysql_query("SELECT * FROM objetivos_institucionales",$enlace);
$query = mysql_query("SELECT * FROM actividades where id_indicador='" . $idInd . "'", $enlace);
?>



<!DOCTYPE html>
<html lang="en">

    <head>



<script type="text/javascript">

        $(document).ready(function () {
            $('#tabla_prioridad').dataTable({
                "order": [[0, "asc"]],
                "fnDrawCallback": function (oSettings) 
                {
                },
                paging: false,
                searching: false
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
                            <th>Id</th>
                            <th>Actividad</th>
                            <th>Fecha Inicio  </th> 
                            <th>Fecha Fin</th> 
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
<?php
while ($row = mysql_fetch_array($query)) {
    $id = $row['id_actividad'];
    ?>
                            <tr>
                                <td><?php echo $row['id_actividad'] ?></td>
                                <td><div class="text" id="nombre-<?php echo $id ?>"><?php echo $row['descripcion'] ?></div></td>
                                <td><div class="text" id="descripcion-<?php echo $id ?>"><?php echo $row['fecha_inicio'] ?></div></td> 
                                <td><div class="text" id="descripcion-<?php echo $id ?>"><?php echo $row['fecha_fin'] ?></div></td> 
                                <td><a class="verActividad btn btn-success  fa fa-arrow-right "></a>
                                    <a class="editarActividad btn btn-info fa fa-pencil "></a>
                                    <a class="eliminarActividad   btn btn-danger fa fa-trash-o"></a>
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


                $(".verActividad").click(function() {
                    id2 = $(this).parents("tr").find("td").eq(0).html();
                    //alert(id);      
                    data2 = {ide: id2};
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "pages/actividad.php",
                        beforeSend: inicioVer,
                        success: llegadaVer,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;
                });
                $(".eliminarActividad").click(function() {
                    var respuesta = confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
                    if (respuesta)
                    {
                        idac = $(this).parents("tr").find("td").eq(0).html();
                        data3 = {idActividad: idac, idIndice: $("#idInd").val()};
                        $.ajax({
                            async: true,
                            type: "POST",
                            dataType: "html",
                            contentType: "application/x-www-form-urlencoded",
                            url: "Datos/eliminarActividad.php",
                            beforeSend: inicioEliminar,
                            success: llegadaEliminar,
                            timeout: 4000,
                            error: problemas
                        });
                        return false;
                    }
                });

                $(".editarActividad").click(function() {


                    id = $(this).parents("tr").find("td").eq(0).html();
                    // alert(id);      
                    data4 = {idAct: id,
                        idInd: $('#idInd').val()
                    };
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        //: "application/x-www-form-urlencoded",
                        //url: "pages/editarPOA.php",
                        //beforeSend: inicioEliminar,
                        success: llegadaEditarActividad,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;

                });


            });



            function llegadaEditarActividad()
            {
                $("#cuerpoEditarActividad").load('pages/editarActividad.php', data4);
                $('#editarActividad').modal('show');
            }


            function inicioVer()
            {
                var x = $("#contenedor");
                x.html('Cargando...');
            }

            function inicioEliminar()
            {
                var x = $("#contenedor2");
                x.html('Cargando...');
            }

            function inicioEnvio()
            {
                var x = $("#contenedor2");
                x.html('Cargando...');
            }

            function llegadaVer()
            {
                $("#contenedor").load('pages/actividad.php', data2);
            }

            function llegadaEliminar()
            {
                $("#contenedor2").load('Datos/eliminarActividad.php', data3);
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