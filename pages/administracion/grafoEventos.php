<div class="chart" id="line-chart" style="height: 300px;"></div>

<?php
 
    require_once($maindir."conexion/config.inc.php");
  
  try{
     $query = $db->prepare("SELECT YEAR(fecha_log) as year, MONTH(fecha_log) as month,DAY(fecha_log) as day,COUNT(DAY(fecha_log)) as count_ 
                             FROM (SELECT fecha_log FROM `usuario_log` 
							     WHERE fecha_log > now() - interval 1 month) as t1 GROUP BY DAY(fecha_log)");
     $query->execute();
     $result1_log_stats = $query->fetchAll();

     $query =null;
     if(!isset($estaEnPrincipal)){
	    $db = null;
     }
  }catch(PDOExecption $e){
	 //error;
  }
  
  if($result1_log_stats){
    
  }else{
    die();
  }
?>

<script>
$(document).ready(function() {
    
  function changeDateFormat(mydate)
  {
    var dateDMY = new Date(mydate);
    var monthNames = [ "Ene", "Feb", "Mar", "Abr", "May", "Jun",
    "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ]; 
    var date =  dateDMY.getDate();
    var month = monthNames[dateDMY.getMonth()];
    var year = dateDMY.getFullYear();
    var mydate = "";
    var seperator = "-";
    mydate = mydate.concat(date,seperator,month,seperator,year);
    return mydate;
  }

      $(function () {
        "use strict";

		
		
        // LINE CHART
        var line = new Morris.Line({
          element: 'line-chart',
          resize: true,
          data: [
		    <?php 
			   $numItems = count($result1_log_stats);
			   $i = 0;
			   foreach( $result1_log_stats as $row ){ 
			     $x = $row['year']."-".$row['month']."-".$row['day'];
				 $y = $row['count_'];
			     echo "{Mes: '".$x."', Usuarios: ".$y."}";
				 if(++$i != $numItems) {
                    echo ",";
                 }	
			   }
			?>
          ],
          xkey: 'Mes',
          ykeys: ['Usuarios'],
          labels: ['Usuarios'],
          lineColors: ['#3c8dbc'],
		  xLabelFormat : function (x) {
            return changeDateFormat(x);
          },
          hideHover: 'auto'
        });
      });
});
</script>
	  