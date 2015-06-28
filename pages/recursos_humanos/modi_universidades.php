<?php


include '../../Datos/conexion.php';

        if (isset($_POST['codigo'])) 
    {
	$codigo=$_POST['codigo'];
        $pa=mysql_query("SELECT * FROM universidad inner join pais on pais.Id_pais=universidad.Id_pais WHERE Id_universidad='$codigo'");			  
		if($row=mysql_fetch_array($pa)){
			$codigo=$row['Id_universidad'] ;
			$nombre=$row['nombre_universidad'] ;
			$ID_pais= $row['Nombre_pais'];
						
		}	 
    }else{
        
        echo "no entro";
        
    }

?>


<!--mysql_connect("localhost","root",""); 
mysql_select_db("sistema_ciencias_juridicas"); -->


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
 

    <title>Actualizar Universidad - Administrativo</title>
    
     <script>

   

            var x;
            x = $(document);
            x.ready(inicio);
            
            
        
            function inicio()
            {
              
                 var x;
                x = $("#actualizarU");
                x.click(editarUni);
                
                
                var x;
                x = $("#cancelarU");
                x.click(editarcancel);
                
                
                
            };
            
   

                function editarUni()
            {
                var respuesta=confirm("¿Esta seguro de que desea Realizar cambios en registro seleccionado?");
                 if (respuesta){  
                 
              
                 data ={nombre2:$("#nombre2").val(),
                        pais2:$("#pais2").val(),
                        codigo:$("#codigo").val(),
                        tipoProcedimiento:"actualizar"
                    }; 
                
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                 //  url:"pages/recursos_humanos/modi_universidad.php",  
                    beforeSend: inicioEnvio,
                    success: llegadaEditarUni,
                    timeout: 4000,
                    error: problemas
                });
            
                return false;
            }
            }
            
                       function editarcancel()
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
                    success: llegadaEditarUni,
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
            
             function llegadaEditarUni()
            {
                $("#contenedor").load('pages/recursos_humanos/universidades.php',data);
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
                <h1 class="page-header">Actualizacion de datos Universidad</h1>
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

                                        <label>ID Universidad</label>

                                        <input type="text" id="codigo" class="form-control" autocomplete="off" required value="<?php echo $codigo; ?>"  disabled>


                                    </div>


                                    <div class="form-group">
                                        <label>Nombre de la Universidad</label>
                                        <input type="text" id="nombre2" class="form-control" autocomplete="off" required value="<?php echo $nombre; ?>"><br>

                                    </div>

                                    <div class="form-group">

                                        <label>Pais Actual</label>

                                        <input type="text" name="id" class="form-control" autocomplete="off" required value="<?php echo $ID_pais; ?>"  disabled>


                                    </div>



                                    <div class="form-group">
                                        <label>Cambiar Pais a: </label>

                                        <select id='pais2' class="form-control">
                                            <?php
                                            $consulta_mysql = "SELECT * FROM `pais`";
                                            $rec = mysql_query($consulta_mysql);



                                            while ($row = mysql_fetch_array($rec)) {
                                                echo "<option value = '" . $row['Id_pais'] . "'>";

                                                echo $row["Nombre_pais"];

                                                echo "</option>";
                                            }
                                            ?>
                                        </select>

                                    </div>


                                    <form action="" method='POST' >
                                        
                                        <button id="actualizarU" class="btn btn-primary" class="icon-ok" >Actualizar</button>


                                        <button id="cancelarU" type="button" class="btn btn-default" >Cancelar</button>

                                    </form>








                                </form>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-6">
                                <form role="form">
                                    <fieldset enabled>

                                        <h4>Ejemplo Universidades </h4>
                                        <ol>
                                            <li>UNAH</li>
                                            <li>Unitec</li>
                                            <li>José Cecilio del Valle</li>
                                        </ol>										 
                                    </fieldset>
                                </form>
                            </div>
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