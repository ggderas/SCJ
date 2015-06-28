<?php
session_start();

        include "../../../../Datos/conexion.php";


        if(isset($_POST['identi'])){
            $identi=$_POST['identi'];
            $_SESSION['Nidenti'] = $identi;

            $s = mysql_query("SELECT * FROM persona WHERE N_identidad = '".$identi."'");
            if($row = mysql_fetch_array($s)){
                $id = $row['N_identidad'];
                $pNombre = $row['Primer_nombre'];
                $sNombre = $row['Segundo_nombre'];
                $pApellido = $row['Primer_apellido'];
                $sApellido = $row['Segundo_apellido'];
                $fNac = $row['Fecha_nacimiento'];
                $sexo = $row['Sexo'];
                $direc = $row['Direccion'];
                $email = $row['Correo_electronico'];
                $estCivil = $row['Estado_Civil'];
                $nacionalidad = $row['Nacionalidad'];

          
            }
        }

		function limpiar($tags){
            $tags = strip_tags($tags);
            return $tags;
        }

        //Información Personal
	  	if(!empty($_POST['identi']) and !empty($_POST['primerNombre']) and !empty($_POST['primerApellido'])
            and !empty($_POST['direccion'])and !empty($_POST['email'])){
            $identi=limpiar($_POST['identi']);
            $pNombre=limpiar($_POST['primerNombre']);
            $sNombre=limpiar($_POST['segundoNombre']);
            $pApellido=limpiar($_POST['primerApellido']);
            $sApellido=limpiar($_POST['segundoApellido']);
            $fecha=$_POST['fecha'];
            $sexo = $_POST['sexo'];
            $direc=limpiar($_POST['direccion']);
            $email=limpiar($_POST['email']);
            $estCivil = $_POST['estCivil'];
            $nacionalidad = $_POST['nacionalidad'];


            $gId = $_SESSION['Nidenti'];
            //Agregar ON UPDATE CASCADE, ON DELETE CASCADE A LA TABLA telefono.
            mysql_query("UPDATE persona SET N_identidad = '$identi', Primer_nombre = '$pNombre', Segundo_nombre = '$sNombre', Primer_apellido = '$pApellido',
            Segundo_apellido = '$sApellido', Fecha_nacimiento = '$fecha', Sexo = '$sexo', Direccion = '$direc', Correo_electronico = '$email', Estado_Civil = '$estCivil', Nacionalidad = '$nacionalidad'
            WHERE N_identidad = '$gId'");

            echo " Datos personales se han actualizado con éxito!";
        }
?>
    
<script>

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

   

     $(document).ready(function(){
        $("#form").submit(function(e) {
            e.preventDefault();
            
          if(validator()){
        data={
            identi:$('#identidad').val(),
            primerNombre:$('#primerNombre').val(),
            segundoNombre:$('#segundoNombre').val(),
            primerApellido:$('#primerApellido').val(),
            segundoApellido:$('#segundoApellido').val(),
            fecha:$('#fecha').val(),
            sexo:document.querySelector('input[name="sexo"]:checked').value,
            direccion:$('#direccion').val(),
            email:$('#email').val(),
            estCivil:$('#estCivil').val(),
            nacionalidad:$('#nacionalidad').val()
        };

        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            beforeSend: inicioEnvioAct,
            success: llegadaActualPersona,
            timeout: 4000,
            error: problemas
        });
        return false;
          }
            
        });
    });

 
   

    function inicioEnvioAct()
    {
        var y = $("#contenedor");
        y.html('Cargando...');
    }

    function llegadaActualPersona()
    {
        $("#contenedor").load('pages/recursos_humanos/cv/actualizar/personaActualizar.php',data);
    }

    function problemasAct()
    {
        $("#contenedor").text('Problemas en el servidor.');
    }
    
    
    
    
    
         function validator(){
            var identidad = $("#identidad").val();    
	    var nombre = $("#primerNombre").val();
            var snombre =$("#segundoNombre").val();
            var pApellido = $("#primerApellido").val();
            var sApellido = $("#segundoApellido").val();
            var nacionalidad = $("#nacionalidad").val(); 
         //   var correo = $("#email").val();
         //   var direccion = $("#direccion").val();
	 
		
		//valida si se han itroduzido otros digitos aparte de numeros y letras
                
                
                
                if(identidadconf(identidad) == false){
		    $("#identi").addClass("has-warning");
			$("#identi").find("label").text("identidad: Solo son permitidos numeros");
			$("#identidad").focus();
			return false;
		}else{
		    $("#identi").removeClass("has-warning");
			$("#identi").find("label").text("Numero de identidad");
		}
                
                
		
		if(soloLetras(nombre) == false){
		    $("#primerN").addClass("has-warning");
			$("#primerN").find("label").text("Primer nombre:Solo letras");
			$("#primerNombre").focus();
			return false;
		}else{
		    $("#primerN").removeClass("has-warning");
			$("#primerN").find("label").text("Primer nombre");
		}
		
		if(soloLetras(snombre) == false){
		    $("#Snombre").addClass("has-warning");
			$("#Snombre").find("label").text("Segundo nombre:Solo letras");
			$("#segundoNombre").focus();
			return false;
		}else{
		    $("#Snombre").removeClass("has-warning");
			$("#Snombre").find("label").text("Segundo nombre");
		}
                
                if(soloLetras(pApellido) == false){
		    $("#pApellido").addClass("has-warning");
			$("#pApellido").find("label").text("Primer apellido:Solo letras");
			$("#primerApellido").focus();
			return false;
		}else{
		    $("#pApellido").removeClass("has-warning");
			$("#pApellido").find("label").text("Primer apellido");
		}
                
                
                if(soloLetras(sApellido) == false){
		    $("#sApellido").addClass("has-warning");
			$("#sApellido").find("label").text("Segundo apellido:Solo letras");
			$("#segundoApellido").focus();
			return false;
		}else{
		    $("#sApellido").removeClass("has-warning");
			$("#sApellido").find("label").text("Segundo apellido");
		}
                
                 if(soloLetras(nacionalidad) == false){
		    $("#nacio").addClass("has-warning");
			$("#nacio").find("label").text("Nacionalidad:Solo letras");
			$("#nacionalidad").focus();
			return false;
		}else{
		    $("#nacio").removeClass("has-warning");
			$("#nacio").find("label").text("Nacionalidad");
		}
                
      

		return true;
	}
    
    

</script>

</script>
<script src="pages/recursos_humanos/cv/validacion.js"></script>

<script>
    $(function(){
        $('#identidad').validCampo('0123456789-');
        $('#primerNombre').validCampo(' abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZáéíóúÁÉÍÓÚ');
        $('#segundoNombre').validCampo(' abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZáéíóúÁÉÍÓÚ');
        $('#primerApellido').validCampo(' abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZáéíóúÁÉÍÓÚ');
        $('#segundoApellido').validCampo(' abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZáéíóúÁÉÍÓÚ');
        $('#nacionalidad').validCampo(' abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZáéíóúÁÉÍÓÚ');
    });
</script>


<html lang="es">
    <head></head>
    <body>
        
        
          <form role="form" id="form" method="post" class="form-horizontal" action="#">
                        <!-- .panel-heading -->
                        <div class="panel-body">
                            <h1>Actualización de Información Personal</h1></br>
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <label><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Datos Generales</label>
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                <div class="col-lg-8">
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Número de Identidad</label>
                                                            <div class="col-sm-7"><input id="identidad" class="form-control" name="identidad"  value="<?php echo "$id"; ?>" required pattern="[0-9]{4}[\-][0-9]{4}[\-][0-9]{5}"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Primer nombre</label>
                                                            <div class="col-sm-7"><input id="primerNombre" class="form-control" name="primerNombre" value="<?php echo "$pNombre";?>" required></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label">Segundo nombre</label>
                                                            <div class="col-sm-7"><input id="segundoNombre" class="form-control" name="segundoNombre" value="<?php echo "$sNombre";?>" ></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Primer Apellido</label>
                                                            <div class="col-sm-7"><input id="primerApellido" class="form-control" name="primerApellido" value="<?php echo"$pApellido"; ?>"required></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Segundo Apellido</label>
                                                            <div class="col-sm-7"><input id="segundoApellido" class="form-control" name="segundoApellido" value="<?php echo "$sApellido"; ?>" ></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Sexo</label>
                                                            <?php
                                                            if($sexo == 'F'){
                                                                echo '<div class="col-sm-7"><input type="radio" name="sexo" id="sexoFem" value="F" checked>&nbsp;Femenino';
                                                                echo '<input type="radio" name="sexo" id="sexoMas" value="M">&nbsp;Masculino</div>';
                                                            }
                                                            if($sexo == 'M'){
                                                                echo '<div class="col-sm-7"><input type="radio" name="sexo" id="sexoFem" value="F">&nbsp;Femenino';
                                                                echo '<input type="radio" name="sexo" id="sexoMas" value="M" checked>&nbsp;Masculino</div>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Nacionalidad</label>
                                                            <div class="col-sm-7"><input id="nacionalidad" class="form-control" name="nacionalidad" value="<?php echo "$nacionalidad"; ?>" required></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label"><strong><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Fecha de Nacimiento</strong></label>
                                                            <div class="col-sm-7"><input id="fecha" type="date" name="fecha" autocomplete="off" class="input-xlarge" format="yyyy-mm-dd" value="<?php echo"$fNac";?>" required><br></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Estado civil</label>
                                                            <div class="col-sm-7"><select class="form-control" id="estCivil" name="estCivil">
                                                                    <?php
                                                                echo '"<option value="soltero"';
                                                                if($estCivil == "Soltero") echo "selected";
                                                                echo '>Soltero</option>
                                                                <option value="casado"';
                                                                if($estCivil == "Casado") echo "selected";
                                                                echo '>Casado</option>
                                                                <option value="divorciado"';
                                                                if($estCivil == "Divorciado") echo "selected";
                                                                echo '>Divorciado</option>
                                                                <option value="viudo"';
                                                                if($estCivil == "Viudo") echo "selected";
                                                                echo'>Viudo</option>';
                                                                
                                                                        ?>
                                                                </select>
                                                                        
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <label><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Información de contacto</label>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label">Dirección</label>
                                                    <div class="col-sm-7"><textarea id="direccion" class="form-control" rows="3" name="direccion"><?php echo"$direc"; ?></textarea></div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Correo electrónico</label>
                                                    <div class="col-sm-7"><input id="email" type="email" class="form-control" name="email" value="<?php echo "$email"; ?>" required></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </br><div class="alert alert-info" role="alert">IMPORTANTE: Los campos marcados con el signo <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> son obligatorios.</div>
                                </br><button type="submit" id="actualizar" class="ActualizarB btn btn-primary">Guardar Información</button>
                                </div>
                                </form>
        
        
        
        
    </body>
    
</html>