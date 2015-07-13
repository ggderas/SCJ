<?php

//include '../Datos/conexion.php';

 $pame = mysql_query("SELECT * FROM universidad inner join pais on pais.Id_pais=universidad.Id_pais");
 
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
                x.click(editarUni);
               
            };
            
            
            
            function fn_dar_eliminar(){
          
                $(".elimina").click(function(){
                    id1 = $(this).parents("tr").find("td").eq(0).html();
                
                    eliminarUni();
                  
                });
            };
            
            
   function eliminarUni(){
        var respuesta=confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
        if (respuesta){  
             data1 ={ Id_universidad:id1,tipoProcedimiento:"eliminar" };
    
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        url:"Datos/eliminarUniversidad.php",     
        beforeSend:inicioEnvio,
        success:llegadaEliminarUni,
        timeout:4000,
        error:problemas
    }); 
    return false;
        };
} 
            
            
                  
            

                function editarUni()
            {
                var pid=$(this).parents("tr").find("td").eq(0).html();
               
                
                
                 data ={codigo:pid}; 
                
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
                $("#contenedor").load('pages/recursos_humanos/modi_universidades.php',data);
                //$("#contenedor").load('../cargarPOAs.php');
            }
            
              function llegadaEliminarUni()
            {
                $("#contenedor").load('pages/recursos_humanos/universidades.php',data1);
                //$("#contenedor").load('../cargarPOAs.php');
            }

            function problemas()
            {
                $("#contenedor").text('Problemas en el servidor.');
            }



        </script>
    
    <script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#tabla_Universidad2').dataTable(); // example es el id de la tabla
    } );
    </script>
    
     <script type="text/javascript">
  // For demo to fit into DataTables site builder...
  $('#tabla_Universidad2')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
</script>
    
      
        
        
        
    </head>
    <body>
        
        <div class="row">
            <div class="col-lg-12">

                <h1 class="page-header">Lista de universidades</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        
       <!--  <div class="box-body table-responsive no-padding"> -->

       <!--  </div> -->
       
      
       
       
       
 <div class="box">
           <div class="box-header">
           
           </div><!-- /.box-header -->
           <div class="box-body table-responsive">
               <?php
              
                   echo <<<HTML
                                    <table id="tabla_Universidad2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            <th><strong>Id_universidad</strong></th>
                                             <th><strong>Nombre_universidad</strong></th>
                                             <th><strong>Pais</strong></th>
                                             <th><strong>Eliminar</strong></th>
                                             <th><strong>Modificar</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
HTML;

               while ($row = mysql_fetch_array($pame))  {

             $idU = $row['Id_universidad'];
            $nombreU = $row['nombre_universidad'];
            $nombreP = $row['Nombre_pais'];
            
                echo "<tr data-id='".$idU."'>";
                echo <<<HTML
                <td>$idU</td>

HTML;
                //echo <<<HTML <td><a href='javascript:ajax_("'$url'");'>$NroFolio</a></td>HTML;
                echo <<<HTML
                <td>$nombreU</td>

HTML;
                echo <<<HTML
                <td>$nombreP</td>
                        
HTML;
                
            if($_SESSION['user_rol'] != 100){
                
             echo ' <td><center>
                    <button name="Id_universidad"  class="elimina btn btn-danger glyphicon glyphicon-trash" disabled="TRUE"> </button>
                </center></td> ';
             }else{
                
               echo ' <td><center>
                    <button name="Id_universidad"  class="elimina btn btn-danger glyphicon glyphicon-trash"> </button>
                </center></td> ';
                 

   }         
             
             echo<<< HTML
   
               <td> <center>
                    <button class="editarb btn btn-primary glyphicon glyphicon-edit"  title="Editar">
                      </button>
                </center> </td>         
                        
                        
HTML;
                echo "</tr>";

            }

                   echo <<<HTML
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                     <th><strong>Id_universidad</strong></th>
                                    <th><strong>Nombre_universidad</strong></th>
                                   <th><strong>Pais</strong></th>
                                    <th><strong>Eliminar</strong></th>
                                     <th><strong>Modificar</strong></th>

                                            </tr>
                                        </tfoot>
									</table>
HTML;
             
               ?>
           </div><!-- /.box-body -->
       </div><!-- /.box -->
       
       
              
        
       

        
        
        
        
    </body>
    
    
</html>