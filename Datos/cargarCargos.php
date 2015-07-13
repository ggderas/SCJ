<?php
$pame = mysql_query("SELECT * FROM cargo");

 if(isset($_GET['contenido']))
    {
      $contenido = $_GET['contenido'];
    }
  else
    {
      $contenido = 'recursos_humanos';
    }

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");

?>
<html lang="es">

    <head>


    </head>

    <body>

        <div class="row">
            <div class="col-lg-12">

                <h1 class="page-header">Lista de Cargos</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>


        <div class="table-responsive">
            <table id="tabla_cargo" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th><strong><center>ID Cargo</center></strong></th>
                        <th><strong><center>Nombre del Cargo</center></strong></th>
                        <th><strong><center>Eliminar</center></strong></th>
                        <th><strong><center>Modificar</center></strong></th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($row = mysql_fetch_array($pame)) {
                        $idCargo = $row['ID_cargo'];
                        ?>

                        <tr>
                            <td id="idcargo"><?php echo $idCargo ?></td>
                            <td><div class="text" id="nombre-<?php echo $idCargo ?>"><?php echo $row['Cargo'] ?></div></td>

<?php
             if($_SESSION['user_rol'] != 100){
              echo'              <td>
                    <center>
                        <button class="elimina btn btn-danger glyphicon glyphicon-trash" disabled="TRUE"></button>

                    </center>
                    </td> ';
             }else{
               echo     '  <td>
                    <center>
                        <button class="elimina btn btn-danger glyphicon glyphicon-trash"></button>

                    </center>
                    </td> ';
                 
                 
             }
                                    
  ?>

                    <td>

                    <center>

                        <button   type="button"  id="editar" href="#" class="editar btn btn-primary glyphicon glyphicon-edit" >

                        </button>
                    </center>

                    </td>


                    </tr>

                    <!-- aqui Omar -->



                <?php } ?>
                </tbody>
            </table>

        </div>


    </body>

</html>


  <script>
             $(document).ready(function(){
                fn_dar_eliminar();               
            });

            var x;
            x = $(document);
            x.ready(inicio);
            
            
        
            function inicio()
            {
                var x;
                x = $(".editar");
                x.click(editarCargo);
            };
            
            
            
            function fn_dar_eliminar(){
          
                $(".elimina").click(function(){
                    idCargo = $(this).parents("tr").find("td").eq(0).html();
                    eliminarCargo();
                  
                });
            };
            
            
   function eliminarCargo(){
        var respuesta=confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
        if (respuesta){  
             data1 ={ ID_cargo:idCargo,tipoProcedimiento:"eliminar"};
    
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        url:"Datos/eliminarPOA.php",     
        beforeSend:inicioEnvio,
        success:llegadaEliminarCargo,
        timeout:4000,
        error:problemas
    }); 
    return false;
        }
} 

                function editarCargo()
            {
                var idCargo=$(this).parents("tr").find("td").eq(0).html();
 
                 data ={idCargo:idCargo}; 
                
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaEditarCargo,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            }
            


            function inicioEnvio()
            {
                var x = $("#contenedor");
                x.html('Cargando...');
            }
            
             function llegadaEditarCargo()
            {
                $("#contenedor").load('pages/recursos_humanos/modi_cargos.php',data);
                //$("#contenedor").load('../cargarPOAs.php');
            }
            
              function llegadaEliminarCargo()
            {
                $("#contenedor").load('pages/recursos_humanos/Cargos.php',data1);
                //$("#contenedor").load('../cargarPOAs.php');
            }

            function problemas()
            {
                $("#contenedor").text('Problemas en el servidor.');
            }



        </script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#tabla_cargo').dataTable(); // example es el id de la tabla
} );
</script>

