<?php
 include ('../../Datos/conexion.php');
 
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
  
   
  if(isset($_POST["tipoProcedimiento"])){
    $tipoProcedimiento = $_POST["tipoProcedimiento"];
    
    if($tipoProcedimiento == "insertar"){
       
    require_once("../../Datos/insertarpais.php");
    }
     if($tipoProcedimiento == "actualizar"){
       
    require_once("../../Datos/actualizarPais.php");
    }
     if($tipoProcedimiento == "eliminar"){
    require_once("../../Datos/eliminarPais.php");
    }
  
  }
?>

<!DOCTYPE html>
<html>

<head>
        <meta charset="UTF-8">
        <title></title>
        
        
        <script>

            /* 
             * To change this license header, choose License Headers in Project Properties.
             * To change this template file, choose Tools | Templates
             * and open the template in the editor.
             */

  
            
            
            
    $( document ).ready(function() {

    $("form").submit(function(e) {
	    e.preventDefault();
          
                if(validator()){
            
            data={
                    Pais:$('#nombrePais').val(),
                    tipoProcedimiento:"insertar"
                };
                
                
            
            $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaInsertarPais,
                    timeout: 4000,
                    error: problemas
            }); 
                }
            return false;
	});
    
        
   });
        
        
            function soloLetrasYNumeros(text){
	    var letters = /^[ 0-9a-zA-ZáéíóúÁÉÍÓÚ]+$/; 
			if(text.match(letters)){
			    return true;
			}else{
			    return false;
			}
	}

    function validator(){
	    var nombre = $("#nombrePais").val();
	 
		
		//valida si se han itroduzido otros digitos aparte de numeros y letras
		
		if(soloLetrasYNumeros(nombre) == false){
		    $("#Npais").addClass("has-warning");
			$("#Npais").find("label").text("Nombre del usuario: Solo son permitidos numeros y letras");
			$("#nombrePais").focus();
			return false;
		}else{
		    $("#Npais").removeClass("has-warning");
			$("#Npais").find("label").text("Nombre del usuario");
		}
		
		
		
		return true;
	}
        
            
            
           
            


            function inicioEnvio()
            {
                var x = $("#contenedor");
                x.html('Cargando...');
            }

            function llegadaInsertarPais()
            {
                $("#contenedor").load('pages/recursos_humanos/Pais.php',data);
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
            <h1 class="page-header">Ingreso de Datos del Pais</h1>
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
                            <form role="form" id="form"action="#" method="POST">
                                <div id="Npais" class="form-group">
                                    <label>Nombre Pais</label>
                                    <input title="Se necesita un nombre" type="text"  class="form-control" name="nombrePais" id="nombrePais" required >
                                    <p class="help-block">Ejemplo: Honduras, Mexico, Estados Unidos</p>
                                </div>

                                <button type="submit" name="submit"  id="submit" class="submit btn btn-primary" >Agregar</button>
                                <button type="reset" class="btn btn-default">Cancelar</button>
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-6">
                            <form role="form">
                                <fieldset enabled>

                                    <h4>Pais Registrados</h4>
                                    <ol>
                                        <li>Honduras</li>
                                        <li>Mexico</li>
                                        <li>Estados unidos</li>
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
    <!-- /.row -->

    <!-- /#page-wrapper -->


    
  
    
    <div id="contenedor2" class="panel-body">
        <?php
        
        

      include '../../Datos/cargaPais.php';
      
        
     
        ?>
    </div>
    
    
 


    


</body>

</html>
