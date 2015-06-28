<?php



 require_once('../../Datos/conexion.php');
 


   $maindir = "../../";

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
 // require_once($maindir."pages/navbar.php");


if(isset($_POST["tipoProcedimiento"])){
    $tipoProcedimiento = $_POST["tipoProcedimiento"];
    
    if($tipoProcedimiento == "insertar"){
       
    require_once("../../Datos/insertarEmpleado.php");
    }
    
    if($tipoProcedimiento == "EliminarEmple"){
       
    require_once("../../Datos/eliminarEmpleado.php");
    }
    
     if($tipoProcedimiento == "Eliminar"){
    require_once("../../Datos/eliminarEmpleadoXGrupo.php");
    }
      
    
}



 $consulta_mysql = "SELECT * FROM `persona`";
 $rec = mysql_query($consulta_mysql);



?>

<!DOCTYPE html>
<html lang="utf-8">

<head>

    <meta charset="utf-8">
    
    
    
    
    
     <script>

            /* 
             * To change this license header, choose License Headers in Project Properties.
             * To change this template file, choose Tools | Templates
             * and open the template in the editor.
             */

            var x;
            x = $(document);
            x.ready(buscarPersona);
            
            function buscarPersona()
            {
               
                var x;
                x = $("#buscarP");
                x.click(buscar);
                
            }


            function buscar()
            {
               
               
                
                data={
                    idpersona:$('#identidad').val()
                }
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadabuscar,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            }
            
           
            


            function inicioEnvio()
            {
                var x = $("#Rbusqueda");
                x.html('Cargando...');
            }

            function llegadabuscar()
            {
                $("#Rbusqueda").load('Datos/BuscarPersona.php',data);
                //$("#contenedor").load('../cargarPOAs.php');
            }
            

            function problemas()
            {
                $("#Rbusqueda").text('Problemas en el servidor.');
            }



        </script>
        
    
    


</head>

<body>

   
      
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><strong>Empleados</strong></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
    
     <div class="box-header">
        <h3 class="box-title">Gestion de Empleados <a class="btn btn-primary" <?php if($_SESSION['user_rol'] <=49 ) echo 'style="display: none;"';?> data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i>Agregar nuevo empleado</a></h3>
      </div><!-- /.box-header -->
         
           
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

      
       

<div id="contenedor3" class="panel-body">
        <?php
        
       

      require_once("../../Datos/cargarEmpleados.php");
         
     
        ?>
 </div>



            
            
            
            
 <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	  <form role="form" id="form" name="form" action="#">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-floppy-disk"></i> Agregar un nuevo empleado </h4>
      </div>
              <div class="modal-body">
                  <div class="form-group">
                      <div class="input-group">
                          <span class="input-group-addon">buscar por numero de identidad</span>

                              <div class="input-group">
                                  <input id="identidad" type="text"   class="form-control" placeholder="Buscar empleado..."    required>
                                  <span class="input-group-btn">
                                      <button id="buscarP" class="btn btn-primary glyphicon glyphicon-search" type="button"></button>
                                  </span>
                              </div>
                           
                        
                      </div>   
                       
                  </div>
                  <div id="Rbusqueda" class="form-group">

  <?php
  
  
   
  ?>

                  </div>
              </div>
           <!--  <div class="modal-footer clearfix">
            <button name="submit" id="submit" class="insertarbg btn btn-primary pull-left"><i class="glyphicon glyphicon-pencil"></i> Insertar</button>
          </div>
           -->
                
                    
          </form>
    
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
   </div>
   





</body>

</html>


