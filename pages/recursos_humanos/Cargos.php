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
       
    require_once("../../Datos/insertarcargo.php");
    }
     if($tipoProcedimiento == "actualizar"){
       
    require_once("../../Datos/actualizarCargos.php");
    }
     if($tipoProcedimiento == "eliminar"){
    require_once("../../Datos/eliminarCargo.php");
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
                    <h1 class="page-header">Ingreso de Cargos</h1>
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
                                        <div class="form-group">
                                            <div id="cargoNombre" class="form-group">
                                                <label>Nombre del Cargo</label>
                                                <input title="Se necesita un nombre" type="text"  class="form-control" id="nombre" name="nombre" required >
                                            </div>
                                        </div>
                                        <button id="guardarCargo" type="submit" class="btn btn-default">Agregar</button>
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
                include '../../Datos/cargarCargos.php';
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
                    success: llegadaInsertarCargo,
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

            function llegadaInsertarCargo()
            {
                $("#contenedor").load('pages/recursos_humanos/Cargos.php',data);
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
		    $("#cargoNombre").addClass("has-warning");
			$("#cargoNombre").find("label").text("Nombre del Cargo: Solo son permitidos numeros y letras");
			$("#nombre").focus();
			return false;
		}else{
		    $("#cargoNombre").removeClass("has-warning");
			$("#cargoNombre").find("label").text("Nombre del Cargo");
		}
		
		
		
		return true;
                }



        </script>



</body>
</html>
