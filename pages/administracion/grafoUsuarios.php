<div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>

<?php

    if(!isset($maindir)){
	    $maindir = "../../";
	}

    require_once($maindir."conexion/config.inc.php");
    try{
        $query2 = $db->prepare("SELECT Estado,COUNT(Estado) as cuenta FROM usuario GROUP BY Estado");
        $query2->execute();
        $result3_estadi_users = $query2->fetchAll();

	    $query2 =null;
	    if(!isset($estaEnPrincipal)){
	        $db = null;
	    }
	}catch(PDOExecption $e){
	 //error;
		}
?>

<script>
$(function () {
	//DONUT CHART
        var donut = new Morris.Donut({
          element: 'sales-chart',
          resize: true,
          colors: ["#3c8dbc", "#f56954"],
          data: [
		    <?php 
			   $numItems = count($result3_estadi_users);
			   $i = 0;
			   foreach( $result3_estadi_users as $row ){
			      $tipo = $row['Estado'];
				  $cuenta = $row['cuenta'];
			      switch($tipo){
				    case 0:
					  echo '{label: "Inactivos", value: '.$cuenta.'}';
					break;
					case 1:
					  echo '{label: "Activos", value: '.$cuenta.'}';
					break;
					default:
					  echo '{label: "Otros", value: '.$cuenta.'}';
				  }
				  if(++$i != $numItems) {
                    echo ",";
                  }
			   }
			?>
          ],
          hideHover: 'auto'
        });
    });	
</script>