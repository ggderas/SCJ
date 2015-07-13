<?php

include '../../Datos/conexion.php';



if (isset($_POST['idRol'])) {

    $id = $_POST['idRol'];
    $pame = mysql_query("SELECT * FROM roles WHERE Id_Rol='$id'");
    if ($row = mysql_fetch_array($pame)) {
        $existe = TRUE;
        $id = $row['Id_Rol'];
        $nombre = $row['nombre_Rol'];
        $descripcion = $row['Descripcion'];
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
                x.click(editarRol);
            };
            
   

                function editarRol()
            {
                var respuesta=confirm("¿Esta seguro de que desea Realizar cambios en registro seleccionado?");
                 if (respuesta){  
    
                 data ={
                        nombre:$("#nombre").val(),
                        descripcion:$("#descripcionrol").val(),
                        idRol:$("#id").val()
                    }; 
                
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                 //  url:"pages/recursos_humanos/modi_universidad.php",  
                    beforeSend: inicioEnvio,
                    success: llegadaEditarRol,
                    timeout: 4000,
                    error: problemas
                });
            
                return false;
            }
            }
            


            function inicioEnvio()
            {
                var x = $("#contenedor2");
                x.html('Cargando...');
            }
            
             function llegadaEditarRol()
            {
                $("#contenedor2").load('Datos/actualizarRoles.php',data);
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
            <h1 class="page-header">Editar Roles</h1>
        </div>
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

                                    <label>Id Rol</label>

                                    <input type="text" id="id" class="form-control" autocomplete="off" value="<?php echo $id; ?>" disabled>
                                </div>


                                <div class="form-group">
                                    <label>Nombre del Rol</label>
                                    <input type="text" id="nombre" class="form-control" autocomplete="off" value="<?php echo $nombre; ?>" required><br>

                                    <label>Descripción del Rol</label>
                                    <input type="text" id="descripcionrol" class="form-control" autocomplete="off" value="<?php echo $descripcion; ?>" required><br>
                                </div>
                                <button id="actualizar" class="btn btn-primary" class="icon-ok" >Actualizar</button>
                                <button type="reset" class="btn btn-default"   >Cancelar</button>
                            </form>
                        </div>
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