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
       
    require_once("../../Datos/insertarDepartamento.php");
    }
     if($tipoProcedimiento == "actualizar"){
       
    require_once("../../Datos/actualizarDepartamento.php");
    }
     if($tipoProcedimiento == "eliminar"){
    require_once("../../Datos/eliminarDepartamento.php");
    }
   }

?>

<!DOCTYPE html>
<html lang="es">

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
                    departamento:$('#nombreDepartamento').val(),
                    tipoProcedimiento:"insertar"
                }
                
                
            
            $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaInsertarDepartamento,
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

            function llegadaInsertarDepartamento()
            {
                $("#contenedor").load('pages/recursos_humanos/Departamentos.php', data);
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
	    var nombre = $("#nombreDepartamento").val();

		if(soloLetrasYNumeros(nombre) == false){
		    $("#nombreDepto").addClass("has-warning");
			$("#nombreDepto").find("label").text("Nombre del Departamento: Solo son permitidos números y letras");
			$("#nombreDepartamento").focus();
			return false;
		}else{
		    $("#nombreDepto").removeClass("has-warning");
			$("#nombreDepto").find("label").text("Nombre del Departamento");
		}
		
		
		
		return true;
                }




        </script>


    </head>
    <body>


        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ingreso de Datos del Departamento</h1>
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
                                <form role="form" action="#" method="POST">
                                    <div id="nombreDepto" class="form-group">
                                        <label>Nombre Departamento</label>
                                        <input title="Se necesita un nombre" type="text" class="form-control" id="nombreDepartamento" name="nombreDepartamento" required>
                                    </div>

                                    <button type="submit"  id="guardarDepartamento" class="btn btn-default">Agregar</button>
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

        <div id="contenedor2" class="panel-body">
            <?php
            include '../../Datos/cargarDepartamentos.php';
            ?>
        </div>

    </body>

</html>
