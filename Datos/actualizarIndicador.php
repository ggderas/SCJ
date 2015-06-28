<?php
include '../Datos/conexion.php';

$idInd= $_POST['idInd'];
$idObj = $_POST['idObj'];
$nombre= $_POST['nombre'];
$def = $_POST['def'];

//echo $def."  ".$nombre." ".$idInd." ".$idObj;

$consulta = $conectar->prepare("CALL pa_modificar_indicador(?,?,?,?)");
$consulta->bind_param('iiss',$idInd, $idObj, $nombre, $def);
$resultado = $consulta->execute();

if ($resultado == 1) {
    echo '<div id="resultado" class="alert alert-success">
        se ha Actualizado un Nuevo Elemento
         
         </div>';
} else {
    echo '<div id="resultado" class="alert alert-danger">
        No se Actualizo ningun  elemento 
         
         </div>';
}



$query = mysql_query("SELECT objetivos_institucionales.id_Objetivo,indicadores.id_Indicadores,indicadores.nombre,indicadores.descripcion FROM indicadores inner join objetivos_institucionales on indicadores.id_ObjetivosInsitucionales = objetivos_institucionales.id_Objetivo where indicadores.id_ObjetivosInsitucionales='" . $idObj . "'", $enlace);
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
        <?php
//include '../Datos/cargarIndicadores.php'; 
//include '../Datos/conexion.php';
// aqui falta aplicar el filtro para que solo carge los indicadores de un solo objetivo
        $query = mysql_query("SELECT objetivos_institucionales.id_Objetivo,indicadores.id_Indicadores,indicadores.nombre,indicadores.descripcion FROM indicadores inner join objetivos_institucionales on indicadores.id_ObjetivosInsitucionales = objetivos_institucionales.id_Objetivo where indicadores.id_ObjetivosInsitucionales='" . $idObj . "'", $enlace);
        ?>

        <div class="panel-body">
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
            <!-- /.table-responsive -->
        </div>



        <script>

            $(document).ready(function() {



                $(".verIndicador").click(function() {
                    id = $(this).parents("tr").find("td").eq(0).html();
                    // alert(id);      
                    data = {ide: id};
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "pages/crearActividad.php",
                        beforeSend: inicioVer,
                        success: llegadaVer,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;
                });
                $(".eliminarIndicador").click(function() {
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
                            url: "Datos/eliminarIndicador.php",
                            beforeSend: inicioEliminar,
                            success: llegadaEliminar,
                            timeout: 4000,
                            error: problemas
                        });
                        return false;
                    }
                });

                $(".editarIndicador").click(function() {


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


            });


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
