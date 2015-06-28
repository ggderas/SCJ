
<?php

 $maindir = "../../";

require_once($maindir."fpdf/fpdf.php");
require($maindir."conexion/config.inc.php");
$conexion = mysqli_connect($host, $username, $password, $dbname);

$idPermiso = $_GET['id1'];

$query = mysqli_query($conexion, "Select permisos.estado from permisos where permisos.id_Permisos = '$idPermiso'");
$row = mysqli_fetch_array($query);
if($row['estado'] == 'Aprobado'){
	$query2 = mysqli_query($conexion, "update permisos set estado = 'Finalizado' where id_Permisos = '$idPermiso'") or die("Error " . mysqli_error($conexion));
}



$consulta="Select permisos.id_Permisos, permisos.No_Empleado,Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
			DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, 
			departamento_laboral.nombre_departamento, estado, edificios.descripcion from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
			inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
			inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento inner join edificios on
			edificios.Edificio_ID=permisos.id_Edificio_Registro where permisos.id_Permisos=:idPermisos";


	$query = $db->prepare($consulta);
    $query ->bindParam(":idPermisos",$idPermiso);
    $query->execute();
    $result = $query->fetch();
	
/*$consulta2="Update permisos set permisos.estado = 'Finalizado' where permisos.id_Permisos=:idPermisos";

	$query2 = $db->prepare($consulta2);
    $query2 ->bindParam(":idPermisos",$idPermiso);
    $query2->execute();*/


$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Arial', '', 18);
$pdf->Image($maindir.'assets/img/lucen-aspicio.png', 50,30,200,200, 'PNG');
$pdf->Image($maindir.'assets/img/logo_unah.png' , 10,5,18,30, 'PNG');
$pdf->Image($maindir.'assets/img/logo-cienciasjuridicas.png' , 170,8, 25 , 25,'PNG');
$pdf->Cell(22, 10, '', 0);
$pdf->SetFont('Arial', '', 18);
$pdf->Cell(5, 10, '', 0);
$pdf->Cell(70, 10, utf8_decode('Universidad Nacional Autónoma de Honduras'), 0);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'U', 14);
$pdf->Cell(25, 8, '', 0,0,"C");
$pdf->Cell(130, 8, ' Control de Permisos Personales', 0,0,"C");
$pdf->Rect(6, 37, 200, 95 ,'D');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(10);
$nombreCompleto = "{$result['Primer_nombre']} {$result['Segundo_nombre']} {$result['Primer_apellido']} {$result['Segundo_Apellido']}";
$pdf->Cell(100, 15, 'Nombre: '.$nombreCompleto, 0,0,"");
$pdf->Cell(40, 15, 'No.De Empleado: '.$result['No_Empleado'], 0,0,"");
$pdf->Ln(7);
$pdf->Cell(150, 15, utf8_decode('Unidad Académica: ').$result['nombre_departamento'], 0);
$pdf->Ln(7);
$pdf->Cell(140, 15, 'Solicitud de permiso por motivo de: '.$result['mtd'], 0,0,"");
$pdf->Ln(7);
$pdf->Cell(140, 15, 'Edificio de Registro de Asistencia: '.$result['descripcion'], 0,0,"");
$pdf->Ln(7);
$pdf->Cell(125, 15, utf8_decode('Duración en dias: ').$result['dias_permiso'], 0,0,"");
$pdf->Ln(7);

$pdf->Cell(40, 15, 'Fecha: '.$result['fecha'], 0,0,"");
$pdf->Cell(10, 10, '', 0);
$pdf->Cell(40, 15, 'Hola Inicio: '.$result['hora_inicio'], 0,0,"");
$pdf->Cell(10, 10, '', 0);
$pdf->Cell(40, 15, utf8_decode('Hora Finalización: ') .$result['hora_finalizacion'], 0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Ln(22);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(75, 8, '_______________________________', 0,0,"C");
$pdf->Cell(135, 8, '_______________________________', 0,0,"C");
$pdf->Ln(7);
$pdf->Cell(80, 8, 'Firma del Solicitante', 0,0,"C");
$pdf->Cell(125, 8, 'V.B del Jefe Inmediato  ', 0,0,"C");
$pdf->Ln(15);
$pdf->Cell(180, 8, '____________________________________', 0,0,"C");
$pdf->Ln(7);
$pdf->Cell(180, 8, utf8_decode('Sección de Efectividad y Control'), 0,0,"C");
$pdf->Ln(5);
$pdf->Cell(180, 8, 'del Recurso Humano', 0,0,"C");
$pdf->Ln(35);
$pdf->Line(20,45,500,45);

$pdf->Image($maindir.'assets/img/logo_unah.png' , 10,150,18,30, 'PNG');
$pdf->Image($maindir.'assets/img/logo-cienciasjuridicas.png' , 170,150, 25 , 25,'PNG');
$pdf->Cell(22, 10, '', 0);
$pdf->SetFont('Arial', '', 18);
$pdf->Cell(5, 10, '', 0);
$pdf->Cell(70, 10, utf8_decode('Universidad Nacional Autónoma de Honduras'), 0);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'U', 14);
$pdf->Cell(30, 8, '', 0,0,"C");
$pdf->Cell(130, 8, ' Control de Permisos Personales', 0,0,"C");
$pdf->Rect(6, 184, 200, 100 ,'D');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(10);
$nombreCompleto = "{$result['Primer_nombre']} {$result['Segundo_nombre']} {$result['Primer_apellido']} {$result['Segundo_Apellido']}";
$pdf->Cell(100, 15, 'Nombre: '.$nombreCompleto, 0,0,"");
$pdf->Cell(40, 15, 'No.De Empleado: '.$result['No_Empleado'], 0,0,"");
$pdf->Ln(7);
$pdf->Cell(150, 15, utf8_decode('Unidad Académica: ') .$result['nombre_departamento'], 0);
$pdf->Ln(7);
$pdf->Cell(140, 15, 'Solicitud de permiso por motivo de: '.$result['mtd'], 0,0,"");
$pdf->Ln(7);
$pdf->Cell(125, 15, utf8_decode('Duración en dias: ').$result['dias_permiso'], 0,0,"");
$pdf->Ln(7);

$pdf->Cell(40, 15, 'Fecha: '.$result['fecha'], 0,0,"");
$pdf->Cell(10, 10, '', 0);
$pdf->Cell(40, 15, 'Hola Inicio: '.$result['hora_inicio'], 0,0,"");
$pdf->Cell(10, 10, '', 0);
$pdf->Cell(40, 15, utf8_decode('Hora Finalización: ').$result['hora_finalizacion'], 0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Ln(20);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(75, 8, '_______________________________', 0,0,"C");
$pdf->Cell(135, 8, '_______________________________', 0,0,"C");
$pdf->Ln(7);
$pdf->Cell(80, 8, 'Firma del Solicitante', 0,0,"C");
$pdf->Cell(125, 8, 'V.B del Jefe Inmediato  ', 0,0,"C");
$pdf->Ln(15);
$pdf->Cell(180, 8, '____________________________________', 0,0,"C");
$pdf->Ln(7);
$pdf->Cell(180, 8, utf8_decode('Sección de Efectividad y Control'), 0,0,"C");
$pdf->Ln(5);
$pdf->Cell(180, 8, 'del Recurso Humano', 0,0,"C");
$pdf->Ln(15);


$pdf->Output('reporte.pdf','I');

?>