  <?php

include '../../Datos/conexion.php';


      $cargoE='';
     $idCargoE='';
      $fechacE='';
      
$enlace = mysql_connect('localhost', 'root', '');
mysql_select_db("sistema_ciencias_juridicas", $enlace);

$codigoE = $_POST['codigo'];

 $resultado=mysql_query("SELECT * FROM empleado inner join persona on empleado.N_identidad=persona.N_identidad inner join departamento_laboral on departamento_laboral.Id_departamento_laboral=empleado.Id_departamento Where estado_empleado='1' and No_Empleado='".$codigoE."'");
 $resultado2=mysql_query("SELECT * FROM empleado_has_cargo inner join cargo on cargo.ID_cargo=empleado_has_cargo.ID_cargo where No_Empleado='".$codigoE."'");
 if($row=mysql_fetch_array($resultado)){
     
     
      $nombreE=$row['Primer_nombre'];
      $apellidoE=$row['Primer_apellido'];
      $nidentidad=$row['N_identidad'];
      $fechaE=$row['Fecha_ingreso'];
      $depE=$row['nombre_departamento'];
      $depID=$row['Id_departamento_laboral'];
      $obsE=$row['Observacion'];
      $noE=$row['No_Empleado'];
    
     
 $nombreC =$nombreE." ".$apellidoE;
      
 }
 
 

?>  




    <!-- /.row -->
    <div class="row">
        
         <h3 class="page-header">
          <i class="glyphicon glyphicon-user"></i>Perfil empleado
                               
          </h3>
        
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Informacion personal
                </div>
                <div class="panel-body">
                 <div class="row">
                        <div class="col-xs-12">
                             
                            <strong> Numero de identidad :</strong> <?php echo $nidentidad ?>
                            <div class="pull-right"><strong>Codigo empleado: </strong><?php echo $codigoE ?></div>
                            </br>
                            <strong> Nombre :</strong> <?php echo $nombreC ?>
                            </br>
                            <strong> Fecha Ingreso como empleado :</strong> <?php echo $fechaE ?>
                  
                        </div>
                     <div class="col-xs-12">
                         
                         
                         
                     </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>

            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    
        <div class="row">
       
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-list-alt"></i>Informacion laboral
                </div>
                <div class="panel-body">
                 <div class="row">
                        <div class="col-xs-12">
                             
                            <strong> Departamento laboral :</strong> <?php echo $depE ?>
                            </br>
                            </br>
                            
      
                            
                            
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
        <tr>
            <th><strong>Cargo</strong></th>
            <th><strong>Fecha de ingreso</strong></th>
            <th><strong>Fecha de salida</strong></th>
            

        </tr>
            </thead>
      <tbody>
          
        <?php
        while ($row3=mysql_fetch_array($resultado2)) {
            $id = $row3['ID_cargo'];
            $fechaS=$row3['Fecha_salida_cargo'];
            
            
            
         ?>
            
          <tr>
                  <td id="cargoP"><?php echo $row3['Cargo'] ?></td>
                  <td id="fechaic"> <?php echo $row3['Fecha_ingreso_cargo']?></td>
                  
             <?php
              if ($fechaS== NULL || $fechaS=="0000-00-00") {
                    echo "<td> Actualmente </td>";
                }else{
                    echo "<td> $fechaS </td>";
                }
             ?>
           


         </tr>


   <?php } ?>
 </tbody>
    </table>

    </div>
      
                          
                  
                        </div>
                     <div class="col-xs-12">
                         
                         
                         
                     </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>

            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    
    
    
    
     <div class="row">
       
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-eye-open"></i>Observaciones
                </div>
                <div class="panel-body">
                 <div class="row">
                        <div class="col-xs-12">
                             
                            <strong>Observacion :</strong> <?php echo $obsE ?>
                            
                                   
                        </div>
                  
                    </div>
                    <!-- /.row (nested) -->
                </div>

            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php
   echo '<button class="btn btn-primary pull-right" data-mode="verPDF" data-id="'.$noE.'" href="#">Exportar a PDF</button>';
    ?>
    
    
    <script>
    
    
    $( document ).ready(function() {
        
        
        
       $(".btn-primary").on('click',function(){
          mode = $(this).data('mode');
          id1 = $(this).data('id');
          if(mode == "verPDF"){
           
			data={
          //  NroEmpleado:id
            };
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                //url:"pages/gestion_folios/crear_pdf.php", 
                success:reportePDF,
                timeout:4000,
                error:problemas
            }); 
            return false;
          }
        });
        
        
        
        
        
    });
    
    
    function reportePDF(){
		window.open('pages/recursos_humanos/crearPDFempleado.php?id1='+id1);
	}
        
           function problemas()
            {
                $("#contenedor").text('Problemas en el servidor.');
            }
    
    
    
    
    </script>