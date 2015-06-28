<?php

if(isset($_POST["tipoProcedimiento"])){
    $tipoProcedimiento = $_POST["tipoProcedimiento"];
    if($tipoProcedimiento == "insertar"){
    require_once("../../Datos/insertarEmpleadoXgrupo.php");
    }
     if($tipoProcedimiento == "Eliminar"){
    require_once("../../Datos/eliminarEmpleadoXGrupo.php");
    }
}




include ('../../Datos/conexion.php');

$consulta = "SELECT Nombre_Grupo_o_comite, COUNT(No_Empleado) AS Cantidad FROM grupo_o_comite_has_empleado right join grupo_o_comite on grupo_o_comite.ID_Grupo_o_comite=grupo_o_comite_has_empleado.ID_Grupo_o_comite GROUP BY Nombre_Grupo_o_comite";
$rec = mysql_query($consulta);



 
 
 //echo ($nGrupo);


?>


<!--mysql_connect("localhost","root",""); 
mysql_select_db("sistema_ciencias_juridicas"); -->


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    
    
    
   <script>
        
           var x;
            x = $(document);
            x.ready(inicio);
           var y;
            function inicio()
            {
                
                
                var x;
                x = $(".agregarbg");
                x.click(variable);
                
                 var x;
                x = $(".insertarbg");
                x.click(insertar);
                
                var x;
                x = $("#buscarE");
                x.click(buscar);
                
                 var x;
                x = $(".verbg");
                x.click(variable);
                
                
                var x;
                x = $(".verbg");
                x.click(ver);
                
                
               
            }
            
            function variable(){
                
                y= $(this).parents("tr").find("td").eq(0).html();
                
            
                
            }
            
            
            
             function insertar()
            {
                
                 
                 codE=$("#codEmple").val();
              
                 
                // alert(codE);
                // alert(y);
                $("#compose-modal").modal('hide');
                data={
                 cod_empleado:codE,
                 nombreGrupo:y,
                 tipoProcedimiento:"insertar"
                };
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                   
                    beforeSend: inicioEnvioXgrupo,
                    success: insertarEmpleadoGrupo,
                    timeout: 4000,
                    error: problemasXgrupo
                });
                return false;
            }
            
            
            
            
             function ver()
            {
                
              // alert(y);
                data2 = {nombreGrupo:y};


                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    //  url:"pages/recursos_humanos/modi_universidad.php",  
                    beforeSend: inicioVer,
                    success: verGrupo,
                    timeout: 4000,
                    error: problemasVer
                });
                return false;
            }
            


            function buscar()
            {
                
                 
                 id=$("#codEmple").val();
                 
               
                
                data={
                    idempleado:id,
                    
                };
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    url:"pages/recursos_humanos/gestion_Grupos_comite.php",
                    beforeSend: inicioEnvio,
                    success: buscarEmpleado,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            }
            
           
            


            function inicioEnvio()
            {
                var x = $("#Rbusqueda");
                x.html('Buscando...');
            }

            function buscarEmpleado()
            {
              $("#Rbusqueda").load('Datos/BuscarEmpleado.php',data);
              
            }
            
            function problemas()
            {
                $("#Rbusqueda").text('Problemas en el servidor.');
            }
            
            
                function insertarEmpleadoGrupo()
            {
              //$("#contenedor2").load('Datos/insertarEmpleadoXgrupo.php',data);
              $('body').removeClass('modal-open');
              $("#contenedor").load('pages/recursos_humanos/gestion_Grupos_comite.php',data);
              
            }
            
         
             function inicioEnvioXgrupo()
            {
                var x = $("#contenedor");
                x.html('Buscando...');
            }
             function problemasXgrupo()
            {
                $("#contenedor").text('Problemas en el servidor.');
            }
            
            
            
              function inicioVer()
            {
                var x = $("#contenedor2");
                x.html('Buscando...');
            }
            
              function verGrupo()
            {
               $("#contenedor2").load('Datos/cargarEmpleadoXGrupo.php',data2);
              
            }
            
          
             function problemasVer()
            {
                $("#contenedor2").text('Problemas en el servidor.');
            }
            

            



        </script>
        
      <SCRIPT language=Javascript>
      
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
 
         return true;
      }
      
   </SCRIPT>
       
        

</head>

<body>

	
    
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><strong>Gestion de empleados por grupos o comisiones </strong></h1>
                
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
                
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        
      
        
         <div class="box">
           <div class="box-header">
          
               
           </div><!-- /.box-header -->
           <div class="box-body table-responsive">
               <?php
              
                   echo <<<HTML
                                    <table id="tabla_Grupos" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                           
                                            <th><strong>Nombre del grupo</strong></th>
                                             <th><strong>cantidad integrantes</strong></th>
                                             <th><strong>Agregar miembro</strong></th>
                                             <th><strong>ver mienbros actuales</strong></th>
                                           
                                            </tr>
                                        </thead>
                                        <tbody>
HTML;

               while ($row = mysql_fetch_array($rec))  {

             $nombreG = $row['Nombre_Grupo_o_comite'];
             $cantidad = $row['Cantidad'];
           
            
                echo "<tr data-id='".$nombreG."'>";
                echo <<<HTML
                <td name="nombreGrupo" >$nombreG</td>

HTML;
                //echo <<<HTML <td><a href='javascript:ajax_("'$url'");'>$NroFolio</a></td>HTML;
                echo <<<HTML
                <td>$cantidad</td>

HTML;
                echo <<<HTML
       
               <td><center> 
                    <button name="agregar"  class="agregarbg btn btn-primary glyphicon glyphicon-plus" data-toggle="modal" data-target="#compose-modal" > </button>
                </center></td>
                        
                        
                <td>

                <center>
                    <button class="verbg btn btn-success glyphicon glyphicon-folder-open"  title="ver">
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
                                        <th><strong>Nombre del grupo</strong></th>
                                             <th><strong>cantidad integrantes</strong></th>
                                             <th><strong>Agregar miembro</strong></th>
                                             <th><strong>ver mienbros actuales</strong></th>         
                                            </tr>
                                        </tfoot>
               </table>
HTML;
             
               ?>
           </div><!-- /.box-body -->
       </div><!-- /.box -->

       
   <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	  <form role="form" id="form" name="form" action="#">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-floppy-disk"></i> Agregar un nuevo miembro al grupo </h4>
      </div>
              <div class="modal-body">
                  <div class="form-group">
                      <div class="input-group">
                          <span class="input-group-addon">buscar por numero de empleado</span>

                              <div class="input-group">
                                  <input id="codEmple" type="text"   class="form-control" placeholder="Buscar empleado..."  onkeypress="return isNumberKey(event)"  required>
                                  <span class="input-group-btn">
                                      <button id="buscarE" class="btn btn-primary glyphicon glyphicon-search" type="button"></button>
                                  </span>
                              </div>
                           
                        
                      </div>   
                       
                  </div>
                  <div id="Rbusqueda" class="form-group">

  <?php
  
  
   
  ?>

                  </div>
              </div>
              <div class="modal-footer clearfix">
            <button name="submit" id="submit" class="insertarbg btn btn-primary pull-left"><i class="glyphicon glyphicon-pencil"></i> Insertar</button>
          </div>
                
                    
          </form>
    
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
   </div>
    




   


  <div id="contenedor2" class="panel-body">
 
   </div>
    
        
        

</body>

</html>



