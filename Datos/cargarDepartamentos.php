<?php
 $pame = mysql_query("SELECT * FROM departamento_laboral");
?>
<html lang="es">

<head>
       <script>


             $(document).ready(function(){
                fn_eliminar();               
            });

            var x;
            x = $(document);
            x.ready(inicio);
            
            
        
            function inicio()
            {
                var x;
                x = $(".editar");
                x.click(editarDepartamento);
            };
            
            
            
            function  fn_eliminar(){
                    $(".elimina").click(function(){
                    id = $(this).parents("tr").find("td").eq(0).html();
                    eliminarDepartamento();
                  
                });
            };
            
            
   function eliminarDepartamento(){
        var respuesta=confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
        if (respuesta){  
             data ={ IdDepartamento:id, tipoProcedimiento:"eliminar"};
    
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        url:"Datos/eliminarPOA.php",     
        beforeSend:inicioEnvio,
        success:llegadaEliminarDepartamento,
        timeout:4000,
        error:problemas
    }); 
    return false;
        }
} 

                function editarDepartamento()
            {
                var id=$(this).parents("tr").find("td").eq(0).html();
                 data ={idDepartamento:id}; 
                
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaEditarDepartamento,
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
            
             function llegadaEditarDepartamento()
            {
                $("#contenedor").load('pages/recursos_humanos/modi_departamento.php',data);
                //$("#contenedor").load('../cargarPOAs.php');
            }
            
              function llegadaEliminarDepartamento()
            {
                $("#contenedor").load('pages/recursos_humanos/Departamentos.php',data);
                //$("#contenedor").load('../cargarPOAs.php');
            }

            function problemas()
            {
                $("#contenedor").text('Problemas en el servidor.');
            }



        </script>
 <script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#tablaDepartamento').dataTable(); // example es el id de la tabla
} );
</script>

 
</head>

<body>
    
    <div class="row">
        <div class="col-lg-12">

            <h1 class="page-header">Lista de Departamento</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

   
    <div class="table-responsive">
        <table id="tablaDepartamento" class="table table-bordered table-hover table-striped">
            <thead>
        <tr>
            <th><strong><center>ID Departamento</center></strong></th>
            <th><strong><center>Nombre del Departamento</center></strong></th>
            <th><strong><center>Eliminar</center></strong></th>
            <th><strong><center>Modificar</center></strong></th>

        </tr>
            </thead>
      <tbody>
          
        <?php
        while ($row = mysql_fetch_array($pame)) {
            $id = $row['Id_departamento_laboral'];
         ?>
            
          <tr>
                  <td id="id"><?php echo $id ?></td>
                  <td><div class="text" id="nombre-<?php echo $id ?>"><?php echo $row['nombre_departamento'] ?>
                      </div></td>

<?php
     if($_SESSION['user_rol'] != 100){
        echo'          <td>
          <center>
              <button class="elimina btn btn-danger glyphicon glyphicon-trash" disabled="TRUE"></button>

          </center>
            </td> ';
     }  else {
       echo '    <td>
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

   <?php } ?>
 </tbody>
    </table>

    </div>
</body>

</html>

