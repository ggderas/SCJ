 <?php
  include '../../../Datos/conexion.php';
?>    

<?php
	/*Se llama a procedimiento almacenado*/
	$resultado= mysql_query("CALL SP_OBTENER_AREAS(@pcMensajeError)", $enlace);
	/*Se obtienen y almacenan los valores devueltos*/
	while ($row = mysql_fetch_array($resultado)) 
	{
	  $codigo = $row['codigo'];
	  $nom=$row['nombre'];
	?>
	<!--Se inserta en la tabla-columna los valores obtenidos-->
	<tr height="50px">
	  <td id="codigo">
	    <?php echo $codigo ?>
	  </td>
	  <td id="nombreT">
	    <?php echo $nom ?>
	  </td>
	  <td>
	    <center>
	      <button type="button"  id="editar" href="#" class="editar btn btn-info fa fa-pencil" data-whatever="@mdo"></button>
	    </center>
	  </td>
	  <td>
	    <center>
	      <button type="button"  id="eliminar" href="#" class="elimina btn btn-danger glyphicon glyphicon-trash"></button>
	    </center>
	  </td>
	</tr>
	<?php
	} 
?>