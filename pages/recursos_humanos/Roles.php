<?php
 include ('../../Datos/conexion.php');

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
                    rol:$('#nombreRol').val(),
                    nivel1:$('#nivel').val(),
                    descripcion:$('#descripcion').val(),
                    tipoProcedimiento:"insertar"
                };
                
                
            
            $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaInsertarRol,
                    timeout: 4000,
                    error: problemas
            }); 
                }
            return false;
	});
    
        
   });
        
        
            function soloLetrasYNumeros(text){
	    var letters = /^[0-9a-zA-Z ]+$/; 
			if(text.match(letters)){
			    return true;
			}else{
			    return false;
			}
	}

    function validator(){
	    var nombre = $("#nombreRol").val();
	 
		
		//valida si se han itroduzido otros digitos aparte de numeros y letras
		
		if(soloLetrasYNumeros(nombre) == false){
		    $("#rol").addClass("has-warning");
			$("#rol").find("label").text("Nombre del Rol: Solo son permitidos numeros y letras");
			$("#nombreRol").focus();
			return false;
		}else{
		    $("#rol").removeClass("has-warning");
			$("#rol").find("label").text("Nombre del Rol");
		}
		
		
		
		return true;
	}


            function inicioEnvio()
            {
                var x = $("#contenedor2");
                x.html('Cargando...');
            }

            function llegadaInsertarRol()
            {
                $("#contenedor2").load('Datos/insertarRol.php',data);
                //$("#contenedor").load('../cargarPOAs.php');
            }
            

            function problemas()
            {
                $("#contenedor2").text('Problemas en el servidor.');
            }



        </script>
        
        
    </head>
    <body>


    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Ingreso de Datos Roles</h1>
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
                                <div id="rol" class="form-group">
                                    <label>Nombre Rol</label>
                                    <input title="Se necesita un nombre" type="text"  class="form-control" name="nombreRol" id="nombreRol" required >
                                </div>
                                <div id="desrol" class="form-group">
                                    <label>Descripción</label>
                                    <input title="Se necesita una descripción" type="text"  class="form-control" name="descripcion" id="descripcion" required >
                                </div>
                                <div id="rolni" class="form-group">
                                    <label>Nivel Rol</label>
                                    <input title="Se necesita un nivel en numeros" type="text"  class="form-control" name="nivel" id="nivel" required >
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



    
  
    
    <div id="contenedor2" class="panel-body">
        <?php
        
        

      include '../../Datos/cargarRoles.php';
      
        
     
        ?>
    </div>
    
    
 


    


</body>

</html>
