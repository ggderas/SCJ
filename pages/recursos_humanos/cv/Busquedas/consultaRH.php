<?php


require_once('../../../../Datos/conexion.php');


$RB;
  
 
    if(isset($_POST['licencitura']) and isset($_POST['maestria']) and isset($_POST['doctorado'])){
        
     $licenciatura=  $_POST['licencitura'];
    $maestria= $_POST['maestria'];
    $doctorado= $_POST['doctorado'];
    
    
        
    if($licenciatura=='-1' or $maestria=='-1' or $doctorado=='-1'){
        
        
        if($licenciatura!='-1' and ($maestria=='-1' and $doctorado=='-1')){
            
             $query = "Select * from persona where ((N_identidad in (Select N_identidad from estudios_academico "
            . "where ID_Tipo_estudio=1 and  Nombre_titulo='$licenciatura')))";
            
            $RB=mysql_query($query);
        
        }
        
        
        else if($maestria!='-1' and ($licenciatura=='-1' and $doctorado=='-1')){
            
              $query = "Select * from persona where ((N_identidad in (Select N_identidad from estudios_academico "
            . "where ID_Tipo_estudio=2 and  Nombre_titulo='$maestria')))";
            
            $RB=mysql_query($query);
            
            
            
        
        }else if($doctorado!='-1' and ($licenciatura=='-1' and $maestria=='-1' )){
            
              $query = "Select * from persona where ((N_identidad in (Select N_identidad from estudios_academico "
            . "where ID_Tipo_estudio=3 and  Nombre_titulo='$doctorado')))";
            
            $RB=mysql_query($query);
            
            
        }else if(($licenciatura!='-1' and $maestria!='-1' ) and $doctorado=='-1' ){
            
              $query = "Select * from persona where ((N_identidad in (Select N_identidad from estudios_academico "
            . "where ID_Tipo_estudio=1 and  Nombre_titulo='$licenciatura'))and "
            . "(N_identidad in (Select N_identidad from estudios_academico "
            . "where ID_Tipo_estudio=2 and  Nombre_titulo='$maestria')))";
            
            $RB=mysql_query($query);
        
        
        }else if(($licenciatura!='-1' and  $doctorado!='-1'  ) and $maestria=='-1' ){
            
              $query = "Select * from persona where ((N_identidad in (Select N_identidad from estudios_academico "
            . "where ID_Tipo_estudio=1 and  Nombre_titulo='$licenciatura'))and "
            . "(N_identidad in (Select N_identidad from estudios_academico "
            . "where ID_Tipo_estudio=3 and  Nombre_titulo='$doctorado')))";
            
 
            $RB=mysql_query($query);
        
        
        }
        else if(( $maestria!='-1' and  $doctorado!='-1'  ) and $licenciatura=='-1'  ){
            
            $query = "Select * from persona where" 
            . "(N_identidad in (Select N_identidad from estudios_academico "
            . "where ID_Tipo_estudio=2 and  Nombre_titulo='$maestria'))and"
            . "(N_identidad in (Select N_identidad from estudios_academico "
            . "where ID_Tipo_estudio=3 and  Nombre_titulo='$doctorado'))";
            
 
            $RB=mysql_query($query);
        
        
        }else if($licenciatura=='-1' and $maestria=='-1' and $doctorado=='-1'){
        
        $query = "SELECT * FROM `persona`";
        $RB=mysql_query($query);
        
    }
       

   
    
    } else if($licenciatura!='-1' and $maestria!='-1' and $doctorado!='-1'){
            $query = "Select * from persona where ((N_identidad in (Select N_identidad from estudios_academico "
            . "where ID_Tipo_estudio=1 and  Nombre_titulo='$licenciatura'))and "
            . "(N_identidad in (Select N_identidad from estudios_academico "
            . "where ID_Tipo_estudio=2 and  Nombre_titulo='$maestria'))and"
            . "(N_identidad in (Select N_identidad from estudios_academico "
            . "where ID_Tipo_estudio=3 and  Nombre_titulo='$doctorado')))";
            
            $RB=mysql_query($query);
            
        }
    
    
    
    

    }
    
    
    //Cargo
    else if(isset($_POST['cargo'])){
    $cargo=$_POST['cargo'];
    $query = "Select * from persona where N_identidad in (Select N_identidad from experiencia_laboral where ID_Experiencia_laboral in (select ID_Experiencia_laboral from experiencia_laboral_has_cargo inner join cargo on cargo.ID_cargo=experiencia_laboral_has_cargo.ID_cargo where Cargo='$cargo'))";

    $RB=mysql_query($query);
    }


    //Clases
    else if(isset($_POST['clase'])){
        $clase=$_POST['clase'];
        $query = "Select * from persona where N_identidad in (Select N_identidad from experiencia_academica where ID_Experiencia_academica in (select ID_Experiencia_academica from clases_has_experiencia_academica inner join clases on clases.ID_Clases=clases_has_experiencia_academica.ID_Clases where Clase ='$clase'))";

        $RB=mysql_query($query);
    }
    else{
        
         $query = "SELECT * FROM `persona`";
        $RB=mysql_query($query);
        
    }
    
    
    
         
                
        
        
    
    

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
            




            function inicioEnvio()
            {
                var x = $("#contenedor2");
                x.html('Cargando...');
            }

            function EditarEmpleado()
            {
                $("#contenedor").load('pages/recursos_humanos/cv/Editar.php', data);
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
                                        
                                      <th>Editar curriculum</th>
                                         <th>Ver perfil</th>
                                        </tr>
                                        </thead>
                                        <tbody>
HTML;

            while ($rowCE = mysql_fetch_array($RB))  {

      
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
                    <button type="submit" class="editarb btn btn-primary glyphicon glyphicon-edit"  title="Editar CV">
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
    