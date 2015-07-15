<?php



$maindir = '../../../';
include $maindir . 'fpdf/fpdf.php';
include $maindir . 'Datos/conexion.php';
include($maindir . "conexion/config.inc.php");

$identi = NULL;
$pfecha = NULL;
$tipoSolicitud = NULL;

if(isset($_SESSION["N_IDENTIDAD"]))
{
    $identi = $_SESSION["N_IDENTIDAD"];
}

if(isset($_SESSION["FECHA"]))
{
    $pfecha = $_SESSION["FECHA"];
}

if(isset($_SESSION["TIPO_SOLICITUD"]))
{
    $tipoSolicitud = $_SESSION["TIPO_SOLICITUD"];
}


            
$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Arial', '', 18);
$pdf->Image($maindir.'assets/img/lucen-aspicio.png', 50,30,200,200, 'PNG');
$pdf->Image($maindir.'assets/img/logo_unah.png' , 10,5,20,35, 'PNG');
$pdf->Image($maindir.'assets/img/logo-cienciasjuridicas.png' , 170,8, 35 , 35,'PNG');
$pdf->Cell(18, 10, '', 0);
$pdf->SetFont('Arial', '', 18);
$pdf->Cell(5, 10, '', 0);
$pdf->Cell(70, 10, 'Universidad Nacional Autonoma de Honduras', 0);
$pdf->Ln(25);
$pdf->SetFont('Arial', 'U', 14);
$pdf->Cell(30, 8, ' ', 0,0,"C");
$pdf->Cell(130, 8, ' Reporte de solicitudes', 0,0,"C");
$pdf->Rect(2, 55, 206, 200 ,'D');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(10);
$pdf->Cell(115, 15, 'Fecha: '.date('Y-m-d'), 0);
$pdf->Ln(7);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);

$pdf->Cell(30, 8, 'Numero de Identidad', 0);
$pdf->Cell(40, 8, 'Nombre', 0);
$pdf->Cell(30, 8, 'Numero de cuenta', 0);
$pdf->Cell(25, 8, 'Indice academico', 0);
$pdf->Cell(25, 8, 'Nivel educativo', 0);
$pdf->Cell(30, 8, 'Solicitud realizada', 0);
$pdf->Cell(30, 8, 'Fecha', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);

if($identi == NULL)
{
    $identi = 'NULL';
}
else
{
    $identi = "'" . $identi . "'";
}

if($pfecha == NULL)
{
    $pfecha = 'NULL';
}
else
{
    $pfecha = "'" . $pfecha . "'";
}                    

if($tipoSolicitud == NULL)
{
    $tipoSolicitud = 'NULL';
}                     

$query = 'CALL SP_BUSQUEDA_SECRETARIA('
         . $identi . ","
         . $pfecha . ","
         . $tipoSolicitud . ", @mensajeError)";

$result = mysql_query($query);

$json = array();
$contadorIteracion = 0;


while ($fila = mysql_fetch_array($result)) 
{
    $pdf->Cell(30, 8, $fila["NUMERO_IDENTIDAD"], 0);
    $pdf->Cell(40, 8, $fila["NOMBRE"], 0);
    $pdf->Cell(30, 8, $fila["NUMERO_CUENTA"], 0);
    $pdf->Cell(25, 8, $fila["INDICE_ACADEMICO"], 0);
    $pdf->Cell(25, 8, $fila["DESCRIPCION_TIPO_ESTUDIANTE"], 0);
    $pdf->Cell(30, 8, $fila["NOMBRE_TIPO_SOLICITUD"], 0);
    $pdf->Cell(30, 8, $fila["FECHA_SOLICITUD"], 0);

    $pdf->Ln(5);   
    
    //$pdf->Cell($w, $h, $txt, $border)
}

$pdf->SetFont('Arial', '', 10);


$pdf->Output();   