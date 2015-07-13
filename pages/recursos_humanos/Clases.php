<!DOCTYPE html>
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
       
    require_once("../../Datos/insertarClase.php");
    }
     if($tipoProcedimiento == "actualizar"){
       
    require_once("../../Datos/actualizarClase.php");
    }
     if($tipoProcedimiento == "eliminar"){
    require_once("../../Datos/eliminarClase.php");
    }
  
  }
  
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Ingreso de Clases</h1>
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

                                    <form role="form" action="#" method='POST'>
                                        <div id="claseNombre" class="form-group">
                                            
                                            <label>Nombre de la Clase</label>
                                            <input title="Se necesita un nombre" type="text" class="form-control" id="nombre" name="nombre" required>

                                        </div>

                                        <button id="guardarClase" type="submit" class="btn btn-default">Agregar</button>
                                        <button type="reset" class="btn btn-default">Cancelar</button>


                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">

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

            <div>
            
            </div>
            


            <div id="contenedor2" >
                <?php
                include '../../Datos/cargarClases.php';
                ?>


            </div>

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
                    nombre:$('#nombre').val(),
                    tipoProcedimiento:"insertar"
                }
                
                
            
            $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaInsertarClases,
                    timeout: 4000,
                    error: problemas
                });
                }
            return false;
	});
    
        
   });


            function inicioEnvio()
            {
                var x = $("#contenedor");
                x.html('Cargando...');
            }

            function llegadaInsertarClases()
            {
                $("#contenedor").load('pages/recursos_humanos/Clases.php',data);
                //$("#contenedor").load('../cargarPOAs.php');
            }

            function problemas()
            {
                $("#contenedor").text('Problemas en el servidor.');
            }
            
            function soloLetrasYNumeros(text)
             {
                var letters = /^[ 0-9a-zA-ZáéíóúÁÉÍÓÚ]+$/; 
		if(text.match(letters)){
                    return true;
			}
                        else{
			    return false;
			}
            }

            function validator(){
	    var nombre = $("#nombre").val();

		if(soloLetrasYNumeros(nombre) == false){
		    $("#claseNombre").addClass("has-warning");
			$("#claseNombre").find("label").text("Nombre de la clase: Solo son permitidos numeros y letras");
			$("#nombre").focus();
			return false;
		}else{
		    $("#claseNombre").removeClass("has-warning");
			$("#claseNombre").find("label").text("Nombre de la Clase");
		}
		
		
		
		return true;
                }




        </script>



</body>
</html>
