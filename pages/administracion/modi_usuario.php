<?php
    require("../../conexion/config.inc.php");
   
    $id = $_GET['idUsuario'];
   
	$query_1 = $db->prepare("SELECT usuario.id_Usuario, usuario.No_Empleado, usuario.nombre, usuario.Id_Rol, usuario.Fecha_Creacion, usuario.Fecha_Alta, usuario.Estado,
            roles.Descripcion FROM usuario INNER JOIN roles ON usuario.Id_Rol = roles.Id_Rol WHERE usuario.id_Usuario = :id");
    $query_1->bindParam(":id",$id);
    $query_1->execute();
    $result_1 = $query_1->fetch();

	$query_2 = $db->prepare("SELECT empleado.No_Empleado, persona.Primer_nombre, persona.Segundo_nombre, persona.Primer_apellido, persona.Segundo_apellido
          FROM empleado INNER JOIN persona ON empleado.N_identidad = persona.N_identidad WHERE empleado.estado_empleado = 1");
    $query_2->execute();
	$rows_2 = $query_2->fetchAll();
	
	$query_3 = $db->prepare("SELECT * FROM roles");
    $query_3->execute();
    $rows_3 = $query_3->fetchAll();
	
	$query_1 = null;
    $query_2 = null;
	$query_3 = null;
	$db = null;

	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	
	$date = date_create($result_1['Fecha_Creacion']);
	
	if($result_1["Estado"] == 0){
	$date2 = date_create($result_1['Fecha_Alta']);
	}
        echo "<h3>Usuario: <strong>".$result_1['nombre']."</strong></h3> Ingresado el ".$dias[date_format($date,'w')]." ".date_format($date,'d')." de ".$meses[date_format($date,'n')-1]. " del ".date_format($date,'Y'); ?>
			<form role="form" id="form_actualizar" name="form_actualizar" action="#">
			<input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $id; ?>">
					<div class="form-group">
				        <label>Empleado (Solo empleados activos)</label>
                        <div class="input-group">
                            <select id="test_actualizar"class="form-control" width="420" style="width: 420px" name="test_actualizar">
                                <option value=-1> -- Seleccione el empleado -- </option>
                                <?php foreach($rows_2 as $row) { ?>
                                <option <?php if($row["No_Empleado"] == $result_1["No_Empleado"]){ echo "selected"; } ?> value=<?php echo $row["No_Empleado"];?>>
								<?php echo $row["No_Empleado"].' - '.$row["Primer_nombre"].' '.$row["Segundo_nombre"].' '.$row["Primer_apellido"].' '.$row["Segundo_apellido"];?></option><?php } ?>
							</select>
                        </div>
                    </div>
                    <div id="verUserName_actualizar" class="form-group">
                        <label>Nombre del usuario</label>
						<input type="hidden" id="nombreUsuarioAnt" name="nombreUsuarioAnt" value="<?php echo $result_1['nombre']; ?>">
                        <input type="text" class="form-control" id="nombreUsuario_actualizar" maxlength="30" value="<?php echo $result_1['nombre'] ?>" placeholder="<?php echo $result_1['nombre'] ?>" required>
                    </div>
					<div id="verPass_actualizar" class="form-group">
                        <label>Contraseña (Maximo 20 carateres)</label>
                        <input type="password" class="form-control" id="password_actualizar" name="password_actualizar" maxlength="20" required>
                    </div>
					<div id="verPass2_actualizar" class="form-group">
                        <label class="control-label">Repetir contraseña</label>
                        <input type="password" class="form-control" id="password2_actualizar" name="password2_actualizar" maxlength="20" required>
                    </div>
					<div class="form-group">
					    <label>Rol del usuario</label>
                        <div class="input-group">    
                            <select id="rol_actualizar"class="form-control" width="420" style="width: 420px" name="rol_actualizar" >
                                <option value=-1> -- Seleccione el rol -- </option>
                                <?php foreach($rows_3 as $row) { ?>
                                <option <?php if($row["Id_Rol"] == $result_1["Id_Rol"]){ echo "selected"; } ?> value=<?php echo $row["Id_Rol"];?>>
								<?php echo $row["Descripcion"];?></option><?php } ?>
						    </select>
                        </div>
                    </div>
					<div class="form-group">
					    <?php if($result_1["Estado"] == 0){
						    echo '<label>El usuario esta inactivo, y la fecha de alta es: '.$dias[date_format($date2,'w')]." ".date_format($date2,'d')." de ".$meses[date_format($date2,'n')-1]. " del ".date_format($date2,'Y').'</label>';
						}
						?>
					</div>
					<div class="form-group">
                        <label>Estado del usuario</label>
							<?php 
							if($result_1["Estado"] == 1){
							    echo '<label class="radio-inline"><input type="radio" id="radio_activo" name="radio_activo" checked>Activo</label>';
								echo '<label class="radio-inline"><input type="radio" id="radio_inactivo" name="radio_inactivo">Inactivo</label>';
							}else{
							    echo '<label class="radio-inline"><input type="radio" id="radio_activo" name="radio_activo">Activo</label>';
							    echo '<label class="radio-inline"><input type="radio" id="radio_inactivo" name="radio_inactivo" checked>Inactivo</label>';
							} 
							?>
                    </div> 	
                <div class="modal-footer clearfix">
                    <button id="submit_actualizar" name="submit_actualizar" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-pencil"></i> Actualizar </button>
                </div>
			</form>

<script type="text/javascript" >
$( document ).ready(function() {

    $("#radio_activo").change(function(){
	    $("#radio_inactivo").prop("checked",false)
	});
	
	$("#radio_inactivo").change(function(){
	    $("#radio_activo").prop("checked",false)
	});
	
	$("#form_actualizar").submit(function(e) {
	    e.preventDefault();
		    var Estado_actualizar;
			if($("#radio_activo").prop('checked')){
			    Estado_actualizar = 1;
			}else if($("#radio_inactivo").prop('checked')){
			    Estado_actualizar = 0;
			}
		if(validator2()){
		
		if (confirm('Esta seguro que desea modificar este registro?')) {
		$("#compose-modal-actualizar").modal('hide');
            data ={ 
			    idUsuario:$("#idUsuario").val(),
			    empleado:$("#test_actualizar option:selected").val(),
				nombreUsuarioAnt:$("#nombreUsuarioAnt").val(),
				nombreUsuario:$("#nombreUsuario_actualizar").val(),
				password:$("#password_actualizar").val(),
				rol:$("#rol_actualizar option:selected").val(),
				estado:Estado_actualizar,
				tipoProcedimiento:"actualizar_"
            };
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: inicioEnvio,
                success:llegadaGuardar,
                timeout:4000,
                error:problemas
            }); 
            return false;
		}
		
	    }
	});	
	
});

    function validator2(){
	    var nombre = $("#nombreUsuario_actualizar").val();
	    var pass1 = $("#password_actualizar").val();
		var pass2 = $("#password2_actualizar").val();
		
		$('.form-group').removeClass("has-warning");
		$('.form-group').removeClass("has-error");
		
		//valida si se han itroduzido otros digitos aparte de numeros y letras
		
		if(soloLetrasYNumeros(nombre) == false){
		    $("#verUserName_actualizar").addClass("has-warning");
			$("#verUserName_actualizar").find("label").text("Nombre del usuario: Solo son permitidos numeros y letras");
			$("#nombreUsuario_actualizar").focus();
			return false;
		}else{
		    $("#verUserName_actualizar").removeClass("has-warning");
			$("#verUserName_actualizar").find("label").text("Nombre del usuario");
		}
		
		if(soloLetrasYNumeros(pass1) == false){
		    $("#verPass_actualizar").addClass("has-warning");
			$("#verPass_actualizar").find("label").text("Contraseña: Solo son permitidos numeros y letras");
			$("#password_actualizar").focus();
			return false;
		}else{
		    $("#verPass_actualizar").removeClass("has-warning");
			$("#verPass_actualizar").find("label").text("Contraseña (Maximo 20 carateres)");
		} 
		
		if(soloLetrasYNumeros(pass2) == false){
		    $("#verPass2_actualizar").addClass("has-warning");
			$("#verPass2_actualizar").find("label").text("Repetir contraseña: Solo son permitidos numeros y letras");
			$("#password2_actualizar").focus();
			return false;
		}else{
		    $("#verPass2_actualizar").removeClass("has-warning");
			$("#verPass2_actualizar").find("label").text("Repetir contraseña");
		}
		
		// valida si el password es el mismo que se ingreso la segunda vez
		if(pass1 == pass2){
		    $("#verPass2_actualizar").removeClass("has-error");
			$("#verPass2_actualizar").find("label").text("Repetir contraseña");
		}else{
		    $("#verPass2_actualizar").addClass("has-error");
			$("#verPass2_actualizar").find("label").text("Repetir contraseña: Error la contraseña no coincide");
			$("#password2_actualizar").focus();
		    return false;
		}
		
		if(nombre.length < 5){
		    $("#verUserName_actualizar").addClass("has-warning");
			$("#verUserName_actualizar").find("label").text("Nombre del usuario: El nombre debe ser mayor a 5 caracteres");
			$("#nombreUsuario_actualizar").focus();
			return false;
		}
		
		if(pass1.length < 8){
		    $("#verPass_actualizar").addClass("has-warning");
			$("#verPass_actualizar").find("label").text("Contraseña: debe contener por lo menos 8 caracteres");
			$("#password_actualizar").focus();
			return false;
		}
		
		if(pass2.length < 8){
		    $("#verPass2_actualizar").addClass("has-warning");
			$("#verPass2_actualizar").find("label").text("Repetir contraseña: debe contener por lo menos 8 caracteres");
			$("#password2_actualizar").focus();
			return false;
		}
		
		return true;
	}

    function inicioEnvio()
    {
        var x = $("#contenedor2");
        x.html('Cargando...');
    }
	
    function llegadaGuardar()
    {
	    $('body').removeClass('modal-open');
        $("#contenedor2").load('pages/administracion/cargarUsuarios.php',data);
		$("#grafo_usuarios").load('pages/administracion/grafoUsuarios.php');
    }

    function problemas()
    {
        $("#contenedor2").text('Problemas en el servidor.');
    }
</script>