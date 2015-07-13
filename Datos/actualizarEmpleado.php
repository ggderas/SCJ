<?php
       
	//require_once('funciones.php');
        //require_once('conexion.php');
	
	

	If(isset($_POST['nidentidadE'])){
		
		$n_identidad=$_POST['nidentidadE'];
                 $codigo=$_POST['codigo'];
		 $id_departamento=$_POST['departE'];
                 $fechaIngreso=$_POST['fechaE'];
                 $obs=$_POST['obsE'];
                 
               
		
        $rec2=mysql_query("SELECT No_Empleado FROM empleado WHERE No_Empleado='".$codigo."'");
        $temp=mysql_fetch_row($rec2);
        
        
        $t=$temp[0];      
              
     $enlace = mysql_connect('localhost', 'root', '');
     mysql_select_db("ccjj", $enlace);
		 
	$queryAE = mysql_query("UPDATE `empleado` SET `No_Empleado`='$codigo',`Id_departamento`='$id_departamento',`Fecha_ingreso`='$fechaIngreso',`Observacion`='$obs'  WHERE N_identidad ='".$n_identidad."'");
        
       // $query2=mysql_query("UPDATE empleado_has_cargo SET ID_cargo='$id_cargo' WHERE No_empleado ='".$codigo."'");
	
     
	
	if($queryAE){
	
		//echo '<META HTTP-EQUIV="REFRESH" CONTENT="2">' ;
            $mensaje = 'Empleado actualizado con Exito';
            $codMensaje = 1;
	    $existe=FALSE;
	
	
	}else{
            
             $mensaje = 'error al actualizar el empleado' . mysql_errno();
             $codMensaje = 0;
             $existe=TRUE;
            
        }
        
	
        mysql_close($enlace);
	
        

	
	}
        
    // include '../pages/recursos_humanos/Empleados.php';
?>
