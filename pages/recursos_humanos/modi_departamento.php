<?php

include '../../Datos/conexion.php';



if (isset($_POST['idDepartamento'])) {

    $idD = $_POST['idDepartamento'];
    $pame = mysql_query("SELECT * FROM departamento_laboral WHERE Id_departamento_laboral='$idD'");
    if ($row = mysql_fetch_array($pame)) {
        $existe = TRUE;
        $id = $row['Id_departamento_laboral'];
        $nombre_departamento = $row['nombre_departamento'];
    }
}
?>

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
                x = $("#actualizar");
                x.click(editarDepartamento);
            };
            
   

                function editarDepartamento()
            {
                var respuesta=confirm("¿Esta seguro de que desea Realizar cambios en registro seleccionado?");
                 if (respuesta){  
 
                 data ={
                        departamento:$("#depto").val(),
                        id:$("#id").val(),
                        tipoProcedimiento:"actualizar"
                    }; 
                
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                 //  url:"pages/recursos_humanos/modi_universidad.php",  
                    beforeSend: inicioEnvio,
                    success: llegadaEditarDepartamento,
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
            
             function llegadaEditarDepartamento()
            {
                $("#contenedor").load('pages/recursos_humanos/Departamentos.php',data);
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
            <h1 class="page-header">Editar Departamento</h1>
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

                                    <label>ID Departamento</label>

                                    <input type="text" id="id" class="form-control" autocomplete="off" value="<?php echo $id; ?>" disabled>


                                </div>


                                <div class="form-group">
                                    <label>Nombre del Departamento</label>
                                    <input type="text" id="depto" class="form-control" autocomplete="off" value="<?php echo $nombre_departamento; ?>" required><br>

                                </div>


                                <button id="actualizar" class="btn btn-primary" class="icon-ok" >Actualizar</button>


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