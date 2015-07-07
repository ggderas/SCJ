<div class="col-md-8 col-sm-4">
      	<div class="panel panel-default">
           <div class="panel-heading"><h4>Tipo de estudiantes</h4></div>
		   <div class="panel-body">
		      <div id="chartLog">
				<form action="Prueba.php" method="post">
				<table>
					<tr>
						<td>N° identidad:</td>
						<td><input type="text" size="30" name="Te_Nid"/></td>
					</tr>
					<tr>
						<td>Nombre:</td>
						<td><input type="text" size="30" name="Te_nombre" disabled='false' /></td>
					</tr>
					<tr>
						<td>Tipo de estudiante:</td>
						<td><input type="text" size="30" name="Te_tipo" disabled='false'/></td>
					</tr>
					<tr>
						<td>Eliga nuevo tipo:</td>
						<td><select name="Te_nuevo" style="width:244px">
						<option>Pregrado</option>
						<option>Postgrado</option>
						<option>Pregrado y Postgrado</option>
						</select>		
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
						<input type="submit" name="Cancelar" value= "Cancelar"align="left"/>
						<input type="submit" name="Guardar" value= "Guardar" align="right"/>
						</td>
					</tr>
				</table>
				</form> 
			  </div>
		   </div>
        </div>