<?php
	include '../../Datos/conexion.php';
?>

<!DOCTYPE html>
<html lang="utf-8">

<head>

    <meta charset="utf-8">

     <script>

            /* 
             * To change this license header, choose License Headers in Project Properties.
             * To change this template file, choose Tools | Templates
             * and open the template in the editor.
             */

            var x;
            x = $(document);
            x.ready(buscarPersona);
            
            function buscarPersona()
            {
                var x;
                x = $("#persona");
                x.click(buscar);
            }

            function buscar()
            {
                data={
                    idpersona:$('#id_persona').val()
                }
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadabuscar,
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

            function llegadabuscar()
            {
                $("#contenedor2").load('Datos/BuscarPersona.php',data);
                //$("#contenedor").load('../cargarPOAs.php');
            }
            
            function problemas()
            {
                $("#contenedor2").text('Problemas en el servidor.');
            }

        </script>
       
</head>

<body>

<div id="contenedor3" class="panel-body">
        <?php
			include "cargarEmpleadosP.php";
        ?>
 </div>

<!-- /#wrapper -->

<!-- jQuery -->

<!-- Bootstrap Core JavaScript -->

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Flot Charts JavaScript -->

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>

<script type="text/javascript"></script>

</body>

</html>


