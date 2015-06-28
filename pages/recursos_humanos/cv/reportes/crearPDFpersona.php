<?php

 $maindir = "../../../../";
require_once('../../../../Datos/conexion.php');
require_once($maindir."fpdf/fpdf.php");
require($maindir."conexion/config.inc.php");

$id = $_GET['iden'];

//Datos generales e info de contacto
$resultado=mysql_query("SELECT * FROM persona WHERE N_identidad = '".$id."'");

//Experiencia Académica
$resultado2=mysql_query("SELECT experiencia_academica.ID_Experiencia_academica, Institucion, Tiempo,Clase FROM experiencia_academica inner join clases_has_experiencia_academica on clases_has_experiencia_academica.ID_Experiencia_academica=experiencia_academica.ID_Experiencia_academica inner join clases on clases.ID_Clases=clases_has_experiencia_academica.ID_Clases WHERE N_identidad='".$id."'");

//Formación académica
$resultado3=mysql_query("SELECT ID_Estudios_academico, Nombre_titulo, ID_Tipo_estudio, Id_universidad FROM estudios_academico WHERE N_identidad= '".$id."'");

//Experiencia laboral
$resultado4 = mysql_query("SELECT experiencia_laboral.ID_Experiencia_laboral, Nombre_empresa, Tiempo, cargo FROM experiencia_laboral inner join experiencia_laboral_has_cargo on experiencia_laboral_has_cargo.ID_Experiencia_laboral=experiencia_laboral.ID_Experiencia_laboral inner join cargo on cargo.ID_cargo=experiencia_laboral_has_cargo.ID_cargo WHERE experiencia_laboral.N_identidad='".$id."'");
//telefono
$resultado5 = mysql_query("SELECT Tipo, Numero FROM telefono WHERE N_identidad= '".$id."'");


class PDF extends FPDF
  {
     // Cabecera de página
     function Header()
         {

 $this->Image('../../../../assets/img/lucen-aspicio.png', 50,30,200,200, 'PNG');
$this->Image('../../../../assets/img/logo_unah.png' , 10,5,20,35, 'PNG');
$this->Image('../../../../assets/img/logo-cienciasjuridicas.png' , 170,8, 35 , 35,'PNG');
$this->Cell(18, 10, '', 0);
$this->SetFont('Arial', '', 18);
$this->Cell(5, 10, '', 0);
$this->Cell(140, 10,utf8_decode('Universidad Nacional Autónoma de Honduras'), 0,0,"C");
$this->Ln(25);
$this->SetFont('Arial', 'U', 14);
$this->Cell(30, 8, ' ', 0,0,"C");
$this->Cell(130, 8, ' Perfil de la Persona', 0,0,"C");
$this->Rect(6, 45, 200, 240 ,'D');
$this->SetFont('Arial', '', 12);
$this->Ln(10);

$this->Ln(10);


         }
         
          function Footer()
         {
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
          
           $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().' de {nb}   - - - -   Impreso el ' . date('d-m-y') . ' fecha del servidor',0,0,'C');
         }
         
 
  }




$pdf = new PDF();
$pdf->SetFont('Arial', '', 12);

$pdf->AliasNbPages();
$pdf->AddPage();


if($row = mysql_fetch_array($resultado) or die("Error en: " . mysql_error())){
      $id = $row['N_identidad'];
        $pNombre = $row['Primer_nombre'];
        $sNombre = $row['Segundo_nombre'];
        $pApellido = $row['Primer_apellido'];
        $sApellido = $row['Segundo_apellido'];
        $fNac = $row['Fecha_nacimiento'];
        $sexo = $row['Sexo'];
        $direc = $row['Direccion'];
        $email = $row['Correo_electronico'];
        $estCivil = $row['Estado_Civil'];
        $nacionalidad = $row['Nacionalidad'];
        $nombreC =$pNombre." ".$sNombre." ".$pApellido." ".$sApellido;
$pdf->Cell(190, 8, 'DATOS GENERALES', 0,0,"C");
$pdf->Ln(10);


$pdf->Cell(125, 8, 'Numero de Identidad: '.$row['N_identidad'], 0);
$pdf->Ln(5);
$pdf->Cell(120, 10, utf8_decode('Nombre Completo: '.$nombreC), 0);
$pdf->Ln(5);
$pdf->Cell(120, 10, 'Sexo: '.$sexo, 0);
$pdf->Ln(5);
$pdf->Cell(120, 10,utf8_decode('Nacionalidad: '.$nacionalidad), 0);
$pdf->Ln(5);
$pdf->Cell(120, 10, 'Fecha de nacimiento: '.$fNac, 0);
$pdf->Ln(5);
$pdf->Cell(120, 8, 'Estado Civil: '.$estCivil, 0);
$pdf->Ln(15);
$pdf->Cell(190, 9,utf8_decode('INFORMACIÓN DE CONTACTO'),0,0,'C');
$pdf->Ln(10);

$pdf->Cell(125, 8, utf8_decode('Direccion: '.$direc), 0);
$pdf->Ln(5);
$pdf->Cell(125, 8, 'Correo Electronico: '.$email, 0);
$pdf->Ln(5);
$pdf->Cell(125, 8, 'Numeros telefonicos: ', 0);
$pdf->Ln(5);
$pdf->Cell(30, 8, 'Tipo', 0);
$pdf->Cell(40, 8, 'Numero', 0);
$pdf->Ln(8);

while ($row8 = mysql_fetch_array($resultado5)){
    
    $pdf->Cell(30, 8, $row8["Tipo"], 0);
    $pdf->Cell(40, 8, $row8["Numero"], 0);
    $pdf->Ln(5);
    
}

$pdf->Ln(15);
//--------


$pdf->Cell(190, 9,utf8_decode('FORMACIÓN ACADEMICA'), 0,0,'C');
 while ($row2 = mysql_fetch_array($resultado3)){
            $id7 = $row2['ID_Estudios_academico'];
            $titulo = $row2['Nombre_titulo'];
            $s = mysql_query("SELECT Tipo_estudio FROM tipo_estudio WHERE ID_Tipo_estudio = '".$row2['ID_Tipo_estudio']."'");
            $row3 = mysql_fetch_array($s);
            $tipoEs = $row3['Tipo_estudio'];
            $t = mysql_query("SELECT nombre_universidad FROM universidad WHERE Id_universidad = '".$row2['Id_universidad']."'");
            $row4 = mysql_fetch_array($t);
            $univ = $row4['nombre_universidad'];
 
 
 $pdf->Ln(10);
 $pdf->Cell(125, 8, 'Nombre del titulo: '.$titulo, 0);
$pdf->Ln(5);
 $pdf->Cell(125, 8, 'Tipo de Estudio: '.$tipoEs, 0);
$pdf->Ln(5);
$pdf->Cell(125, 8, 'Universidad: '.$univ, 0);
$pdf->Ln(15);
 }
 $pdf->Ln(15);

 $pdf->Cell(190, 9, 'EXPERIENCIA LABORAL', 0,0,'C');
while ($row11 = mysql_fetch_array($resultado4)){
            $id9 = $row11['ID_Experiencia_laboral'];
            $nomEmp = $row11['Nombre_empresa'];
            $tiempo = $row11['Tiempo'];
            $cargo  = $row11['cargo'];


$pdf->Ln(10);
 $pdf->Cell(125, 8, utf8_decode('Nombre de la Empresa: ').$nomEmp, 0);
$pdf->Ln(5);
$pdf->Cell(125, 8, 'Tiempo (En meses): '.$tiempo, 0);
$pdf->Ln(5);
$pdf->Cell(125, 8, utf8_decode('Cargo ejercido: '.$cargo), 0);

$pdf->Ln(15);
}  

$pdf->Ln(15);



$pdf->Cell(190, 9, 'EXPERIENCIA ACADEMICA', 0,0,"C");
while ($row5 = mysql_fetch_array($resultado2)) {
            $id1 = $row5['ID_Experiencia_academica'];
            $inst = $row5['Institucion'];
            $tiempo = $row5['Tiempo'];
            $clase = $row5['Clase'];

$pdf->Ln(10);
 $pdf->Cell(125, 8, 'Nombre de la Empresa: '.$inst, 0);
$pdf->Ln(5);
 $pdf->Cell(125, 8, 'Tiempo (En meses): '.$tiempo, 0);
 $pdf->Ln(5);
 $pdf->Cell(125, 8, 'Clases impartida: '.$clase, 0);
$pdf->Ln(15);

}

  
 
/*$pdf->Cell(135, 8, 'Asunto: '.$result['DescripcionAsunto'], 0);
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
 
}*/
}
$pdf->Output('reporte.pdf','I');
?>

