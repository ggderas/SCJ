<?php
require('fpdf/fpdf.php');
include '../../../Datos/conexion.php';


class PDF extends FPDF
{

}




// Creación del objeto de la clase heredada
$pdf = new PDF();

$pdf->AddPage();
$pdf->SetFont('Arial', '', 18);
$pdf->Image('fpdf/lucen-aspicio.png', 50,30,200,200, 'PNG');
$pdf->Image('fpdf/logo_unah.png' , 10,5,20,35, 'PNG');
//$pdf->Image('fpdf/logo-cienciasjuridicas.png' , 170,8, 35 , 35,'PNG');
$pdf->Cell(18, 10, '', 0);
$pdf->SetFont('Arial', '', 18);
$pdf->Cell(5, 10, '', 0);
$pdf->Cell(70, 10, 'Universidad Nacional Autonoma de Honduras', 0);
$pdf->Ln(8);
$pdf->Cell(18, 10, '', 0);
$pdf->SetFont('Arial', '', 16);
$pdf->Cell(35, 10, '', 0);
$pdf->Cell(70, 10, 'Facultad de ciencias Juridicas', 0);
$pdf->Ln(13);
$pdf->SetFont('Arial', 'U', 14);
$pdf->Cell(30, 8, ' ', 0,0,"C");
$pdf->Cell(125, 8, 'Constancia de Egresado', 0,0,"C");
//$pdf->Rect(6, 45, 200, 230 ,'D');
$pdf->SetFont('Arial', '', 12);

$pdf->Ln(15);
$pdf -> Cell(0,8,'El Suscrito Secretario de la Facultad de Ciencias Juridicas de la Universidad Nacional Autonoma  ',0,1,false);
$pdf -> Cell(75,8,'de Honduras por medio de la presente',0,0,false);
$pdf ->	SetFont('Arial','B',12);
$pdf -> Cell(35,8,'HACE CONSTAR',0,0,' ',false);
$pdf -> SetFont('Arial','',12); 
$pdf -> Cell(0,8,'Que se ha revisado exhaustivamente ',0,1,' ',false);
$pdf -> Cell(65,8,'el Expediente de Graduación de',0,0,'',false);
$pdf -> Cell(0,8,'con numero de cuenta y numero de tarjeta de identidad y se ha',0,1,'',false); //$row['id_sub_Actividad']
$pdf -> Cell(115,8,'determinado que curso y aprobo todas las materias y las',0,0,'',false);
$pdf -> SetFont('Arial','B',12);
$pdf -> Cell(10,8,'261',0,0,'',false);
$pdf -> SetFont('Arial','',12); 
$pdf -> Cell(0,8,'Unidades Valorativas establecidas',0,1,'',false); //$row['id_sub_Actividad']


$pdf -> Cell(115,8,'en el Plan de Estudios de la Carrera de durante los años ',0,0,'',false); //$row['id_sub_Actividad']
$pdf -> SetFont('Arial','',12); 
$pdf -> Cell(20,8,'Años ',0,0,'',false); //$row['id_sub_Actividad']

$pdf -> Cell(0,8,'segun cuenta en la Certificacion',0,1,'',false); //$row['id_sub_Actividad']
$pdf -> Cell(0,8,'de Estudios expedida por la Direccion de  Ingreso, Permanencia y Promocion de esta Universidad ',0,1,'',false);

$pdf->Ln(3);
$pdf -> Cell(0,8,'En fe de lo cual firma la presente en la Ciudad Universitaria, Tegucigalpa.',0,1,'',false);
$pdf -> Cell(0,8,'Municipio del Distrito Central a los dos dias del mes de febrero de dos mil quince.',0,1,'',false);
$pdf->Output('Constancia de Egresado.pdf','I');
?>

