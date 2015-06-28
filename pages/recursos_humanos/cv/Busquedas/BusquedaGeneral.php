<?php
require_once('../../../../Datos/conexion.php');

 $consulta1 = "select Tipo_estudio from tipo_estudio";
 $resultado1 = mysql_query($consulta1);
 $tipo_estudio = mysql_fetch_array($resultado1);
 

?>


    <head>    
         <script>
 
          $( document ).ready(function() {

           $("#form").submit(function(e) {
               e.preventDefault();

                data={
                    licencitura:$('#lic').val(),
                    maestria:$("#maestr").val(),
                    doctorado:$("#doc").val()
                   
                };
            
            $.ajax({
                   async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: busqueda,
                    success: llegadaBusqueda,
                    timeout: 4000,
                    error: problemasbusqueda
            }); 
            return false;
               
	});

              $("#form3").submit(function(e) {
	        e.preventDefault();

            data2={
                cargo: $('#car').val()
                };

            $.ajax({
                   async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: busqueda,
                    success: llegadaBusquedaCargo,
                    timeout: 4000,
                    error: problemasbusqueda
            });
            return false;

	});
     

              $("#form5").submit(function(e) {
	        e.preventDefault();

            data3={
                clase: $('#clase').val()
                };

            $.ajax({
                   async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: busqueda,
                    success: llegadaBusquedaClase,
                    timeout: 4000,
                    error: problemasbusqueda
            });
            return false;

	});
        
        
    
        

   });
            
            

           
   


            function busqueda()
            {
                var x = $("#contenedor2");
                x.html('Cargando...');
            }

            function llegadaBusqueda()
            {
                $("#contenedor2").load('pages/recursos_humanos/cv/Busquedas/consultaRH.php',data);
                
            }

              function llegadaBusquedaCargo()
              {
                  $("#contenedor2").load('pages/recursos_humanos/cv/Busquedas/consultaRH.php',data2);

              }

       

          function llegadaBusquedaClase()
          {
              $("#contenedor2").load('pages/recursos_humanos/cv/Busquedas/consultaRH.php',data3);

          }
            
            function problemasbusqueda()
            {
                $("#contenedor2").text('Problemas en el servidor.');
            }

      

            

         </script>
        
        
    </head>



    
    

    
    
    

<div id="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Busqueda general</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
 
    
    
 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Busqueda por Tipo de Estudio
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
       
          
                     <form role="form" id="form" action="#" method="POST">

                                               <div class="form-group">
                                    <label class="col-lg-6"><h5><strong>Licenciatura :</strong></h5></label>
                               

                                   <div class="col-lg-6">
                                       <select name="lic" class="form-control" id="lic" required>
                                        
                                       
                                        <option value=-1>Ninguna</option>

                                        <?php
                                        $consulta_mysql = "SELECT distinct nombre_titulo FROM `estudios_academico` inner join tipo_estudio on estudios_academico.ID_Tipo_estudio=tipo_estudio.ID_Tipo_estudio where tipo_estudio.tipo_estudio='licenciatura'";
                                        $resultado3 = mysql_query($consulta_mysql);
                                        //$rec=mysql_fetch_array($resultado3);



                                        while ($row = mysql_fetch_array($resultado3)) {

                                          
                                                
                                            
                                                echo "<option value = '" . $row['nombre_titulo'] . "'>";
                                            

                                            echo $row["nombre_titulo"];

                                            echo "</option>";
                                        }
                                        ?>



                                    </select>
                                </div>
                               </div>
                                
                                <br>
                                <br>
                                <br>
                                
                                           <div class="form-group">
                                    <label class="col-lg-6"><h5><strong>Maestria :</strong></h5></label>
                               

                                   <div class="col-lg-6">
                                       <select name="maestr" class="form-control" id="maestr" required>
                                        
                                       
                                        <option value=-1>Ninguna</option>

                                        <?php
                                        $consulta_mysql = "SELECT distinct nombre_titulo FROM `estudios_academico` inner join tipo_estudio on estudios_academico.ID_Tipo_estudio=tipo_estudio.ID_Tipo_estudio where tipo_estudio.tipo_estudio='Maestria'";
                                        $resultado3 = mysql_query($consulta_mysql);
                                        //$rec=mysql_fetch_array($resultado3);



                                        while ($row = mysql_fetch_array($resultado3)) {

                                       
                                            echo "<option value = '" . $row['nombre_titulo'] . "'>";
                                            

                                            echo $row["nombre_titulo"];

                                            echo "</option>";
                                        }
                                        ?>



                                    </select>
                                </div>
                               </div>
                                
                                
                                <br>
                                <br>
                                
                                
                                
                                
                                                 <div class="form-group">
                                    <label class="col-lg-6"><h5><strong>Doctorado :</strong></h5></label>
                               

                                   <div class="col-lg-6">
                                       <select name="doc" class="form-control" id="doc" required>
                                        
                                         
                                        <option value=-1>Ninguno</option>

                                        <?php
                                        $consulta_mysql = "SELECT distinct nombre_titulo FROM `estudios_academico` inner join tipo_estudio on estudios_academico.ID_Tipo_estudio=tipo_estudio.ID_Tipo_estudio where tipo_estudio.tipo_estudio='Doctorado'";
                                        $resultado3 = mysql_query($consulta_mysql);
                                        //$rec=mysql_fetch_array($resultado3);



                                        while ($row = mysql_fetch_array($resultado3)) {

                            
                                           echo "<option value = '" . $row['nombre_titulo'] . "'>";
                                           

                                            echo $row["nombre_titulo"];

                                            echo "</option>";
                                        }
                                        ?>



                                    </select>
                                </div>
                               </div>
                                
                                
                                
                                <br>
                                <br>
                                
                              
                              <button type="submit" name="submit"  id="submit" class="submit btn btn-primary glyphicon glyphicon-search" > Buscar</button>
                           


                            </form>
          
          
      </div>
    </div>
  </div>
    </div>
    
    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Busqueda por Experiencia Laboral 
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
          
          
           <form role="form" id="form3" action="#" method="POST">

                                        <div class="form-group">
                                            <label class="col-lg-6"><h5><strong>Cargo:</strong></h5></label>


                                            <div class="col-lg-6">
                                                <select name="car" class="form-control" id="car" required>


                                                    <option value=-1>Ninguna</option>

                                                    <?php
                                                    $consulta_mysql = "SELECT * FROM cargo";
                                                    $resultado3 = mysql_query($consulta_mysql);
                                                    //$rec=mysql_fetch_array($resultado3);



                                                    while ($row = mysql_fetch_array($resultado3)) {




                                                        echo "<option value = '" . $row['Cargo'] . "'>";


                                                        echo $row["Cargo"];

                                                        echo "</option>";
                                                    }
                                                    ?>



                                                </select>
                                            </div>
                                        </div>

                                        <br>
                                        <br>
                                        <br>

                                        <button type="submit" name="submit"  id="submit" class="submit btn btn-primary glyphicon glyphicon-search" > Buscar</button>



                                    </form>
     
      </div>
    </div>
  </div>
    
    
        <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Busqueda por Experiencia Académica
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
          
          
                <form role="form" id="form5" action="#" method="POST">

                                        <div class="form-group">
                                            <label class="col-lg-6"><h5><strong>Clase:</strong></h5></label>


                                            <div class="col-lg-6">
                                                <select name="clase" class="form-control" id="clase" required>


                                                    <option value=-1>Ninguna</option>

                                                    <?php
                                                    $consulta_mysql = "SELECT distinct Clase FROM clases";
                                                    $resultado3 = mysql_query($consulta_mysql);
                                                    //$rec=mysql_fetch_array($resultado3);



                                                    while ($row = mysql_fetch_array($resultado3)) {




                                                        echo "<option value = '".$row['Clase']."'>";


                                                        echo $row["Clase"];

                                                        echo "</option>";
                                                    }
                                                    ?>



                                                </select>
                                            </div>
                                        </div>

                                        <br>
                                        <br>
                                        <br>

                                        <button type="submit" name="submit"  id="submit" class="submit btn btn-primary glyphicon glyphicon-search" > Buscar</button>



                                    </form>
     
      </div>
    </div>
  </div>
    

</div>      

    

         
      

      
 
 <div id="contenedor2" class="panel-body">
        <?php
        
       

      require_once("../../../../Datos/cargarPersonas.php");
         
     
        ?>
 </div>
    
            
 
     
    
    
   