<?php

 $maindir = "../../";

require_once($maindir."fpdf/fpdf.php");
require($maindir."conexion/config.inc.php");

$sql = "SELECT * FROM ( SELECT folios.NroFolio, folios.PersonaReferente, unidad_academica.NombreUnidadAcademica AS ENTIDAD, 
                         DATE(folios.FechaEntrada) as FechaEntrada, folios.FechaEntrada as Fecha, folios.TipoFolio FROM folios INNER JOIN unidad_academica ON folios.UnidadAcademica = unidad_academica.Id_UnidadAcademica 
                         UNION SELECT folios.NroFolio, folios.PersonaReferente, organizacion.NombreOrganizacion AS ENTIDAD, 
                         DATE(folios.FechaEntrada) as FechaEntrada, folios.FechaEntrada as Fecha ,folios.TipoFolio FROM folios INNER JOIN organizacion ON folios.Organizacion = organizacion.Id_Organizacion where DATE(folios.FechaEntrada)=CURDATE()) T1 
                        ORDER BY `T1`.`Fecha` DESC";

    $query = $db->prepare($sql);
	//$query ->bindParam(":Id_Seguimiento",$Id_Seguimiento);
    $query->execute();
    $rows = $query->fetchAll();

$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Arial', '', 18);
$pdf->Image($maindir.'assets/img/lucen-aspicio.png', 50,30,200,200, 'PNG');
$pdf->Image($maindir.'assets/img/logo_unah.png' , 10,5,20,35, 'PNG');
$pdf->Image($maindir.'assets/img/logo-cienciasjuridicas.png' , 170,8, 35 , 35,'PNG');
$pdf->Cell(18, 10, '', 0);
$pdf->SetFont('Arial', '', 18);
$pdf->Cell(5, 10, '', 0);
$pdf->Cell(70, 10, 'Universidad Nacional Autónoma de Honduras', 0);
$pdf->Ln(25);
$pdf->SetFont('Arial', 'U', 14);
$pdf->Cell(30, 8, ' ', 0,0,"C");
$pdf->Cell(130, 8, ' Reporte de Folios Diarios', 0,0,"C");
$pdf->Rect(6, 45, 200, 200 ,'D');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(10);
$pdf->Cell(115, 15, 'Fecha: '.date('Y-m-d'), 0);
$pdf->Ln(7);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(30, 8, 'No. de Folio', 0);
$pdf->Cell(40, 8, 'Persona Referente', 0);
$pdf->Cell(50, 8, 'Unidad académica u Organización', 0);
$pdf->Cell(40, 8, 'Fecha de Entrada', 0);
$pdf->Cell(40, 8, 'Tipo de Folio', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);
foreach( $rows as $row ){
	if($row['TipoFolio'] == 0){
	$tipo = "Folio de entrada";
    }elseif($row['TipoFolio'] == 1){
		$tipo = "Folio de salida";
  	}
		$pdf->Cell(30, 8, $row["NroFolio"], 0);
		$pdf->Cell(40, 8, $row["PersonaReferente"], 0);
		$pdf->Cell(50, 8, $row["ENTIDAD"], 0);
		$pdf->Cell(40, 8, $row["FechaEntrada"], 0);
		$pdf->Cell(40, 8, $tipo, 0);
		
		$pdf->Ln(5);
	}
;



$pdf->SetFont('Arial', '', 10);


$pdf->Output('reporte.pdf','I');

?>