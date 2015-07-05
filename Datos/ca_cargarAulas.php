<?php
include 'conexion.php';

$codigoEdificio = NULL;

if(isset($_POST["codigoEdificio"]))
{
    $codigoEdificio = $_POST["codigoEdificio"];
}
else if(isset($_SESSION["SA_CODIGO_EDIFICIO"]))
{
    $codigoEdificio = $_SESSION["SA_CODIGO_EDIFICIO"];
}


$codigoEdificio = $_POST["codigoEdificio"];

$query = mysql_query("CALL SP_OBTENER_AULAS_POR_EDIFICIO(" . $codigoEdificio . ", @pcMensajeError)", $enlace);

?>
<!DOCTYPE html>
<html lang="en">


    <body>

        <div class="box-body table-responsive">
            <table id="tabla_prioridad" class='table table-bordered table-striped'>
                <thead>
                    <tr>   
                        <th>Código de aula</th>
                        <th>Número de aula</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysql_fetch_array($query)) 
                    {
                        $id = $row['codigo'];
                        ?>
                        <tr>
                            <td><?php echo $row['codigo'] ?></td>
                            <td><div class="text" id="titulo-<?php echo $id ?>"><?php echo $row['numero_aula'] ?></div></td>
                            <td><a class="ver btn btn-success  fa fa-arrow-right "></a>
                                <a class="editarAula btn btn-info fa fa-pencil "></a>
                                <a class="eliminarAula btn btn-danger fa fa-trash-o"></a>
                            </td>
                           
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>


        
        
        
        
<script type="text/javascript">

$(document).ready(function() {
    $('#tabla_prioridad').dataTable({
            
	    "order": [[ 0, "asc" ]],
            "destroy": true,
	    "fnDrawCallback": function( oSettings ) {
		
		}
	}); // example es el id de la tabla
});
 
</script>

<!-- Script necesario para que la tabla se ajuste a el tamanio de la pag-->
<script type="text/javascript">
  // For demo to fit into DataTables site builder...
  $('#tabla_prioridad')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
</script>











    </body>
    

</html>