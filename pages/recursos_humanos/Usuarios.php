<?php

$maindir = "../../";

require($maindir."conexion/config.inc.php");

$query = $db->prepare("SELECT empleado.No_Empleado, persona.Primer_nombre, persona.Segundo_nombre, persona.Primer_apellido, persona.Segundo_apellido
          FROM empleado INNER JOIN persona ON empleado.N_identidad = persona.N_identidad WHERE empleado.estado_empleado = 1");
$query->execute();
$result1 = $query->fetchAll();
	
$query2 = $db->prepare("SELECT * FROM roles");
$query2->execute();
$result2 = $query2->fetchAll();

$query =null;
$query2 =null;

?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Ingreso de Datos del Usuario <button class="btn btn-default" data-toggle="modal" data-target="#compose-modal-insertar"><i class="glyphicon glyphicon-wrench"></i> Insertar usuario </button></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <!-- /#page-wrapper -->

    <div id="contenedor2" class="panel-body">
       <?php require('../../Datos/cargarUsuarios.php'); ?>
    </div>
	
	<!-- modal para modificar datos del usuario -->
<div class="modal fade" id="compose-modal-insertar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
			<form role="form" id="form_insertar" name="form_insertar" action="#">
			    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-floppy-disk"></i> Ingreso de Datos del Usuario </h4>
                </div>
                <div class="modal-body">
				    <div class="form-group">
				        <label>Empleado (Solo empleados activos)</label>
                        <div class="input-group">
                            <select id="test"class="form-control" width="420" style="width: 420px" name="test">
                                <option value=-1> -- Seleccione el empleado -- </option>
                                <?php foreach($result1 as $row) { ?>
                                <option value=<?php echo $row["No_Empleado"];?>><?php echo $row["No_Empleado"].' - '.$row["Primer_nombre"].' '.$row["Segundo_nombre"].' '.$row["Primer_apellido"].' '.$row["Segundo_apellido"];?></option><?php } ?>
							</select>
                        </div>
                    </div>
                    <div id="verUserName" class="form-group">
                        <label>Nombre del usuario</label>
                        <input type="text" class="form-control" id="nombreUsuario" maxlength="30" required>
                    </div>
					<div id="verPass" class="form-group">
                        <label>Contraseña (Maximo 20 carateres)</label>
                        <input type="password" class="form-control" id="password" name="password" maxlength="20" required>
                    </div>
					<div id="verPass2" class="form-group">
                        <label class="control-label">Repetir contraseña</label>
                        <input type="password" class="form-control" id="password2" name="password2" maxlength="20" required>
                    </div>
					<div class="form-group">
					    <label>Rol del usuario</label>
                        <div class="input-group">    
                            <select id="rol"class="form-control" width="420" style="width: 420px" name="rol" >
                                <option value=-1> -- Seleccione el rol -- </option>
                                <?php foreach($result2 as $row) { ?>
                                <option value=<?php echo $row["Id_Rol"];?>><?php echo $row["nombre_Rol"];?></option><?php } ?>
						    </select>
                        </div>
                    </div>          
                </div>
				<div class="modal-footer clearfix">
				    <button type="submit"  id="guardarUsuario" class="btn btn-success">Agregar</button>
                    <button type="reset" id="cancel" data-dismiss="modal" aria-hidden="true" class="btn btn-default">Cancelar</button>
			    </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
<script>

$( document ).ready(function() {
	
	$("#cancel").on("click",function(){
        $("#verUserName").removeClass("has-warning");
		$("#verUserName").find("label").text("Nombre del usuario");
		$("#verPass").removeClass("has-warning");
		$("#verPass").find("label").text("Contraseña (Maximo 20 carateres)");
		$("#verPass2").removeClass("has-error");
		$("#verPass2").removeClass("has-warning");
		$("#verPass2").find("label").text("Repetir contraseña");
	});
	
	$("#form_insertar").submit(function(e) {
	    e.preventDefault();
		$("#compose-modal-insertar").modal('hide');
		if(validator()){
            data ={ 
			    empleado:$("#test option:selected").val(),
				nombreUsuario:$("#nombreUsuario").val(),
				password:$("#password").val(),
				rol:$("#rol option:selected").val(),
				tipoProcedimiento:"insertar"
            };
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: inicioEnvio,
                success:InsertarUsuario,
                timeout:4000,
                error:problemas
            }); 
            return false;
		}
	});
});

    function soloLetrasYNumeros(text){
	    var letters = /^[0-9a-zA-Z]+$/; 
			if(text.match(letters)){
			    return true;
			}else{
			    return false;
			}
	}

    function validator(){
	    var nombre = $("#nombreUsuario").val();
	    var pass1 = $("#password").val();
		var pass2 = $("#password2").val();
		
		//valida si se han itroduzido otros digitos aparte de numeros y letras
		
		if(soloLetrasYNumeros(nombre) == false){
		    $("#verUserName").addClass("has-warning");
			$("#verUserName").find("label").text("Nombre del usuario: Solo son permitidos numeros y letras");
			$("#nombreUsuario").focus();
			return false;
		}else{
		    $("#verUserName").removeClass("has-warning");
			$("#verUserName").find("label").text("Nombre del usuario");
		}
		
		if(soloLetrasYNumeros(pass1) == false){
		    $("#verPass").addClass("has-warning");
			$("#verPass").find("label").text("Contraseña: Solo son permitidos numeros y letras");
			$("#password").focus();
			return false;
		}else{
		    $("#verPass").removeClass("has-warning");
			$("#verPass").find("label").text("Contraseña (Maximo 20 carateres)");
		} 
		
		if(soloLetrasYNumeros(pass2) == false){
		    $("#verPass2").addClass("has-warning");
			$("#verPass2").find("label").text("Repetir contraseña: Solo son permitidos numeros y letras");
			$("#password2").focus();
			return false;
		}else{
		    $("#verPass2").removeClass("has-warning");
			$("#verPass2").find("label").text("Repetir contraseña");
		}
		
		// valida si el password es el mismo que se ingreso la segunda vez
		if(pass1 == pass2){
		    $("#verPass2").removeClass("has-error");
			$("#verPass2").find("label").text("Repetir contraseña");
		}else{
		    $("#verPass2").addClass("has-error");
			$("#verPass2").find("label").text("Repetir contraseña: Error la contraseña no coincide");
			$("#password2").focus();
		    return false;
		}
		
		return true;
	}

    function inicioEnvio()
    {
        var x = $("#contenedor2");
        x.html('Cargando...');
    }

    function InsertarUsuario()
    {
	    $('body').removeClass('modal-open');
        $("#contenedor2").load('Datos/cargarUsuarios.php',data);
    }
            
    function problemas()
    {
        $("#contenedor2").text('Problemas en el servidor.');
    }
	
</script>
