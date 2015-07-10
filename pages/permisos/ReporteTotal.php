
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
  
 	require_once("../../conexion/conn.php");  
	$conexion = mysqli_connect($host, $username, $password, $dbname);
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

		      <!-- /.Filtracion Principal-->							
                                        
    <div id="wrapper">
		<h1 class="page-header">Reporte Permisos  Empleados</h1>
			<div class="box">
            <div class="box-header">
					  
				<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingTwo">
			  <h4 class="panel-title">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				  Establezca el Periodo de Tiempo
				</a>
			  </h4>
			</div>
			<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
			  <div class="panel-body">
								
							   <div class="panel panel-green">
								<div class="panel-body">
					<p><label>Desde: </label>
					 <input type="date" id="fecha_i" name="datepicker_i" required  val="-1">
					<label>Hasta:  </label>

					<input type="date" id="fecha_f" name="datepicker_f" required val="-1" >
				
						</p>
							<p>	 
							</div></div></div></div></div>
							

	  
	  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Avanzada 
			</a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
					    
			           <div class="panel panel-green">
					    <div class="panel-body">
						
						        
					<label align="center">Departamento:</label>
				
					<select class="panel-body" Id="area" name="area">
					<option value=-1>Ninguno</option>
					
					<?php
						$rec1 = mysqli_query($conexion, "select departamento_laboral.nombre_departamento from departamento_laboral");
						while ($row = mysqli_fetch_array($rec1)) {
							echo "<option>";
							echo $row['nombre_departamento'];
							echo "</option>";
						}
					?>
					
					</select>      
						
					<label align="center">Motivo :</label>
					
					<select class="panel-body" Id="motivo" name="motivo">
					 <option value=-1>Ninguno</option>

					
					<?php
						$rec1 = mysqli_query($conexion, "SELECT descripcion from motivos");
						while ($row = mysqli_fetch_array($rec1)) {
							echo "<option>";
							echo $row['descripcion'];
							echo "</option>";
						}
					?>
					</select>  

								
		  	  </p>				
			  
			    </div>
				</div>
				</div></div></div></div></div>
			   <p align="right">
                                               
			 <input  id="btgenerar" class="btn btn-primary" type="submit"  value="Generar Reporte" /></td>
			 
		      <button id="btpdf" class="btn btn-primary" data-mode="verPDF" data-id=$idDpto href="#">ExportarPDF</button>
   			
		    	  			
			   
			
			 
			 </p>
		
		   
           <!-- /.box-header -->
			
	 
 <div id="contenedor2" class="panel-body">
        <?php
        
       

         
     
        ?>
 </div>
  

<script>
$( document ).ready(function() {
//bTN PDF REPORTES 
	$("#btpdf").on('click',function(){
         
		 area=$('select[name=area]').val();
		 motivo= $('select[name=motivo]').val();
		fecha_i= $("#fecha_i").val();
		fecha_f= $("#fecha_f").val();
		
		alert(area,fecha_i);
								
   
			data={
									area: area,
									motivo:motivo,
									fecha_i: fecha_i,
									fecha_f: fecha_f
								
            };
            $.ajax({
                async:true,
                type: "GET",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/permisos/crearpdfreportedepto.php", 
                success:reportePDF,
                timeout:4000,
                error:problemas
            }); 
            return false;
          
        });

		
		
	$("#btpersona").on('click',function(){
          mode = $(this).data('mode');
          id1 = $(this).data('id');
		  alert(id1);
          if(mode == "verPDF"){
           
			data={
            id1:id1
            };
            $.ajax({
                async:true,
                type: "GET",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/permisos/crearpdfreportedepto.php", 
                success:reportePDF,
                timeout:4000,
                error:problemas
            }); 
            return false;
          }
        });
	
           

		
	$("#btgenerar").on('click',function(){
          mode = $(this).data('mode');
          id1 = $(this).data('id');
		  
           
			data = {
							
									area: $('select[name=area]').val(),
									motivo: $('select[name=motivo]').val(),
									fecha_i: $("#fecha_i").val(),
									fecha_f: $("#fecha_f").val()
								
						
								};
								
            $.ajax({
                async:true,
                type: "GET",
                dataType: "html",
				data:data,
                contentType: "application/x-www-form-urlencoded",
                url:"pages/permisos/reporte_filtrado.php", 
                success:llegadaGuardar,
                timeout:4000,
                error:problemas
            }); 
            return false;
          
        });

		
		
		
		
		
		
		
		
		
		}

);

function reportePDF(data){
		//window.open('pages/permisos/crearpdfreportedepto.php?id1='+id1);
		window.open('pages/permisos/crearpdfreportedepto.php?area='+area+'&motivo='+motivo+'&fecha_i='+fecha_i+'&fecha_f='+fecha_f);  
	}

	   function llegadaGuardar(datos)
    {
        
        $("#contenedor2").load('pages/permisos/reporte_filtrado.php', data);
    }


</script>

					
</body>
</html>
