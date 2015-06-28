<?php

include '../../Datos/conexion.php';



if (isset($_POST['idCargo'])) {

    $codigo = $_POST['idCargo'];
    $pame = mysql_query("SELECT * FROM cargo WHERE ID_cargo='$codigo'");
    if ($row = mysql_fetch_array($pame)) {
        $existe = TRUE;
        $id = $row['ID_cargo'];
        $cargo = $row['Cargo'];
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
                x.click(editarCargo);
            };
            
   

                function editarCargo()
            {
                var respuesta=confirm("¿Esta seguro de que desea Realizar cambios en registro seleccionado?");
                 if (respuesta){  
    
                 data ={
                        cargo:$("#cargo").val(),
                        idCargo:$("#id").val(),
                        tipoProcedimiento:"actualizar"
                    }; 
                
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                 //  url:"pages/recursos_humanos/modi_universidad.php",  
                    beforeSend: inicioEnvio,
                    success: llegadaEditarCargo,
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
            
             function llegadaEditarCargo()
            {
                $("#contenedor").load('pages/recursos_humanos/Cargos.php',data);
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
            <h1 class="page-header">Editar Cargos</h1>
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

                                    <label>Id Cargo</label>

                                    <input type="text" id="id" class="form-control" autocomplete="off" value="<?php echo $id; ?>" disabled>


                                </div>


                                <div class="form-group">
                                    <label>Nombre del Cargo</label>
                                    <input type="text" id="cargo" class="form-control" autocomplete="off" value="<?php echo $cargo; ?>" required><br>

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