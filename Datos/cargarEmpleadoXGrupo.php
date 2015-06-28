<?php


	$enlace = mysql_connect('localhost', 'root', '');
        mysql_select_db("sistema_ciencias_juridicas", $enlace);

  if(isset($_POST['nombreGrupo'])){
      $nGrupo=$_POST['nombreGrupo'];
           
             $pa2= mysql_query("SELECT * FROM grupo_o_comite where Nombre_Grupo_o_comite='".$nGrupo."'") ;
             //var_dump($pa2);

               $row2=mysql_fetch_array($pa2);
               $idG=$row2['ID_Grupo_o_comite'];

 $query = mysql_query("SELECT *FROM grupo_o_comite_has_empleado inner join empleado on empleado.No_Empleado=grupo_o_comite_has_empleado.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad WHERE grupo_o_comite_has_empleado.ID_Grupo_o_comite='".$idG."'");

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
                x = $(".verb");
                x.click(VerPerfil);
            };



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
                    
                    var grupo = "<?php echo $nGrupo; ?>" ;
                    
                    data1 = {codigoE: id1,
                        codigoComite:grupo,
                    tipoProcedimiento:"Eliminar"};

                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                       // url: "Datos/eliminarUniversidad.php",
                        beforeSend: inicioEnvio,
                        success: EliminarEmpleado,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;
                }
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

         

            function EliminarEmpleado()
            {
                $("#contenedor").load('pages/recursos_humanos/gestion_Grupos_comite.php', data1);
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
  
    $('#tabla_empleadosXgrupo').dataTable({
	  "order": [[ 1, "desc" ]],
	  "fnDrawCallback": function(oSettings ) {
              
                
                
                
		
		

      }
	}); // example es el id de la tabla
  });

    </script>
    
          
    </head>

    <body>
        
             <div class="row">
                <div class="col-lg-12">

                    <h2 class="page-header"><Strong><?php echo $nGrupo ; ?></strong></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        <?php
        
          if(isset($codMensaje) and isset($mensaje)){
    if($codMensaje == 1){
      echo '<div class="alert alert-success">';
      echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
      echo '<strong>Exito! </strong>';
      echo $mensaje;
      echo '</div>';
    }else{
      echo '<div class="alert alert-danger">';
      echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
      echo '<strong>Error! </strong>';
      echo $mensaje;
      echo '</div>';
    }
  } 
        ?>
        
       
                   
          <div class="box">
           <div class="box-header">
           
           </div><!-- /.box-header -->
           <div class="box-body table-responsive">
               <?php
              
                   echo <<<HTML
                                    <table id="tabla_empleadosXgrupo" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>                                            
                                            <th>No empleado</th>
                                            <th>No identidad</th>
                                            <th>nombre</th>
                                            <th>Apellido</th>
                                        
                                            <th>Eliminar del grupo</th>
                                          
                                         <th>Ver perfil</th>
                                        </tr>
                                        </thead>
                                        <tbody>
HTML;

            while ($row = mysql_fetch_array($query))  {

            $Noempleado = $row['No_Empleado'];
            $Noidentidad = $row['N_identidad'];
            $nombre = $row['Primer_nombre'];
            $apellido=$row['Primer_apellido'];
           
            
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
                                   

               
            
               <td><center>
                    <button name="Id_universidad"  class="elimina btn btn-danger glyphicon glyphicon-trash"> </button>
                </center></td>
                        
                        
           
                    
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
                                            
                                            <th>Eliminar del grupo</th>
                                          
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