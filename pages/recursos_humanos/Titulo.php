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
       
    require_once("../../Datos/insertarTitulo.php");
    }
     if($tipoProcedimiento == "actualizar"){
       
    require_once("../../Datos/actualizarTitulo.php");
    }
     if($tipoProcedimiento == "eliminar"){
    require_once("../../Datos/eliminarTitulo.php");
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
                    titulo:$('#nombreTitulo').val(),
                    tipoProcedimiento:"insertar"
                };
                
                
            
            $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaInsertarTitulo,
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
	    var nombre = $("#nombreTitulo").val();
	 
		
		//valida si se han itroduzido otros digitos aparte de numeros y letras
		
		if(soloLetrasYNumeros(nombre) == false){
		    $("#Nti").addClass("has-warning");
			$("#Nti").find("label").text("Nombre del titulo: Solo son permitidos numeros y letras");
			$("#nombreTitulo").focus();
			return false;
		}else{
		    $("#Nti").removeClass("has-warning");
			$("#Nti").find("label").text("Nombre del titulo");
		}
		
		
		
		return true;
	}


            function inicioEnvio()
            {
                var x = $("#contenedor");
                x.html('Cargando...');
            }

            function llegadaInsertarTitulo()
            {
                $("#contenedor").load('pages/recursos_humanos/Titulo.php',data);
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
            <h1 class="page-header">Ingreso de Datos del Título</h1>
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
                                <div id="Nti" class="form-group">
                                    <label>Nombre Título</label>
                                    <input title="Se necesita un nombre" type="text"  class="form-control" name="nombreTitulo" id="nombreTitulo" required >
                                    
                                </div>

                                <button type="submit" name="submit"  id="submit" class="submit btn btn-primary" >Agregar</button>
                                <button type="reset" class="btn btn-default">Cancelar</button>
                            </form>
                        </div>
                    
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
        
        

      include '../../Datos/cargarTitulos.php';
      
        
     
        ?>
    </div>
    
    
 


    


</body>

</html>
