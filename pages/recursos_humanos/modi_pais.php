<?php

include '../../Datos/conexion.php';



if (isset($_POST['pid'])) {

    $codigo = $_POST['pid'];
    $pa = mysql_query("SELECT * FROM pais WHERE Id_pais='$codigo'");
    if ($row = mysql_fetch_array($pa)) {
        $existe = TRUE;
        $id = $row['Id_pais'];
        $nombre_pais = $row['Nombre_pais'];
    }
}
?>
<!--mysql_connect("localhost","root",""); 
mysql_select_db("sistema_ciencias_juridicas"); -->


<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    
    
     <script>

    $(document).ready(function(){
        $("form").submit(function(e) {
            e.preventDefault();
            
              var x;
                x = $("#actualizarP");
                x.click(editarPais);
                
                var x;
                x = $("#cancelarP");
                x.click(cancelarPais);
            
        });
    });


                function editarPais()
            {
                var respuesta=confirm("¿Esta seguro de que desea Realizar cambios en registro seleccionado?");
                 if (respuesta){  
                     
                     
                     
              
                 data ={
                        pais:$("#pais2").val(),
                        codigo:$("#codigo2").val(),
                        tipoProcedimiento:"actualizar"
                    }; 
                
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                 //  url:"pages/recursos_humanos/modi_universidad.php",  
                    beforeSend: inicioEnvio,
                    success: llegadaEditarPais,
                    timeout: 4000,
                    error: problemas
                });
            
                return false;
            }
            }
            
              function cancelarPais()
            {
                
                     
                     
                     
              
                 data ={
                       
                    }; 
                
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                 //  url:"pages/recursos_humanos/modi_universidad.php",  
                    beforeSend: inicioEnvio,
                    success: cancelareditarP,
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
            
             function llegadaEditarPais()
            {
                $("#contenedor").load('pages/recursos_humanos/Pais.php',data);
                //$("#contenedor").load('../cargarPOAs.php');
            }
            
              function cancelareditarP()
            {
                $("#contenedor").load('pages/recursos_humanos/Pais.php');
                //$("#contenedor").load('../cargarPOAs.php');
            }
         

            function problemas()
            {
                $("#contenedor2").text('Problemas en el servidor.');
            }



        </script>
    
    
	

</head>

<body>



    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Editar Pais</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Llene los campos a continuación solicitados
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">

                            <form role="form" action="" method='POST'>

                                <div class="form-group">

                                    <label>ID Pais</label>

                                    <input type="text" id="codigo2" class="form-control" autocomplete="off" value="<?php echo $id; ?>" disabled>


                                </div>


                                <div class="form-group">
                                    <label>Nombre del pais</label>
                                    <input type="text" id="pais2" class="form-control" autocomplete="off" value="<?php echo $nombre_pais; ?>" required><br>

                                </div>






                                <button id="actualizarP" class="btn btn-primary" class="icon-ok" >Actualizar</button>


                                <button id="cancelarP" type="reset" class="btn btn-default"   >Cancelar</button>










                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>




</body>

</html>