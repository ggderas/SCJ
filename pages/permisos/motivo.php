<?php

$maindir = "../../";
 
if(isset($_GET['contenido']))
    {
      $contenido = $_GET['contenido'];
    }
  else
    {
      $contenido = 'permisos';
    }

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");
  
   if(!isset( $_SESSION['user_id'] ))
  {
    header('Location: '.$maindir.'login/logout.php?code=100');
    exit();
  }
  
?>

<?php
//include 'conexion.php';
require_once("../../conexion/conn.php");  

$conexion = mysqli_connect($host, $username, $password, $dbname);

$rec = mysqli_query($conexion, "SELECT * from motivos");
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
	
</head>

<body>

	<div id="wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Motivos</h1>
                </div>
                <!-- /.col-lg-12 -->
			</div>
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Llene los campos con la información solicitada
                        </div>
						<div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="#", method="GET">
									
                                        <div class="form-group">
                                            <label>Motivo</label>
                                            <input class="form-control" id ="motivo" name="motivo">
                                        </div>
										
                                        <button id = "guardar" class="guardarMotivo btn btn-default">Agregar</button>
										
                                        <button type="reset" class="btn btn-default">Cancelar</button><br><br>
										
									<?php
              
                   echo <<<HTML
                                    <table id="tabla_Motivos" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            <th><strong>ID Motivo</strong></th>
                                             <th><strong>Descripci&#243;n Motivo</strong></th>
                                             <th><strong>Editar</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
HTML;

               while ($row = mysqli_fetch_array($rec))  {

				$idM = $row['Motivo_ID'];
				$dmotivo = $row['descripcion'];
            
            
                echo "<tr data-id='".$idM."'>";
                echo <<<HTML
                <td>$idM</td>

HTML;
                //echo <<<HTML <td><a href='javascript:ajax_("'$url'");'>$NroFolio</a></td>HTML;
                echo <<<HTML
				
                <td>$dmotivo</td>
				
				<td><center>
                    <a class="open-Modal btn btn-primary" data-toggle="modal" data-id=$idM data-target="#compose-modal"><i class="fa fa-edit"></i></a>
                </center></td>


HTML;
                echo "</tr>";

            }

                   echo <<<HTML
                                       
									</table>
HTML;
             
               ?>
									
									
									</form>
								</div>
							</div>
						</div>
					</div>					
				</div>						
			</div>							
	</div>
	
 <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	  <form role="form" id="form" name="form" action="#">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-floppy-disk"></i>Editando Motivo</h4>
      </div>
              <div class="modal-body">
                  <div class="form-group">
                      <div class="input-group">
                              <div class="input-group">
								  <input id="codmotivo" type="hidden" class="form-control" value = ""  required>
                                  <input id="descripcionm" type="text" class="form-control" placeholder="Descripci&#243;n de motivo"    required>
                                  <span class="input-group-btn">
									<button id="editaM" class="edita btn btn-danger glyphicon glyphicon-edit"> </button>
                                      <!--<button id="guardarJ" class="guardarJ btn btn-primary" type="button">Finalizar</button>-->
                                  </span>
                              </div>
                           
                        
                      </div>   
                       
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

<script>
$(document).on("click", ".open-Modal", function () {
	id = $(this).parents("tr").find("td").eq(0).html();
	var myDNI = $(this).data('id');
	$(".modal-body #codmotivo").val(myDNI);
});
			
 var id;
 var data;
 var x;
 x=$(document);
 x.ready(inicio);
 
    function inicio(){
        var x;
        x=$("#guardar");
        x.click(consulta);
        
       var x;
        x=$("#editaM");
        x.click(editarMotivo);
	}
	
	function consulta() {
            var dmotivo=$("#motivo").val(); 
			var patron = /[0-9]/;
			if(dmotivo != '' && !(patron.test(dmotivo))){
            //alert(dmotivo);
               data ={ dmotivo:$("#motivo").val()};
               $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/permisos/insertarMotivos.php", 
                beforeSend:inicioEnvio,
                success:llegadaGuardar,
				data:data,
                timeout:4000,
                error:function(result){  
            alert('ERROR ' + result.status + ' ' + result.statusText);  
          }
            }); 
			}else{alert('El campo esta vacio ó contiene numeros');}
            return false;
    }
	
	function editarMotivo(){
		//var id = $(this).parents("tr").find("td").eq(0).html();
		var respuesta=confirm("¿Esta seguro de que desea cambiar el registro seleccionado?");
        if (respuesta){  
			data = {Motivo_ID:$('#codmotivo').val(), dmotivo:$('#descripcionm').val()};
			$.ajax({
				async:true,
				type: "GET",
				dataType: "html",
				data:data,
				contentType: "application/x-www-form-urlencoded",
				url:"pages/permisos/editarMotivos.php",     
				beforeSend:inicioEnvio,
				success:llegadaEditarMotivo,
				timeout:4000,
				error:problemas
			});
			return false;
		}
	}

	
	function inicioEnvio(){
    var x=$("#contenedor");
    x.html('Cargando...');
	}
	
	function llegadaGuardar(){
		alert("Transacción completada correctamente");
		$("#contenedor").load('pages/permisos/motivo.php', data);
	}
	
	function problemas()
	{
    $("#contenedor").text('Problemas en el servidor.');
	}

	function llegadaEditarMotivo()
    {
		$("#contenedor").load('pages/permisos/editarMotivos.php',data);
		alert("Transacción completada correctamente");
		$("#contenedor").load('pages/permisos/motivo.php');
    }
	
</script>
	
</body>

</html>	