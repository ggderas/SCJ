<?php

$queryCE = mysql_query("SELECT * FROM persona where N_identidad not in (select N_identidad from empleado)");

?>



        <script>


               $(document).ready(function(){
                  fn_dar_eliminar();               
            });

            var x;
            x = $(document);
            x.ready(inicio);



            function inicio()
            {
               
                var x;
                x = $(".editarb");
                x.click(editarE);
                
                 var x;
                x = $(".editaripb");
                x.click(editarinfoPE);
                
                
                

                var x;
                x = $(".verb");
                x.click(VerPerfil);
            };
            



            function fn_dar_eliminar() {

                $(".elimina").click(function() {
                    id1 = $(this).parents("tr").find("td").eq(0).html();



                    eliminarE();

                });
            };
           


            function eliminarE() {
                var respuesta = confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
                if (respuesta) {
                    data1 = {codigoE: id1};

                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "Datos/eliminarUniversidad.php",
                        beforeSend: inicioEnvio,
                        success: EliminarEmpleado,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;
                }
            };





            function editarE()
            {
                var pid = $(this).parents("tr").find("td").eq(0).html();
               

                data = {identi: pid};


                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    //  url:"pages/recursos_humanos/modi_universidad.php",  
                    beforeSend: inicioEnvio,
                    success: EditarEmpleado,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            };
            
                function editarinfoPE()
            {
                var pid = $(this).parents("tr").find("td").eq(0).html();
               

                data = {identi: pid};


                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    //  url:"pages/recursos_humanos/modi_universidad.php",  
                    beforeSend: inicioeditarinfo,
                    success: Editarinfo,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            };


                function VerPerfil()
            {
                var pid = $(this).parents("tr").find("td").eq(0).html();
               


                data2 = {identi: pid};


                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    //  url:"pages/recursos_humanos/modi_universidad.php",  
                    beforeSend: Ver,
                    success: verPerfilP,
                    timeout: 4000,
                    error: problemasVerPerfil
                });
                return false;
            };
            
                     function Ver()
            {
                var x = $("#contenedor");
                x.html('Cargando...');
            }
            
              function verPerfilP()
            {
                $("#contenedor").load('pages/recursos_humanos/cv/reportes/personaObtener.php',data2);
                
            }
            
             function problemasVerPerfil()
            {
                $("#contenedor").text('Problemas en el servidor.');
            }
            
            
            
            function inicioeditarinfo()
            {
                var x = $("#contenedor");
                x.html('Cargando...');
            }
            

             function Editarinfo()
            {
                $("#contenedor").load('pages/recursos_humanos/cv/actualizar/personaActualizar.php', data);
                //$("#contenedor").load('../cargarPOAs.php');
            }




            function inicioEnvio()
            {
                var x = $("#contenedor2");
                x.html('Cargando...');
            }

            function EditarEmpleado()
            {
                $("#contenedor").load('pages/recursos_humanos/cv/EditarCV.php', data);
                //$("#contenedor").load('../cargarPOAs.php');
            }

            function EliminarEmpleado()
            {
                $("#contenedor").load('Datos/eliminarEmpleado.php', data1);
                //$("#contenedor").load('../cargarPOAs.php');
            }


            function problemas()
            {
                $("#contenedor").text('Problemas en el servidor.');
            }



        </script>




      <script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#tabla_empleados').dataTable(); // example es el id de la tabla
    } );
    </script>
    
 <script type="text/javascript">
  // For demo to fit into DataTables site builder...
  $('#tabla_empleados')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
</script>
           

<div class="box">
           <div class="box-header">
           
           </div><!-- /.box-header -->
           <div class="box-body table-responsive">
               <?php
              
                   echo <<<HTML
                                    <table id="tabla_empleados" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>                                            
 
                                            <th>No identidad</th>
                                            <th>nombre</th>
                                            <th>Apellido</th>
                                        <th>Editar info.peronal</th> 
                                      <th>Editar Curriculum</th>
                                         <th>Ver perfil</th>
                                        </tr>
                                        </thead>
                                        <tbody>
HTML;

            while ($rowCE = mysql_fetch_array($queryCE))  {

      
            $Noidentidad = $rowCE['N_identidad'];
            $nombre = $rowCE['Primer_nombre'];
            $apellido=$rowCE['Primer_apellido'];
          
            
                echo "<tr data-id='".$Noidentidad."'>";
                echo <<<HTML
                <td>$Noidentidad</td>


HTML;
                echo <<<HTML
                <td>$nombre</td>
HTML;
                echo <<<HTML
                <td>$apellido</td>
HTML;
                echo <<<HTML
                                 
   
                      <td>

                <center>
                    <button type="submit" class="editaripb btn btn-primary glyphicon  glyphicon-edit"  title="Editar info">
                      </button>
                </center>



                </td> 

               
                  <td>

                <center>
                    <button type="submit" class="editarb btn btn-primary glyphicon glyphicon-list-alt "  title="Editar CV">
                      </button>
                </center>



                </td>  
                
            
                    
                  <td>

                <center>
                    <button class="verb btn btn-success glyphicon glyphicon-folder-open"  title="Ver_perfil">
                      </button>
                </center>



                </td>          
                        
                        
HTML;
                echo "</tr>";

            }

                   echo <<<HTML
                                        </tbody>
                                        <tfoot>
                                        <tr>                                            
                                    
                                            <th>No identidad</th>
                                            <th>nombre</th>
                                            <th>Apellido</th>
                                          
                                            <th>Editar info.Personal</th>
                                            <th>Editar curriculum</th>
                                            <th>Ver perfil</th>
                                        </tr>
                                        </tfoot>
									</table>
HTML;
             
               ?>
           </div><!-- /.box-body -->
       </div><!-- /.box -->
                           
                            <!-- /.table-responsive -->
    </body>
    