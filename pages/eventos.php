<?php



if(isset($_GET['contenido']))
  {
    $contenido = $_GET['contenido'];
  }
  else
  {
    $contenido = 'poa';
	$navbar_loc = 'contenido';
  }
//
//  require_once("../funciones/check_session.php");
//  
//  require_once("../funciones/timeout.php");

$fechaActual= date("Y-m-d");

//echo $fechaActual;
$link=mysql_connect("localhost", "root", "");
mysql_select_db("sistema_ciencias_juridicas",$link) OR DIE ("Error: No es posible establecer la conexión");
mysql_set_charset('utf8');
 //Select * from t1 where not exists (select 1 from t2 where t2.id = t1.id)
$eventos=mysql_query("SELECT * FROM actividades where not exists (select 1 from actividades_terminadas where actividades.id_actividad = actividades_terminadas.id_Actividad)",$link);
//echo "[";


//$totalSubActi=mysql_query("SELECT count(*) as totalSubActi  FROM sub_actividad where sub_actividad.idActividad=1",$link);
//
//$numSubActRea=mysql_query("SELECT count(*) as numSubActiRea FROM  sub_actividad where sub_actividad.id_sub_Actividad in (select sub_actividades_realizadas.id_SubActividad from sub_actividades_realizadas) and sub_actividad.idActividad=1",$link);
//
//$numSubActNORea=  mysql_query("SELECT count(*) as numSubActiNOReal  FROM sub_actividad where not exists (select 1 from sub_actividades_realizadas where sub_actividades_realizadas.id_SubActividad = sub_actividad.id_sub_Actividad) and sub_actividad.idActividad=1",$link);
//$total=mysql_fetch_assoc($totalSubActi);
//$no=mysql_fetch_assoc($numSubActNORea);
//$si=mysql_fetch_assoc($numSubActRea);
//echo $si['numSubActiRea'];

while($all = mysql_fetch_assoc($eventos)){
$e = array();
$e['id'] = $all['id_actividad'];
$e['start'] = $all['fecha_inicio'];
$e['end'] = $all['fecha_fin'];
$e['title'] = $all['descripcion'];
$fechaEntrada = $all['fecha_fin'];

$totalSubActi=mysql_query("SELECT count(*) as totalSubActi  FROM sub_actividad where sub_actividad.idActividad=".$all['id_actividad'],$link);

$numSubActRea=mysql_query("SELECT count(*) as numSubActiRea FROM  sub_actividad where sub_actividad.id_sub_Actividad in (select sub_actividades_realizadas.id_SubActividad from sub_actividades_realizadas) and sub_actividad.idActividad=".$all['id_actividad'],$link);

$numSubActNORea=  mysql_query("SELECT count(*) as numSubActiNOReal  FROM sub_actividad where not exists (select 1 from sub_actividades_realizadas where sub_actividades_realizadas.id_SubActividad = sub_actividad.id_sub_Actividad) and sub_actividad.idActividad=".$all['id_actividad'],$link);
$total=mysql_fetch_assoc($totalSubActi);
$no=mysql_fetch_assoc($numSubActNORea);
$si=mysql_fetch_assoc($numSubActRea);

$si['numSubActiRea'];
$no['numSubActiNOReal'];
$total['totalSubActi'];

if($total['totalSubActi']>0){
    
    
    if($fechaEntrada<$fechaActual){
  $e['color']='red';  
    
}else{
    $promedioRealizadas=(100/$total['totalSubActi'])*$si['numSubActiRea'];
    $prmedioNoRealizadas=(100/$total['totalSubActi'])*$no['numSubActiNOReal'];
    if($promedioRealizadas<50){
       $e['color']='red';  
    }
    if($promedioRealizadas<=70 && $promedioRealizadas>=50  ){
       $e['color']='yellow';  
    }
    if($promedioRealizadas>=95){
       $e['color']='blue';  
    }
    
}
    
    
    
}else{
    
    if($fechaEntrada<$fechaActual){
  $e['color']='red';  
    
}else{
    $e['color']='green'; 
    
}
    
    
}

//if($fechaEntrada<$fechaActual){
//  $e['color']='red';  
//    
//}else{
//    $e['color']='green'; 
//    
//}

//echo json_encode($e).",";
$result[] = $e;
}
//echo "]";
//echo json_encode(array('success' => 1, 'result' => $result));
echo json_encode($result)
 
?>

