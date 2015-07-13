<?php 

//conexion a la base de datos 
 require_once("../../conexion/conn.php");  
											     
$link = mysqli_connect($host, $username, $password, $dbname);

//variables recibidas por ajax	
$idusuario =  $_POST['idusuario'];
$idEmpleado =  $_POST['no_empleado'];
$depto = $_POST['area'];
$motivo =  $_POST['motivo'];
$edificio =  $_POST['edificio'];
$fecha =  $_POST['fecha'];
$horai =  $_POST['horai'];
$horaf =  $_POST['horaf'];
$cantidad =  $_POST['cantidad'];
$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes
$cont=0;
echo $idEmpleado;
//consultas para encontrar los ID de cada campo seleccionado en los combobox
$result = mysqli_query($link, "SELECT Edificio_ID FROM edificios  where descripcion='".$edificio."'");
$result2 = mysqli_query($link, "SELECT Id_departamento_laboral FROM departamento_laboral  where nombre_departamento='".$depto."'");
$result3 = mysqli_query($link, "SELECT Motivo_ID FROM motivos  where descripcion='".$motivo."'");
$result5 = mysqli_query($link, "SELECT DATE_FORMAT(NOW(), '%Y-%m-%d') as fecha_slctd");

//$consult = mysqli_query($link, "SELECT No_Empleado FROM usuario  where id_Usuario='$idusuario'");
//$row2 = mysqli_fetch_array($consult);

//se obtiene la fecha para validar que no hayan solicitudes con misma fecha para un usuario
$fquery = mysqli_query($link, "select fecha_solicitud, DATE_FORMAT(fecha, '%Y-%m-%d') as fecha from permisos where permisos.No_Empleado='".$idEmpleado."' and permisos.estado = 'En espera'");
$frow = mysqli_fetch_array($fquery);

// data seek de consultas
mysqli_data_seek ($result,$cont);
mysqli_data_seek ($result2,$cont);
mysqli_data_seek ($result3,$cont);

// arreglos de consultas
$extraido= mysqli_fetch_array($result);
$extraido2= mysqli_fetch_array($result2);
$extraido3= mysqli_fetch_array($result3);
$fecha_solic = mysqli_fetch_array($result5);

//Consulta de inserción a la base de datos
	$query = "INSERT INTO permisos (
	id_departamento,
	No_Empleado,
	id_motivo,
	dias_permiso,
	hora_inicio,
	hora_finalizacion,
	id_Edificio_Registro,
	fecha,
	estado,
	fecha_solicitud,
	id_usuario)
	VALUES(
	'".$extraido2['Id_departamento_laboral']."',
	'".$idEmpleado."',
	'".$extraido3['Motivo_ID']."',
	'".$cantidad."',
	'".$horai."',
	'".$horaf."',
	'".$extraido['Edificio_ID']."',
	'".$fecha."',
	'Espera',
	Date_format(now(),'%Y-%m-%d'),
	'".$idusuario."'
	)";
	//se ejecuta la consulta de insercion y se verifica si se ha realizado o si ha fallado
	
	$result6 = mysqli_query($link, "SELECT DATE_FORMAT(fecha, '%Y-%m-%d') as fecha from permisos where fecha between DATE_SUB(DATE_FORMAT('".$fecha."', '%Y-%m-%d'), INTERVAL '".$cantidad."' DAY) 
							and DATE_ADD(DATE_FORMAT('".$fecha."', '%Y-%m-%d'), INTERVAL '".$cantidad."' DAY) and No_Empleado = '".$idEmpleado."'");
	
	$field_cnt = $result6->field_count;
	
	if($field_cnt >= 0){
		if($fecha_solic['fecha_slctd']==$frow['fecha_solicitud']){
			echo "Solamente puede realizar una solicitud por día";
		}else{
			if($fecha == $frow['fecha']){
				echo "Ya tiene una solicitud de permiso con la fecha ingresada";
			}else{ 
				$result4 = mysqli_query($link, $query) or die("Error " . mysqli_error($link));
				
				if ($result4 = 1) {
					echo "Solicitud ingresada Exitosamente";
				}
			}
		}
	}else{
		echo "Hay traslape de fechas con una solicitud previa";
	}
	
    mysqli_close($link); //Cierra la conexión con la base de datos

?>











