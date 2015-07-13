<?php
require('../fpdf/fpdf.php');






class PDF extends FPDF
{
//Cabecera de página
   function Header()
   {
    
    $this->SetFont('Arial','B',15);
    //Movernos a la derecha
    $this->Cell(15);
    //Título
    $this->Cell(30,45,'Actividades NO Realizadas',0,0,'C');
    //Salto de línea

      
   }
   
   //Pie de página
   function Footer()
   {
    //Posición: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
   }
   //Tabla simple
   function TablaSimple($header)
   {
    //Cabecera
    foreach($header as $col){$this->Cell(40,9,$col,1);}
    include '../Datos/conexion.php';
    $query = mysql_query("call sp_lee_actividades_no_terminadas_poa()", $enlace);
    while ($row = mysql_fetch_array($query)) {
      $this->Ln();
      $this->Cell(40,5,$row['descripcion'],1);
      $this->Cell(40,5,$row['fecha_inicio'],1);
      $this->Cell(40,5,$row['fecha_fin'],1);


    }
      
      
   }
   
   
}

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Image('../assets/img/logo-cienciasjuridicas.png' , 10 ,8, 20 , 20,'PNG');
$pdf->Cell(18, 10, '', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 10, 'Hoy: '.date('d-m-Y').'', 0);
$pdf->Ln(20);
$pdf->Ln(5);
$header=array('Actividad','Inicio','Fin');
$pdf->AliasNbPages();

$pdf->TablaSimple($header);

$pdf->Output();
?>
