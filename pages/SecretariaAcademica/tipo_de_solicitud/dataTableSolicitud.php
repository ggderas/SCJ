<?php
	define("cServidor","mysqlv115");
	define("cUsuario", "root");
	define("cPass","");
	define("cBb", "ccjj");

	$conn=mysqli_connect(cServidor,cUsuario,cPass,cBb);
	$query="Select * from sa_tipos_solicitud";
	$resultado=mysqli_query($conn,$query);

	$i=0;
	$tabla="";
	while ($row=mysqli_fetch_array($resultado)) 
	{
		$editar='<a href=\"#\" onclick=\"modifica('.$row['codigo'].')\"><img border=\"0px\" src=\" ./imgs/editar.png\" alt=\"Modificar\"/></a>';

		$tabla.='{"codigo":"'.$row['codigo'].'","nombre":"'.$row['nombre'].'","acciones":"'.$editar.'"},';
		$i++;
	}
	$tabla=substr($tabla,0,strlen($tabla)-1);
	echo '{"data":['.$tabla.']}';
?>