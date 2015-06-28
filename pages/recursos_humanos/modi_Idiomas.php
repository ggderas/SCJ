<?php

include '../../Datos/conexion.php';



if (isset($_POST['pid'])) {

    $codigo = $_POST['pid'];
    $pa = mysql_query("SELECT * FROM idioma WHERE ID_Idioma='$codigo'");
    if ($row = mysql_fetch_array($pa)) {
        $existe = TRUE;
        $id = $row['ID_Idioma'];
        $nombre_Idioma = $row['Idioma'];
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

   

            var x;
            x = $(document);
            x.ready(inicio);
            
            
        
            function inicio()
            {
              
                 var x;
                x = $("#actualizarI");
                x.click(editarIdioma);
            };
            
   

                function editarIdioma()
            {
                var respuesta=confirm("�Esta seguro de que desea Realizar cambios en registro seleccionado?");
                 if (respuesta){  
                     
                     
                     
              
                 data ={
                        idioma:$("#idioma2").val(),
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
                    success: llegadaEditarIdioma,
                    timeout: 4000,
                    error: problemas
                });
            
                return false;
            }
            }
            


            function inicioEnvio()
            {
                var x = $("#contenedor");
                x.html('Cargando...');
            }
            
             function llegadaEditarIdioma()
            {
                $("#contenedor").load('pages/recursos_humanos/Idiomas.php',data);
                //$("#contenedor").load('../cargarPOAs.php');
            }
         

            function problemas()
            {
                $("#contenedor").text('Problemas en el servidor.');
            }



        </script>
    
    
	

</head>

<body>



    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Editar Idioma</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Llene los campos a continuaci�n solicitados
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">

                            <form role="form" action="" method='POST'>

                                <div class="form-group">

                                    <label>ID Idioma</label>

                                    <input type="text" id="codigo2" class="form-control" autocomplete="off" value="<?php echo $id; ?>" disabled>


                                </div>


                                <div class="form-group">
                                    <label>Nombre del Idioma</label>
                                    <input type="text" id="idioma2" class="form-control" autocomplete="off" value="<?php echo $nombre_Idioma; ?>" required><br>

                                </div>






                                <button id="actualizarI" class="btn btn-primary" class="icon-ok" >Actualizar</button>


                                <button type="reset" class="btn btn-default"   >Cancelar</button>










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