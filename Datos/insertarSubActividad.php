<?php
//echo 'hola';
include '../Datos/conexion.php';

$idAct = $_POST['idAct'];
$nombreSub = $_POST['nombreSub'];
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$encargado = $_POST['encargado'];
$porcentaje = $_POST['porcentaje'];
$costo = $_POST['costo'];
$obs = $_POST['obs'];
//echo $idAct;
//echo $encargado;
$consulta = $conectar->prepare("CALL pa_insertar_sub_actividad(?,?,?,?,?,?,?,?)");
$consulta->bind_param('issssiis', $idAct, $nombreSub, $descripcion, $fecha, $encargado, $porcentaje, $costo, $obs);
$resultado = $consulta->execute();

if ($resultado == 1) {
    echo '<div id="resultado3" class="alert alert-success">
        se ha Insertado Una Nueva Sub actividad
         
         </div>';
} else {
    echo '<div id="resultado3" class="alert alert-danger">
        No se Inserto ningun Nuevo elemento 
         
         </div>';
}
?>


<table class="table">
    <thead>
    <th>ID</th>
    <th>Actividad</th>
    <th>Encargado</th>
    <th>Fecha Monitoreo</th>
    <th></th>
</thead>

<?php
$consulta3 = "SELECT * FROM sub_actividad  where idActividad=" . $idAct;
$nombre;
if ($resultado3 = $conectar->query($consulta3)) {

    while ($fila3 = $resultado3->fetch_row()) {
        $consulta4 = "SELECT * FROM persona where N_identidad in(select N_identidad FROM empleado where No_Empleado='" . $fila3[5] . "')";
        if ($resultado4 = $conectar->query($consulta4)) {
            $fila4 = $resultado4->fetch_row();
            $nombre = $fila4[1] . " " . $fila4[2] . " " . $fila4[3] . " " . $fila4[4];


            $resultado4->close();
        }
        ?>



        <tr>
            <td><?php echo $fila3[0] ?></td>
            <td><?php echo $fila3[2] ?></td>
            <td><?php echo $nombre ?></td>
            <td><?php echo $fila3[4] ?></td>

            <td><a class="verSubActividad btn btn-success  fa fa-arrow-right "></a>
                <a class="editar btn btn-info fa fa-pencil "></a>
                <a class="elimina btn btn-danger fa fa-trash-o"></a>
            </td>

        </tr>

        <?php
    }
    $resultado3->close();
}

//$conectar->close();
?>
</table>



<script type="text/javascript">
            $(document).ready(function() {
                setTimeout(function() {
                    $("#resultado3").fadeOut(1500);
                }, 3000);

            });
        </script>
        
         <script>




            $(document).ready(function() {

                
                $(".verSubActividad").click(function(e) {
                    id = $(this).parents("tr").find("td").eq(0).html();
                    data4 = {
                        idAct: $("#idAct").val(),
                        idSubAct: id
                    };
                    //alert($("#nombre").val()); 
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        //contentType: "application/x-www-form-urlencoded",
                        //url: "pages/crearSubActividad.php",
                        //beforeSend:inicioSub,
                        success: llegadaVerSubActividad,
                        timeout: 4000,
                        error: problemasSub
                    });
                    return false;

                });




            });
            
            
           

            function llegadaVerSubActividad()
            {
                $("#contenedor").load('pages/SubActividad.php', data4);
                //$('#myModal2').modal('show');
            }



            function problemasSub()
            {
                $("#nuevaSub").text('Problemas en el servidor.');
            }


           

        </script>