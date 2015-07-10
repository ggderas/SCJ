<?php

$maindir = "../../";
require($maindir."conexion/config.inc.php");
require_once($maindir."fpdf/mysql_table.php");
require_once($maindir."funciones/check_session.php");
require_once($maindir."funciones/timeout.php");
require_once("../../conexion/conn.php"); 
$conexion = mysqli_connect($host, $username, $password, $dbname);
mysql_connect($host, $username, $password);
mysql_select_db($dbname);

$idusuario= $_SESSION['user_id']; 
$idempleado= $_GET['idempleado'];
$depto = $_GET['area'];
$motivo =  $_GET['motivo'];
$fechai =  $_GET['fecha_i'];
$fechaf =  $_GET['fecha_f'];
$rol = $_SESSION['user_rol'];
$query = mysqli_query($conexion, "SELECT  Id_departamento FROM empleado where No_Empleado in (Select No_Empleado from usuario where id_Usuario='".$idusuario."')");
		mysqli_data_seek ($query,0);
		$extraido = mysqli_fetch_array($query);
$consulta2=0;

if( $fechai!="" and $fechaf!=""){
	$consulta2=1;

}

	if($rol == 30){
		
	
	if( $motivo!='-1' ){
		
			$consulta4 = "Select permisos.id_Permisos,CONCAT(Primer_nombre, ' ', Segundo_nombre, ' ', Primer_apellido, ' ', Segundo_Apellido) as Nombre, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
			DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, 
			departamento_laboral.nombre_departamento from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
			inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
			inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
			where 	permisos.id_departamento = '".$extraido['Id_departamento']."'
			and  motivos.descripcion='".$motivo."' 
			and	date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')
			and empleado.No_Empleado='".$idempleado." '
			ORDER BY fecha asc";}
	
	if( $motivo=='-1' ){
		
			$consulta4 = "Select permisos.id_Permisos,CONCAT(Primer_nombre, ' ', Segundo_nombre, ' ', Primer_apellido, ' ', Segundo_Apellido) as Nombre, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
			DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, 
			departamento_laboral.nombre_departamento from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
			inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
			inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
			where 	permisos.id_departamento = '".$extraido['Id_departamento']."'
			and	date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')
			and empleado.No_Empleado='".$idempleado." '
			ORDER BY fecha asc";}
			
			

	}else{
		if($rol == 50){
			
			if( $motivo!='-1' and $depto!='-1'){
		
			$consulta4 = "Select permisos.id_Permisos, CONCAT(Primer_nombre, ' ', Segundo_nombre, ' ', Primer_apellido, ' ', Segundo_Apellido) as Nombre,Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
			DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, 
			departamento_laboral.nombre_departamento from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
			inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
			inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
			where  departamento_laboral.nombre_departamento ='".$depto."' 
			and motivos.descripcion='".$motivo."' 
			and date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')
			and empleado.No_Empleado='".$idempleado." '
			ORDER BY fecha asc";}
			
				
			if(  $motivo=='-1' and $depto!='-1'){
		
			$consulta4 = "Select permisos.id_Permisos, CONCAT(Primer_nombre, ' ', Segundo_nombre, ' ', Primer_apellido, ' ', Segundo_Apellido) as Nombre,Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
			DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, 
			departamento_laboral.nombre_departamento from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
			inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
			inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
			where  departamento_laboral.nombre_departamento ='".$depto."' 
			and date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')
			and empleado.No_Empleado='".$idempleado." '
			ORDER BY fecha asc";}
			
			if(  $motivo!='-1' and $depto=='-1'){
		
			$consulta4 = "Select permisos.id_Permisos, CONCAT(Primer_nombre, ' ', Segundo_nombre, ' ', Primer_apellido, ' ', Segundo_Apellido) as Nombre,Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
			DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, 
			departamento_laboral.nombre_departamento from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
			inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
			inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
			where motivos.descripcion='".$motivo."'
			and date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')
			and empleado.No_Empleado='".$idempleado." '
			ORDER BY fecha asc";}
			
			if(  $motivo=='-1' and $depto=='-1'){
		
			$consulta4 = "Select permisos.id_Permisos, CONCAT(Primer_nombre, ' ', Segundo_nombre, ' ', Primer_apellido, ' ', Segundo_Apellido) as Nombre,Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
			DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, 
			departamento_laboral.nombre_departamento from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
			inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
			inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
			where 
			date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')
			and empleado.No_Empleado='".$idempleado." '
			ORDER BY fecha asc";}
			
			
		}
	}


class PDF extends PDF_MySQL_Table
{
	function Header()
	{
		//Title
		//$this->SetFont('Arial','',18);
		//$this->Cell(0,6,'World populations',0,1,'C');
		//$this->Ln(10);
		//Ensure table header is output
		//parent::Header();
	}
}

	
	$pdf=new PDF();
	$pdf->AddPage("L","Letter");
	$pdf->SetFont('Arial', '', 18);
	$pdf->Image($maindir.'assets/img/lucen-aspicio.png', 50,15,200,200, 'PNG');
	$pdf->Image($maindir.'assets/img/logo_unah.png' , 15,5,24,36, 'PNG');
	$pdf->Image($maindir.'assets/img/logo-cienciasjuridicas.png' , 230,8, 35 , 35,'PNG');
	$pdf->Cell(22, 10, '', 0);
	$pdf->SetFont('Arial', '', 18);
	$pdf->Cell(45, 10, '', 0);
	$pdf->Cell(70, 10, utf8_decode('Universidad Nacional Autónoma de Honduras'), 0);
	$pdf->Ln(10);
	$pdf->SetFont('Arial', 'U', 14);
	$pdf->Cell(60, 8, '', 0,0,"C");
	$pdf->Cell(130, 8, 'Reportes de Permisos Personales', 0,0,"C");
	$pdf->Ln(25);

	//$pdf->AddCol('N',25,'#Empleado','C');
	$pdf->AddCol('Nombre',70,'Nombre Completo ','C');
	$pdf->AddCol('nombre_departamento',30,'Departamento', 'C');
	$pdf->AddCol('mtd',30,'Motivo', 'C');
	$pdf->AddCol('fecha',22,'Fecha', 'C');
	$pdf->AddCol('hora_inicio',20,'inicio', 'C');
	$pdf->AddCol('hora_finalizacion',20,'fin', 'C');
	$pdf->AddCol('dias_permiso',10,utf8_decode('Días'), 'C');


	
	$pdf->Table($consulta4);
				
	$pdf->Output();

?>