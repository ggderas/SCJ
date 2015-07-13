
<?php

  $maindir = "../../";



  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");
 	require_once("../../conexion/conn.php");  
	$conexion = mysqli_connect($host, $username, $password, $dbname);
		$idempleado= $_POST['no_empleado'];
		//echo $idempleado;
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
		<h1 class="page-header">Consultas a Empleados</h1>
			<div class="box">
            <div class="box-header">
					  
				<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingTwo">
			  <h4 class="panel-title">
				Establezca el Periodo de Tiempo
				
			  </h4>
			</div>
			 <div class="panel-body">
								
							   <div class="panel panel-green">
								<div class="panel-body">
					<p><label>Desde: </label>
					 <input type="date" id="fecha_i" name="datepicker_i" required  value=current()>
					<label>Hasta:  </label>

					<input type="date" id="fecha_f" name="datepicker_f" required val="-1" >
				
						</p>
							<p>	 
						</div></div></div></div>
							

	  
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
			 
		      <button id="reportePDF" class="btn btn-primary" data-mode="verPDF" data-id=$idDpto href="#">ExportarPDF</button>
   			
		    	  			
			   
			
			 
			 </p>
		
		   
           <!-- /.box-header -->
			
	 
 <div id="contenedor2" class="panel-body">
        <?php
        
       

         
     
        ?>
 </div>
  

<script>
$( document ).ready(function() {
//bTN PDF REPORTES 
	$("#reportePDF").on('click',function(){
         
		 area=$('select[name=area]').val();
		 motivo= $('select[name=motivo]').val();
		fecha_i= $("#fecha_i").val();
		fecha_f= $("#fecha_f").val();
		idempleado= "<?php echo $idempleado; ?>";							
   
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
                url:"pages/permisos/crearpdfsolicitudes.php", 
                success:reportePDF2,
                timeout:4000,
                error:problemas
            }); 
         
          
        });

	$("#btgenerar").on('click',function(){
       	 area=$('select[name=area]').val();
		 motivo= $('select[name=motivo]').val();
		fecha_i= $("#fecha_i").val();
		fecha_f= $("#fecha_f").val();

			data = {
					idempleado: "<?php echo $idempleado; ?>",
					area: area,
					motivo:motivo,
					fecha_i: fecha_i,
					fecha_f: fecha_f
		
				};
								
            $.ajax({
                async:true,
                type: "GET",
                dataType: "html",
				data:data,
                contentType: "application/x-www-form-urlencoded",
                url:"pages/permisos/Revision_consulta.php", 
                success:llegadaGuardar,
                timeout:4000,
                error:problemas
            }); 
         
          
        });

		}

);

function reportePDF2(data){
		//window.open('pages/permisos/crearpdfreportedepto.php?id1='+id1);
		window.open('pages/permisos/crearpdfsolicitudes.php?area='+area+'&motivo='+motivo+'&fecha_i='+fecha_i+'&fecha_f='+fecha_f+'&idempleado='+idempleado);  
	}

	   function llegadaGuardar(datos)
    {
        
        $("#contenedor2").load('pages/permisos/Revision_consulta.php', data);
    }


</script>

					
</body>
</html>
