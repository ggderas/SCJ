<?php
$pame = mysql_query("SELECT * FROM clases");

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
        <script>


            $(document).ready(function() {
                fn_eliminar();
            });

            var x;
            x = $(document);
            x.ready(inicio);

            function inicio()
            {
                var x;
                x = $(".editar");
                x.click(editarClase);
            }
            ;



            function  fn_eliminar() {
                $(".elimina").click(function() {
                    id = $(this).parents("tr").find("td").eq(0).html();
                    eliminarClase();

                });
            }
            ;


            function eliminarClase() {
                var respuesta = confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
                if (respuesta) {
                    data = {IdClase: id,tipoProcedimiento:"eliminar" };

                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "Datos/eliminarPOA.php",
                        beforeSend: inicioEnvio,
                        success: llegadaEliminarClase,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;
                }
            }

            function editarClase()
            {
                var id = $(this).parents("tr").find("td").eq(0).html();
                data = {idClase: id};


                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaEditarClase,
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

            function llegadaEditarClase()
            {
                $("#contenedor").load('pages/recursos_humanos/modi_clases.php', data);
                //$("#contenedor").load('../cargarPOAs.php');
            }

            function llegadaEliminarClase()
            {
                $("#contenedor").load('pages/recursos_humanos/Clases.php', data);
                //$("#contenedor").load('../cargarPOAs.php');
            }

            function problemas()
            {
                $("#contenedor").text('Problemas en el servidor.');
            }



        </script>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                $('#tablaClases').dataTable(); // example es el id de la tabla
            });
        </script>

       <body>

    <div class="row">
        <div class="col-lg-12">

            <h1 class="page-header">Lista de Clases</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="table-responsive">
        <table id="tablaClases" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>

                    <td><strong><center>ID Clase</center></strong></td>
                    <td><strong><center>Nombre Clase</strong></td>
                    <td><strong><center>Eliminar</strong></center></td>
                    <td><strong><center>Actualizar</strong></center></td>

                </tr>

            </thead>
            <tbody>

                <?php
                while ($row = mysql_fetch_array($pame)) {
                    $id = $row['ID_Clases'];
                    ?>

                    <tr>
                        <td id="id"><?php echo $id ?></td>
                        <td><div class="text" id="nombre-<?php echo $id ?>"><?php echo $row['Clase'] ?>
                            </div></td>

<?php

  if($_SESSION['user_rol'] != 100){
           echo'      <td>
                <center>
                    <button class="elimina btn btn-danger glyphicon glyphicon-trash" disabled="TRUE"></button>

                </center>
                </td> ';
  }else{
      
          echo'      <td>
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

