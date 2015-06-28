<?php
        include '../Datos/conexion.php';
	require_once('funciones.php');

	If(isset($_POST['idRol'])&&(isset($_POST['descripcion']))){
		
		 $rol=$_POST['nombre'];
		 $codigo=$_POST['idRol'];	 
                 $descripcion=$_POST['descripcion'];
                // echo $descripcion;
                // echo $rol;
                $query= mysql_query("UPDATE roles SET 
                 Descripcion='$descripcion',
                 nombre_Rol='$rol'
                 WHERE Id_Rol='$codigo'");
	if($query){

		echo mensajes('Actualizado con Exito','verde');
	
	}else{}

	}
        
       include '../Datos/cargarRoles.php';
?>