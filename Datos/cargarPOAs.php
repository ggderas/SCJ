<?php
include '../Datos/conexion.php';

$query = mysql_query("SELECT * FROM poa  ORDER BY fecha_Fin", $enlace);
?>
<!DOCTYPE html>
<html lang="en">


    <body>

        <div class="box-body table-responsive">
            <table id="tabla_prioridad" class='table table-bordered table-striped'>
                <thead>
                    <tr>   
                        <th>id</th>
                        <th>Titulo</th>
                        <th>DEL</th>
                        <th>Al</th>
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysql_fetch_array($query)) {
                        $id = $row['id_Poa'];
                        ?>
                        <tr>
                            <td><?php echo $row['id_Poa'] ?></td>
                            <td><div class="text" id="titulo-<?php echo $id ?>"><?php echo $row['nombre'] ?></div></td>
                            <td><div class="text" id="del-<?php echo $id ?>"><?php echo $row['fecha_de_Inicio'] ?></div></td>
                            <td><div class="text" id="al-<?php echo $id ?>"><?php echo $row['fecha_Fin'] ?></div></td>
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