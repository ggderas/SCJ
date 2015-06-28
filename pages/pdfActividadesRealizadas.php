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
    $this->Cell(30,5,'Actividades Realizadas',0,0,'C');
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
    foreach($header as $col){$this->Cell(40,7,$col,1);}
    include '../Datos/conexion.php';
    $query = mysql_query("call sp_lee_actividades_terminadas_poa()", $enlace);
    while ($row = mysql_fetch_array($query)) {
      $this->Ln();
      $this->Cell(40,5,$row['Descripcion'],1);
      $this->Cell(40,5,$row['Fecha_Inicio'],1);
      $this->Cell(40,5,$row['Fecha_Fin'],1);
      $this->Cell(40,5,$row['fecha'],1);

    }
      
      
   }
   
   
}

$pdf=new PDF();
//Títulos de las columnas
$header=array('Actividad','Inicio','Fin','Realizada');
$pdf->AliasNbPages();
//Primera página
$pdf->AddPage();
$pdf->SetY(25);
$pdf->TablaSimple($header);

$pdf->Output();
?>
