<?php

include '../../Datos/conexion.php';

$existe=FALSE;

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

 // require_once($maindir."pages/navbar.php");



if(isset($_POST["tipoProcedimiento"])){
    $tipoProcedimiento = $_POST["tipoProcedimiento"];
    if($tipoProcedimiento == "insertarCargo"){
    require_once("../../Datos/insertarCargoXEmpleado.php");
    }
    if($tipoProcedimiento == "AltaCargo"){
    require_once("../../Datos/actualizarCargoXEmpleado.php");
    }
     if($tipoProcedimiento == "Actualizar"){
    require_once("../../Datos/actualizarEmpleado.php");
    }
}

$enlace = mysql_connect('localhost', 'root', '');
mysql_select_db("sistema_ciencias_juridicas", $enlace);


if(isset($_POST['codigo']) and $existe==FALSE ){
 
 $codigoE = $_POST['codigo'];
 
  

 $resultado=mysql_query("SELECT * FROM empleado inner join persona on empleado.N_identidad=persona.N_identidad inner join departamento_laboral on departamento_laboral.Id_departamento_laboral=empleado.Id_departamento Where estado_empleado='1' and No_Empleado='".$codigoE."'");
 $resultado2=mysql_query("SELECT * FROM empleado_has_cargo inner join cargo on cargo.ID_cargo=empleado_has_cargo.ID_cargo where No_Empleado='".$codigoE."'");
 if($row=mysql_fetch_array($resultado)){
     
     
      $nombreE=$row['Primer_nombre'];
      $apellidoE=$row['Primer_apellido'];
      $depE=$row['nombre_departamento'];
      $depID=$row['Id_departamento_laboral'];
      $obsE=$row['Observacion'];
      $noE=$row['N_identidad'];
      $fechaE=$row['Fecha_ingreso'];
    
          
         
 }
 
    }else if(isset($_POST['codigo2']) and $existe==TRUE){
        
         $codigoE = $_POST['codigo2'];

         
         
 $resultado=mysql_query("SELECT * FROM empleado inner join persona on empleado.N_identidad=persona.N_identidad inner join departamento_laboral on departamento_laboral.Id_departamento_laboral=empleado.Id_departamento Where estado_empleado='1' and No_Empleado='".$codigoE."'");
 $resultado2=mysql_query("SELECT * FROM empleado_has_cargo inner join cargo on cargo.ID_cargo=empleado_has_cargo.ID_cargo where No_Empleado='".$codigoE."'");
 if($row=mysql_fetch_array($resultado)){
     
     
      $nombreE=$row['Primer_nombre'];
      $apellidoE=$row['Primer_apellido'];
      $depE=$row['nombre_departamento'];
      $depID=$row['Id_departamento_laboral'];
      $obsE=$row['Observacion'];
      $noE=$row['N_identidad'];
      $fechaE=$row['Fecha_ingreso'];
    
          
   
        
        
        
    }
 
}

?>

<!DOCTYPE html>
<html lang="utf-8">

<head>

    <meta charset="utf-8">
    
    
    
    
    
     <script>

            /* 
             * To change this license header, choose License Headers in Project Properties.
             * To change this template file, choose Tools | Templates
             * and open the template in the editor.
             */
         
            var x;
            x = $(document);
            x.ready(inicio);
            
            function inicio()
            {
               
 
                               
                 var x;
                x = $(".insertarbc");
                x.click(nuevoCargo);
                
                
                var x;
                x = $(".altab");
                x.click(darAlta);
                
                
                
            }


 
            
            
             function nuevoCargo()
            {
               
              
             
                $("#compose-modal").modal('hide');
                data2={
                    codigo:$('#cod').val(),
                    cargoE:$('#cargo').val(),
                    tipoProcedimiento:"insertarCargo"
                  
                };
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: ActualizarNuevoCargo,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            }
            
            
            
             function darAlta()
            {
                 id1 = $(this).parents("tr").find("td").eq(0).html();
                 var codigoE2 = "<?php echo $codigoE; ?>" ;
                 
               var respuesta = confirm("¿Esta seguro de que desea DAR DE ALTA al cargo actual de este empleado?");
                if (respuesta) {
              
             
                
                data2={
                    codigo:codigoE2,
                    cargoE:id1,
                    tipoProcedimiento:"AltaCargo"
                  
                };
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success:Actualizarcargo,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            }
            }
            
            
            
            
            
   $( document ).ready(function() {

             $("form").submit(function(e) {
	       e.preventDefault();
          
                if(validator()){
            
                 var id = "<?php echo $noE; ?>" ;
       
                 var codT = "<?php echo $codigoE; ?>" ;
         
                data={
                    codigo:$('#cod').val(),
                    codigo2:codT,
                    nidentidadE:id,
                    departE:$('#dep').val(),
                    fechaE:$('#fecha').val(),
                    obsE:$('#obs').val(),
                    tipoProcedimiento:"Actualizar"
                };
                
                
            
            $.ajax({
                  async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: ActualizarEmple,
                    timeout: 4000,
                    error: problemas
                });
                }
            return false;
	});
        
        
   });
        
        
            function soloLetrasYNumeros(text){
	    var letters = /^[0-9]+$/; 
			if(text.match(letters)){
			    return true;
			}else{
			    return false;
			}
	}

    function validator(){
	    var nombre = $("#cod").val();
	 
		
		//valida si se han itroduzido otros digitos aparte de numeros y letras
		
		if(soloLetrasYNumeros(nombre) == false){
		    $("#CodE").addClass("has-warning");
			$("#CodE").find("label").text("Codigo de empleado: Solo son permitidos numeros");
			$("#cod").focus();
			return false;
		}else{
		    $("#CodE").removeClass("has-warning");
			$("#CodE").find("label").text("Codigo empleado");
		}
		
		
		
		return true;
	}
            
            
            
            
            
            
           
            


            function inicioEnvio()
            {
                var x = $("#contenedor");
                x.html('Cargando...');
            }
            
                function ActualizarNuevoCargo()
            {
                $('body').removeClass('modal-open');
                $("#contenedor").load('pages/recursos_humanos/modi_empleado.php',data2);
                //$("#contenedor").load('../cargarPOAs.php');
            }

            function ActualizarEmple()
            {
                $("#contenedor").load('pages/recursos_humanos/modi_empleado.php',data);
                //$("#contenedor").load('../cargarPOAs.php');
            }
            
              function Actualizarcargo()
            {
                $("#contenedor").load('pages/recursos_humanos/modi_empleado.php',data2);
                //$("#contenedor").load('../cargarPOAs.php');
            }
          
            

            function problemas()
            {
                $("#contenedor").text('Problemas en el servidor.');
            }



        </script>
        
    
    


</head>

<body>
        
    <h1>Editar datos de empleado</h1>
    
                                       <?php
 
  if(isset($codMensaje) and isset($mensaje)){
    if($codMensaje == 1){
      echo '<div class="alert alert-success">';
      echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
      echo '<strong>Exito! </strong>';
      echo $mensaje;
      echo '</div>';
    }else{
      echo '<div class="alert alert-danger">';
      echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
      echo '<strong>Error! </strong>';
      echo $mensaje;
      echo '</div>';
    }
  } 

?>
    
   <div class="row">  
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Informacion personal
                </div>
                <div class="panel-body">
                 <div class="row">
                        <div class="col-xs-12">
                             
                            <strong> Numero de identidad :</strong>  <?php echo $noE; ?> 
                           
                            </br>
                            <strong> Nombre :</strong> <?php echo $nombreE." ".$apellidoE ; ?> 
                            </br>
                           
                  
                        </div>
                     <div class="col-xs-12">
                         
                         
                         
                     </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>

            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    
    
    
 
    
<div class="box-header">
        <h3 class="box-title">Cargos</h3>
        <a class="btn btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i>Agregar nuevo cargo</a>
</div>
    

        <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
        <tr>
             <th><strong>ID cargo</strong></th>
            <th><strong>Cargo</strong></th>
            
            <th><strong>Fecha de ingreso</strong></th>
            <th><strong>Fecha de salida</strong></th>
            <th><strong>Dar de alta</strong></th>
            

        </tr>
            </thead>
      <tbody>
          
        <?php
        while ($row3=mysql_fetch_array($resultado2)) {
            $id = $row3['ID_cargo'];
            $fechaS=$row3['Fecha_salida_cargo'];
            
            
            
         ?>
            
          <tr>
              <td id="idcargo"><?php echo $row3['ID_cargo'] ?></td>
                  <td id="cargoP"><?php echo $row3['Cargo'] ?></td>
                  <td id="fechaic"> <?php echo $row3['Fecha_ingreso_cargo']?></td>
                  
             <?php
              if ($fechaS== NULL || $fechaS=="0000-00-00") {
                     
                  echo <<<HTML

                  <td> Actualmente </td>
                    
                  <td><button type="submit" class="altab btn btn-warning glyphicon glyphicon-send"  title="Dar de alta"> </button></center></td>

                  
HTML;
                
                }else{
                    
                echo <<<HTML
                  
                    
                    <td> $fechaS </td>
                    <td><button type="submit" class="altab btn btn-warning glyphicon glyphicon-send"  title="Dar de alta" disabled="TRUE"> </button></center></td> 

   
   
   
   
   
HTML;
    
                           
   }
             ?>
           


         </tr>


   <?php } ?>
 </tbody>
    </table>

    </div>

    
    
    
    
    
    


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Llene los campos a continuacion solicitados
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12"> 

                            <form role="form" id="form" name="form" action="#">
                                
                                    <div id="CodE" class="form-group">
                                        <div class="form-input">
                                         <label  class="col-lg-6 control-label" >Codigo Empleado :</label>
                                              
                                        <div class="col-lg-6">
                                        <input class="form-control" name="cod_empleado" id="cod" value="<?php echo$codigoE ;?>"  required> 
                                        </div>
                                         </div>
                                    </div>
                           
                                
                            <div class="form-group">
                                        <label class="col-lg-6 control-label">Fecha de ingreso como empleado :</label>
                                  
                                    <div class="col-lg-6">
                                        <input type="date"  class="form-control" name="Fecha" id="fecha" value="<?Php echo $fechaE ?>" required/> <!-- agregue el atrributo name que mediante este vas a poder acceder al valor de la etiqueta -->
                                     </div>
                            </div>
                                
                                
                                 <div class="form-group">
                                    <label class="col-lg-6 control-label"><h5><strong>Departamento laboral :</strong></h5></label>
                               

                                   <div class="col-lg-6">
                                    <select name="depar" class="form-control" id="dep">

                                        <?php
                                        $consulta_mysql = "SELECT * FROM `departamento_laboral`";
                                        $resultado3 = mysql_query($consulta_mysql);
                                        //$rec=mysql_fetch_array($resultado3);



                                        while ($row = mysql_fetch_array($resultado3)) {

                                            $id = $row['Id_departamento_laboral'];

                                            if ($id == $depID) {
                                                echo "<option selected value = '" . $row['Id_departamento_laboral'] . "'>";
                                            } else {
                                                echo "<option value = '" . $row['Id_departamento_laboral'] . "'>";
                                            }

                                            echo $row["nombre_departamento"];

                                            echo "</option>";
                                        }
                                        ?>



                                    </select>
                                </div>
                               </div>
                                
                                </br>
                                </br>
                                
                                   
                                <div class="col-xs-12">
                             <label ><strong>Observacion :</strong></label> 
                                </div>
                                
                             <div class="form-group">
                                  
                                        <textarea class="form-control" name="comentarios" rows="3"  id="obs" ><?php echo $obsE;  ?></textarea>
                             </div>
                               
                               
  
                               
    <div class="col-lg-offset-4 col-lg-12">
                               
        <button id="ActualizarE" class="btn btn-primary">Guardar cambios</button>
        <button type="reset" class="btn btn-default">Cancelar</button>
 
    </div>
                               

                
                            </form>




                      






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
        <h4 class="modal-title"><i class="glyphicon glyphicon-floppy-disk"></i> Agregar un nuevo cargo a empleado </h4>
      </div>
              <div class="modal-body">
             
                  
                
                                      <div class="form-group">
                                        <label class="col-lg-6 control-label">Cargo</label>
                                    
                                    <div class="col-lg-6" >
                                        <select name='cargo' class="form-control" id="cargo">

<?php
                                            $consulta_mysql = "SELECT * FROM `cargo`";
                                            $rec = mysql_query($consulta_mysql);



                                            while ($row = mysql_fetch_array($rec)) {
                                                echo "<option value = '" . $row['ID_cargo'] . "'>";

                                                echo $row["Cargo"];

                                                echo "</option>";
                                            }
?>
                                        </select>
                                     </div>
                                    
                                     </div>
              
                  
                  
                  
                  <div id="Rbusqueda" class="form-group">

  <?php
  
  
   
  ?>

                  </div>
              </div>
              <div class="modal-footer clearfix">
            <button name="submit" id="submit" class="insertarbc btn btn-primary pull-left"><i class="glyphicon glyphicon-pencil"></i> Insertar</button>
          </div>
                
                    
          </form>
    
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
   </div>




    
        
    </body>
    
 
            



