<?php

include '../Datos/conexion.php';
$idAct = $_POST['idAct'];
$costo=$_POST['costo'];
$pond=$_POST['pond'];
$tri=$_POST['tri'];
$obs=$_POST['obs'];

$consulta = $conectar->prepare("CALL pa_insertar_costo_porcentaje_actividad_por_trimestre(?,?,?,?,?)");
$consulta->bind_param('iiisi', $idAct, $costo, $pond, $obs, $tri);
$resultado = $consulta->execute();

if ($resultado == 1) {
    echo '<div id="resultado" class="alert alert-success">
        Se ha Insertado Correctamente
         
         </div>';
} else {
    echo '<div id="resultado" class="alert alert-danger">
        No se Inserto ningun Nuevo elemento 
         
         </div>';
}
?>


<table class="table">
    <thead>
    <th>ID</th>
    <th>Costo</th>
    <th>Porcentaje</th>
    <th>Trimestre</th>
    <th>Observacion</th>
    <th></th>
</thead>

<?php
$consulta3 = "SELECT * FROM costo_porcentaje_actividad_por_trimestre  where id_Actividad=" . $idAct;
$nombre;
if ($resultado3 = $conectar->query($consulta3)) {

    while ($fila3 = $resultado3->fetch_row()) {
        
        ?>



        <tr>
            <td><?php echo $fila3[0] ?></td>
            <td><?php echo $fila3[2] ?></td>
            <td><?php echo $fila3[3] ?></td>
            <td><?php echo $fila3[5] ?></td>
            <td><?php echo $fila3[4] ?></td>

            <td>
                <a class="editar btn btn-info fa fa-pencil "></a>
                
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
            $("#resultado").fadeOut(1500);
        }, 3000);

    });
</script>