<?php

 // require_once('../../Datos/conexion.php');
 $queryCE = mysql_query("SELECT * FROM empleado inner join persona on empleado.N_identidad=persona.N_identidad inner join departamento_laboral on departamento_laboral.Id_departamento_laboral=empleado.Id_departamento Where estado_empleado='1'");
  
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

  if(!isset( $_SESSION['user_id'] ))
  {
    header('Location: '.$maindir.'login/logout.php?code=100');
    exit();
  }

 

 
?>


<html lang="en">
    
    <head>
        
        <meta charset="UTF-8">
        
       

        
        <script>

              /* 
               * To change this license header, choose License Headers in Project Properties.
               * To change this template file, choose Tools | Templates
               * and open the template in the editor.
               */


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
                x = $(".verb");
                x.click(VerPerfil);
            }
            ;



            function fn_dar_eliminar() {

                $(".elimina").click(function() {
                    id1 = $(this).parents("tr").find("td").eq(0).html();



                    eliminarE();

                });
            }
            ;


            function eliminarE() {
                var respuesta = confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
                if (respuesta) {
                    data1 = {codigoE: id1, tipoProcedimiento:"EliminarEmple"};

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
            }





            function editarE()
            {
                var pid = $(this).parents("tr").find("td").eq(0).html();
               

                data = {codigo: pid};


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
            }


            function VerPerfil()
            {
                var pid = $(this).parents("tr").find("td").eq(0).html();
               


                data2 = {codigo: pid};


                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    //  url:"pages/recursos_humanos/modi_universidad.php",  
                    beforeSend: inicioEnvio,
                    success: verPerfilE,
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

            function EditarEmpleado()
            {
                $("#contenedor").load('pages/recursos_humanos/modi_empleado.php', data);
                //$("#contenedor").load('../cargarPOAs.php');
            }

            function EliminarEmpleado()
            {
                $("#contenedor").load('pages/recursos_humanos/Empleados.php', data1);
                //$("#contenedor").load('../cargarPOAs.php');
            }

            function verPerfilE()
            {
                $("#contenedor").load('pages/recursos_humanos/perfilEmpleado.php', data2);
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
           
    </head>

    <body>
        
                   
          <div class="box">
           <div class="box-header">
           
           </div><!-- /.box-header -->
           <div class="box-body table-responsive">
               <?php
              
                   echo <<<HTML
                                    <table id="tabla_empleados" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>                                            
                                            <th>No empleado</th>
                                            <th>No identidad</th>
                                            <th>nombre</th>
                                            <th>Apellido</th>
                                            <th>Departamento</th>
                                            <th>Eliminar</th>
                                            <th>Editar</th>
                                         <th>Ver perfil</th>
                                        </tr>
                                        </thead>
                                        <tbody>
HTML;

            while ($rowCE = mysql_fetch_array($queryCE))  {

             $Noempleado = $rowCE['No_Empleado'];
            $Noidentidad = $rowCE['N_identidad'];
            $nombre = $rowCE['Primer_nombre'];
            $apellido=$rowCE['Primer_apellido'];
            $departamento=$rowCE['nombre_departamento'];
            
                echo "<tr data-id='".$Noempleado."'>";
                echo <<<HTML
                <td>$Noempleado</td>

HTML;
                //echo <<<HTML <td><a href='javascript:ajax_("'$url'");'>$NroFolio</a></td>HTML;
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
                <td>$departamento</td>                        

               
            
               <td><center>
HTML;
                if($_SESSION['user_rol'] <= 49){
          echo '<button name="Id_universidad"  class="elimina btn btn-danger glyphicon glyphicon-trash" disabled="TRUE"> </button>
                </center></td>';
                }else{
                echo '<button name="Id_universidad"  class="elimina btn btn-danger glyphicon glyphicon-trash"> </button>
                </center></td>';
                    
                }
                

              echo  '<td>

                <center>';
                
                if($_SESSION['user_rol'] <= 49){
            echo  ' <button type="submit" class="editarb btn btn-primary glyphicon glyphicon-edit" disabled="TRUE" title="Editar">
                      </button>';
                }else{
                 echo '<button type="submit" class="editarb btn btn-primary glyphicon glyphicon-edit"  title="Editar">
                      </button>';
                }
                
               echo '</center>

                </td>   ';
                    
                
                echo <<<HTML
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
                                            <th>No empleado</th>
                                            <th>No identidad</th>
                                            <th>nombre</th>
                                            <th>Apellido</th>
                                            <th>Departamento</th>
                                            <th>Eliminar</th>
                                            <th>Editar</th>
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
    

    
    
</html>