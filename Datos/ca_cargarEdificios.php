<?php
include 'conexion.php';

$query = mysql_query("CALL SP_OBTENER_EDIFICIOS(@pcMensajeError)", $enlace);

?>
<!DOCTYPE html>
<html lang="en">


    <body>

        <div class="box-body table-responsive">
            <table id="tabla_prioridad" class='table table-bordered table-striped'>
                <thead>
                    <tr>   
                        <th>Código de edificio</th>
                        <th>Nombre</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysql_fetch_array($query)) 
                    {
                        $id = $row['Edificio_ID'];
                        ?>
                        <tr>
                            <td><?php echo $row['Edificio_ID'] ?></td>
                            <td><div class="text" id="titulo-<?php echo $id ?>"><?php echo $row['descripcion'] ?></div></td>
                            <td><a class="ver btn btn-success  fa fa-arrow-right "></a>
                                <a class="editar btn btn-info fa fa-pencil "></a>
                                <a class="elimina btn btn-danger fa fa-trash-o"></a>
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