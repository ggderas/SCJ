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
$query = mysql_query('SELECT * FROM sub_actividad WHERE ( (year(fecha_monitoreo)=year(now())) and (id_Encargado="'.$nroEmple.'") and id_sub_Actividad not in (select id_SubActividad from sub_actividades_realizadas where id_SubActividad=sub_actividad.id_sub_Actividad)) order by fecha_monitoreo asc', $enlace);

$pdf = new FPDF();

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
$pdf->Cell(115, 15, 'Usuario: '.$nroEmple, 0);
$pdf->ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->cell(5,8,'');
$pdf->Cell(70, 10, 'Sub Actividades No Realizadas',0);
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(20);
$pdf->cell(10,8,'');
$pdf->cell(20,8,'Codigo',1);
$pdf->cell(50,8,'Nombre',1);
$pdf->cell(40,8,'Fecha Monitoreo',1);
$pdf->cell(40,8,'Ponderacion',1);
$pdf->cell(20,8,'Costo',1);
$pdf->ln(10);
$contador =0;
$costotot=0;
while ($row = mysql_fetch_array($query)){
    $pdf->cell(10,8,'');
    $pdf->cell(20,8,$row['id_sub_Actividad']);
    $pdf->cell(50,8,$row['nombre']);
    $pdf->cell(40,8,$row['fecha_monitoreo']);
    $pdf->cell(40,8,$row['ponderacion']);
    $pdf->cell(20,8,$row['costo']);
    $pdf->ln(10);
     $costotot = $costotot+$row['costo'];
    $contador= $contador +1;
}
$pdf->ln(20);
$pdf->cell(10,8,'');
$pdf->cell(65,8,'Numero de Sub Actividades:  '.$contador);
$pdf->ln(10);$pdf->cell(10,8,'');
$pdf->cell(80,8,'Costo total de las Sub Actividades:  '.$costotot);
$pdf->SetFont('Arial', '', 10);
$pdf->Output('reporte.pdf','I');
$pdf->SetFont('Arial', '', 10);
$pdf->Output('reporte.pdf','I');

?>

