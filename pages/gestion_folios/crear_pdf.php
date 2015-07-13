<?php

 $maindir = "../../";

require_once($maindir."fpdf/fpdf.php");
require($maindir."conexion/config.inc.php");

$idFolio = $_GET['id1'];

$query = $db->prepare("SELECT folios.NroFolio, folios.PersonaReferente, folios.UnidadAcademica, unidad_academica.NombreUnidadAcademica, folios.Organizacion, 
	    organizacion.NombreOrganizacion, folios.TipoFolio,DATE(folios.FechaEntrada) as FechaEntrada, folios.FechaCreacion, folios.UbicacionFisica, 
		ubicacion_archivofisico.DescripcionUbicacionFisica ,folios.Prioridad  ,prioridad.DescripcionPrioridad, folios.DescripcionAsunto 
    	FROM folios INNER JOIN ubicacion_archivofisico ON folios.UbicacionFisica = ubicacion_archivofisico.Id_UbicacionArchivoFisico 
    	INNER JOIN prioridad ON folios.Prioridad = prioridad.Id_Prioridad 
    	LEFT JOIN unidad_academica ON folios.UnidadAcademica = unidad_academica.Id_UnidadAcademica 
    	LEFT JOIN organizacion ON folios.Organizacion = organizacion.Id_Organizacion 
    	WHERE NroFolio = :NroFolio");
    $query ->bindParam(":NroFolio",$idFolio);
    $query->execute();
    $result = $query->fetch();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 18);
$pdf->Image($maindir.'assets/img/lucen-aspicio.png', 50,30,200,200, 'PNG');
$pdf->Image($maindir.'assets/img/logo_unah.png' , 10,5,20,35, 'PNG');
$pdf->Image($maindir.'assets/img/logo-cienciasjuridicas.png' , 170,8, 35 , 35,'PNG');
$pdf->Cell(18, 10, '', 0);
$pdf->Cell(120, 10, '			Reporte de Seguimientos del Folio', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 10, 'Hoy: '.date('Y-m-d').'', 0);
$pdf->Ln(10);
$pdf->Cell(115, 8, '                            Folio: '.$idFolio, 0);
$pdf->Ln(5);
if($result['TipoFolio'] == 0){
	$tipo = "Folio de entrada";
    }elseif($result['TipoFolio'] == 1){
		$tipo = "Folio de salida";
  	}
$pdf->Cell(120, 8, '                            Tipo de Folio: '.$tipo, 0);
$pdf->Ln(5);
$pdf->Cell(125, 8, '                            Descripcion: '.$result['DescripcionPrioridad'], 0);
$pdf->Ln(5);
$pdf->Cell(130, 8, '                            Fecha de Entrada: '.$result['FechaEntrada'], 0);
$pdf->Ln(5);
$pdf->Cell(135, 8, '                            Asunto: '.$result['DescripcionAsunto'], 0);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(150, 8, 'SEGUIMIENTO DEL FOLIO', 0);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(15, 8, 'Id', 0);
$pdf->Cell(70, 8, 'Estado del Seguimiento', 0);
$pdf->Cell(40, 8, 'Fecha', 0);
$pdf->Cell(25, 8, 'Hora', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);
//CONSULTA
$query = null;
$db = null;
require($maindir."conexion/config.inc.php");
$query = $db->prepare("SELECT * FROM seguimiento WHERE NroFolio = :NroFolio");
	$query ->bindParam(":NroFolio",$idFolio);
    $query->execute();
    $result11 = $query->fetch();
        if($result11){
            $seguimiento = 1;
        }else{
            $seguimiento = 0;
        }
	
	if($seguimiento == 1){
	$Id_Seguimiento = $result11['Id_Seguimiento'];
	$sql = "SELECT seguimiento_historico.Id_SeguimientoHistorico, seguimiento_historico.Id_Seguimiento, estado_seguimiento.DescripcionEstadoSeguimiento, 
	        seguimiento_historico.FechaCambio, seguimiento_historico.Notas, prioridad.DescripcionPrioridad FROM seguimiento_historico 
			INNER JOIN estado_seguimiento ON seguimiento_historico.Id_Estado_Seguimiento = estado_seguimiento.Id_Estado_Seguimiento 
			INNER JOIN prioridad ON seguimiento_historico.Prioridad = prioridad.Id_Prioridad WHERE Id_Seguimiento = :Id_Seguimiento 
			ORDER BY FechaCambio DESC";

    $query = $db->prepare($sql);
	$query ->bindParam(":Id_Seguimiento",$Id_Seguimiento);
    $query->execute();
    $rows = $query->fetchAll();
	}
if($seguimiento == 1){
	foreach( $rows as $row ){
		$pdf->Cell(15, 8, $row["Id_SeguimientoHistorico"], 0);
		$pdf->Cell(70, 8, $row["DescripcionEstadoSeguimiento"], 0);
		$date = date_create($row["FechaCambio"]);
		date_format($date, 'Y-m-d H:i:s');
		$pdf->Cell(40, 8, date_format($date, 'd/m/y'), 0);
		$pdf->Cell(25, 8, date_format($date, 'g:i A'), 0);
		$pdf->Ln(5);
	}
}	
$pdf->Output('reporte.pdf','I');
?>