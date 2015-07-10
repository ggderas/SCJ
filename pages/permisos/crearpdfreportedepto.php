<?php

$maindir = "../../";

require_once($maindir."fpdf/mysql_table.php");
require($maindir."conexion/config.inc.php");



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
	

	
	  
require_once("../../conexion/conn.php");  
mysql_connect($host, $username, $password);
mysql_select_db($dbname);

$depto = $_GET['area'];
$motivo =  $_GET['motivo'];
$fechai =  $_GET['fecha_i'];
$fechaf =  $_GET['fecha_f'];

$consulta=0;
if( ($fechai!="" and $fechaf!="")){
$consulta=1;
}

if( $depto=='-1' and  $motivo=='-1'){
        
                     
	$query1  = " 
Select empleado.No_Empleado, CONCAT(Primer_nombre, ' ', Segundo_nombre, ' ', Primer_apellido, ' ', Segundo_Apellido) as Nombre, departamento_laboral.nombre_departamento, motivos.descripcion, 
COUNT(permisos.id_Permisos) as Solicitudes, SUM(permisos.dias_permiso) as Inasistencias from permisos
 inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
 inner join empleado on empleado.No_Empleado=permisos.No_Empleado 
 inner join persona on persona.N_identidad=empleado.N_identidad 
 inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
 where date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')	
	GROUP BY Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, departamento_laboral.nombre_departamento ORDER BY Primer_nombre asc";


	}
	
// 	con filtro del departemento
	if( $depto!='-1' and  $motivo=='-1'   and ($fechai!="" and $fechaf!="")){
    		
	$query1  =  " 
Select empleado.No_Empleado, CONCAT(Primer_nombre, ' ', Segundo_nombre, ' ', Primer_apellido, ' ', Segundo_Apellido) as Nombre, departamento_laboral.nombre_departamento,motivos.descripcion,  
COUNT(permisos.id_Permisos) as Solicitudes, SUM(permisos.dias_permiso) as Inasistencias from permisos
 inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
 inner join empleado on empleado.No_Empleado=permisos.No_Empleado 
 inner join persona on persona.N_identidad=empleado.N_identidad 
 inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
 where  departamento_laboral.nombre_departamento='".$depto."'
 and date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')	
	GROUP BY Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, departamento_laboral.nombre_departamento ORDER BY Primer_nombre asc";
}
		
	// 	con filtro del motivos y depattamento 	
		if( $depto!='-1' and  $motivo!='-1'   and ($fechai!="" and $fechaf!="")){
                           
	
			
	$query1  = " 
Select empleado.No_Empleado, CONCAT(Primer_nombre, ' ', Segundo_nombre, ' ', Primer_apellido, ' ', Segundo_Apellido) as Nombre, departamento_laboral.nombre_departamento,motivos.descripcion, 
COUNT(permisos.id_Permisos) as Solicitudes, SUM(permisos.dias_permiso) as Inasistencias from permisos
 inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
 inner join empleado on empleado.No_Empleado=permisos.No_Empleado 
 inner join persona on persona.N_identidad=empleado.N_identidad 
 inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
 where  departamento_laboral.nombre_departamento='".$depto."' and motivos.descripcion='".$motivo."' and 
 date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')	
	GROUP BY Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, departamento_laboral.nombre_departamento,motivos.descripcion ORDER BY Primer_nombre asc";

	}
	
// 	por fechas 
		if( $depto=='-1' and  $motivo!='-1'  ){
                           
	
		
	$query1  = " 
Select empleado.No_Empleado, CONCAT(Primer_nombre, ' ', Segundo_nombre, ' ', Primer_apellido, ' ', Segundo_Apellido) as Nombre, departamento_laboral.nombre_departamento, motivos.descripcion, 
COUNT(permisos.id_Permisos) as Solicitudes, SUM(permisos.dias_permiso) as Inasistencias from permisos
 inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
 inner join empleado on empleado.No_Empleado=permisos.No_Empleado 
 inner join persona on persona.N_identidad=empleado.N_identidad 
 inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
 where  motivos.descripcion='".$motivo."' and 
 date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')	
	GROUP BY Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, departamento_laboral.nombre_departamento,motivos.descripcion ORDER BY Primer_nombre asc";

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
	$pdf->AddCol('Nombre',70,'Nombre Completo','C');
	$pdf->AddCol('nombre_departamento',40,'Departamento', 'C');
	$pdf->AddCol('descripcion',40,'Motivo', 'C');
	$pdf->AddCol('Solicitudes',28,'Solicitudes','R');
	$pdf->AddCol('Inasistencias',30,utf8_decode('Días Faltados'),'R');
	

	$pdf->Table($query1);
				
	$pdf->Output();

?>