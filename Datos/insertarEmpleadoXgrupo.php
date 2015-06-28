<?php

//include "../Datos/conexion.php";
require_once('funciones.php');

//include "$root\curriculo\Datos\funciones.php";
        

	$enlace = mysql_connect('localhost', 'root', '');
 mysql_select_db("sistema_ciencias_juridicas", $enlace);
        
          
	If(isset($_POST['cod_empleado'])){
	
           
		$no_empleado=$_POST['cod_empleado'];
		 
		
               //  $fechaingreso=$_POST['fecha2'];
               //  
             $nGrupo=$_POST['nombreGrupo'];
             $pa2= mysql_query("SELECT * FROM grupo_o_comite where Nombre_Grupo_o_comite='".$nGrupo."'") ;
             //var_dump($pa2);

               $row2=mysql_fetch_array($pa2);
               $idG=$row2['ID_Grupo_o_comite'];     		 
 
	$query= mysql_query("INSERT INTO `grupo_o_comite_has_empleado`(`ID_Grupo_o_comite`, `No_Empleado`) VALUES ('$idG','$no_empleado')");
	
	
	if($query){
            
            
          
            $mensaje = 'Empleado agregado con Exito';
            $codMensaje = 1;
             //echo mensajes('Empleado agregado con Exito','verde');
	
		//echo '<METAHTTP-EQUIV="REFRESH" CONTENT="2">' ;
		//echo mensajes('Ingresado exitosamente','verde');
            }
	
	
	else{
            $mensaje = 'error al ingresar el registro o empleado actualmente existente';
            $codMensaje = 0;
            //echo mensajes('error al ingresar el registro o empleado actualmente existente','rojo');
       
        }
    }
   //include "../pages/recursos_humanos/gestion_Grupos_comite.php";
        
  ?>