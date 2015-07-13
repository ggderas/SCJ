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
       
    require_once("../../Datos/insertarComite.php");
    }
     if($tipoProcedimiento == "actualizar"){
       
    require_once("../../Datos/actualizarGrupoComite.php");
    }
     if($tipoProcedimiento == "eliminar"){
    require_once("../../Datos/eliminarGrupoComite.php");
    }
  
  }
  

?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ingreso de Comites o Grupos</h1>
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
                                    <div id="grupoNombre" class="form-group">
                                        <label>Nombre del Grupo o Comité</label>
                                        <input title="Se necesita un nombre" type="text" name="nombreComite" id="nombreComite" class="form-control" required>

                                    </div>

                                    <button id="guardarComite" type="submit" class="btn btn-default">Agregar</button>
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

        <div id="contenedor2" >
            <?php
            $root = \realpath($_SERVER["DOCUMENT_ROOT"]);
            include "$root\SistemaCienciasJuridicas\Datos\cargarComite.php";
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
            
              data = {
                    nombreComite: $('#nombreComite').val(),
                    tipoProcedimiento:"insertar"
                }
                
                
            
           $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaInsertarComite,
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

            function llegadaInsertarComite()
            {
                $("#contenedor").load('pages/recursos_humanos/Comite_Grupo.php', data);
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
	    var nombre = $("#nombreComite").val();

		if(soloLetrasYNumeros(nombre) == false){
		    $("#grupoNombre").addClass("has-warning");
			$("#grupoNombre").find("label").text("Nombre del grupo o comite: Solo son permitidos numeros y letras");
			$("#nombreComite").focus();
			return false;
		}else{
		    $("#grupoNombre").removeClass("has-warning");
			$("#grupoNombre").find("label").text("Nombre del Grupo o Comite");
		}
		
		
		
		return true;
                }



        </script>



    </body>
</html>
