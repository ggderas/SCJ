<?php

      $no_empleado=$_POST['codigo'];
      $cargo=$_POST['cargoE'];
      $fecha= date("Y-m-d");

     $query= mysql_query("INSERT INTO `empleado_has_cargo`(`No_Empleado`, `ID_cargo`, `Fecha_ingreso_cargo`) VALUES ('$no_empleado','$cargo','$fecha')");
            
            if($query){
                
                   $mensaje = 'Registro agregado con Exito';
            $codMensaje = 1;
             
            
	
		//echo '<METAHTTP-EQUIV="REFRESH" CONTENT="2">' ;
		//echo mensajes('Ingresado exitosamente','verde');
            }
	
	
	else{
             $mensaje = 'error al ingresar el registro o registro Existente';
             $codMensaje = 0;
            
        }