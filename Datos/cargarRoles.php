<?php
$pame = mysql_query("SELECT * FROM roles");
?>
<html lang="es">

    <head>


    </head>

    <body>

        <div class="row">
            <div class="col-lg-12">

                <h1 class="page-header">Lista de Roles</h1>
            </div>
        </div>


        <div class="table-responsive">
            <table id="tabla_roles" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th><strong><center>Nivel Rol</center></strong></th>
                        <th><strong><center>Nombre del Rol</center></strong></th>
                        <th><strong><center>Descripción del Rol</center></strong></th>
                        <th><strong><center>Eliminar</center></strong></th>
                        <th><strong><center>Modificar</center></strong></th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($row = mysql_fetch_array($pame)) {
                        $idRol = $row['Id_Rol'];
                       // $id = $row['ID_Rol'];
                        ?>

                        <tr>
                            <td id="idcargo"><?php echo $idRol ?></td>
                            <td><div class="text" id="nombre-<?php echo $idRol ?>"><?php echo $row['nombre_Rol'] ?></div></td>
                            <td><div class="text" id="descripcion-<?php echo $idRol ?>"><?php echo $row['Descripcion'] ?></div></td>            

                            <td>
                    <center>
                        <button class="elimina btn btn-danger glyphicon glyphicon-trash"></button>

                    </center>
                    </td> 

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
                x.click(editarRol);
            };
            
            
            
            function fn_dar_eliminar(){
          
                $(".elimina").click(function(){
                    idRol = $(this).parents("tr").find("td").eq(0).html();
                    eliminarRol();
                  
                });
            };
            
            
   function eliminarRol(){
        var respuesta=confirm("¿Esta seguro de que desea eliminar el rol seleccionado?");
        if (respuesta){  
             data1 ={ Id_Rol:idRol};
    
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        url:"Datos/eliminarPOA.php",     
        beforeSend:inicioEnvio,
        success:llegadaEliminarRol,
        timeout:4000,
        error:problemas
    }); 
    return false;
        }
} 

                function editarRol()
            {
                var idRol=$(this).parents("tr").find("td").eq(0).html();
 
                 data ={idRol:idRol}; 
                
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaEditarRol,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            }
            


            function inicioEnvio()
            {
                var x = $("#contenedor2");
                x.html('Cargando...');
            }
            
             function llegadaEditarRol()
            {
                $("#contenedor2").load('pages/recursos_humanos/modi_roles.php',data);
                //$("#contenedor").load('../cargarPOAs.php');
            }
            
              function llegadaEliminarRol()
            {
                $("#contenedor2").load('Datos/eliminarRol.php',data1);
                //$("#contenedor").load('../cargarPOAs.php');
            }

            function problemas()
            {
                $("#contenedor2").text('Problemas en el servidor.');
            }



        </script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#tabla_cargo').dataTable(); // example es el id de la tabla
} );
</script>

