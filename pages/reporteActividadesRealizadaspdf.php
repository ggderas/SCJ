<?php

 $maindir = "../../";

include '../Datos/conexion.php';
require('../fpdf/fpdf.php');

$nroEmple = $_GET['a'];
$consulta="";


	//$query = $db->prepare($consulta);
   // $query ->bindParam(":idPermisos",$idPermiso);
   // $query->execute();
    //$result = $query->fetch();
$query = mysql_query('select distinct actividades.id_actividad, actividades_terminadas.fecha, grupo_o_comite.Nombre_Grupo_o_comite as comite, actividades.descripcion
from actividades
inner join actividades_terminadas on actividades.id_actividad = actividades_terminadas.id_Actividad
inner join responsables_por_actividad on responsables_por_actividad.id_Actividad = actividades_terminadas.id_Actividad
inner join grupo_o_comite on grupo_o_comite.ID_Grupo_o_comite = responsables_por_actividad.id_Responsable
inner join grupo_o_comite_has_empleado on grupo_o_comite_has_empleado.No_Empleado="'.$nroEmple.'"', $enlace);

$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 18);
$pdf->Image('../fpdf/lucen-aspicio.png', 50,30,200,200, 'PNG');
$pdf->Image('../fpdf/logo_unah.png' , 10,5,20,35, 'PNG');
$pdf->Image('../fpdf/logo-cienciasjuridicas.png' , 170,8, 35 , 35,'PNG');
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
$pdf->Cell(125, 8, 'Plan operativo Anual', 0,0,"C");
//$pdf->Rect(6, 45, 200, 230 ,'D');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(10);
$pdf->cell(5,8,'');
$pdf->ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->cell(5,8,'');
$pdf->Cell(70, 10, ' Actividades Realizadas',0);
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(20);
$pdf->cell(10,8,'');
$pdf->cell(20,8,'Codigo',1);
$pdf->cell(50,8,'Fecha',1);
$pdf->cell(40,8,'Comite',1);
$pdf->cell(60,8,'Descripcion',1);
$pdf->ln(10);
$contador =0;
$costotot=0;
while ($row = mysql_fetch_array($query)){
    $pdf->cell(10,8,'');
    $pdf->cell(20,8,$row['id_actividad']);
    $pdf->cell(50,8,$row['fecha']);
    $pdf->cell(40,8,$row['comite']);
    $pdf->cell(60,8,$row['descripcion']);
   
    $pdf->ln(10);
    $contador= $contador +1;
}
$pdf->ln(20);
$pdf->cell(10,8,'');
$pdf->cell(80,8,'Numero de Actividades:  '.$contador);
$pdf->ln(10);$pdf->cell(10,8,'');

function Footer()
   {
    //Posición: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
   }
$pdf->Output('reporte.pdf','I');

?>


