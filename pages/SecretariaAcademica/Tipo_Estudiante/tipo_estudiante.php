<script type= "text/javascript" src="../jquery-1.11.3.min.js"></script>
<script type= "text/javascript" src="../jquery.maskedinput.js"></script>
<script type= "text/javascript" src="../funcion.js"></script>

<html>
<body>
<div class="container">
	<div class="Row">
		<div class="col-md-6">
			<form>
				<div class="row">
				    <div class="col-lg-12">
				        <h1 class="page-header">Modificar el tipo de estudiante</h1>
				    </div>
			    </div>
				<div class="panel-body">
					<div class="form-group">
						<label >Número de Identidad</label>
						<input type="text" class="form-control" name="Identidad" id="Identidad"/>
					</div>
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control" id="Nombre" disabled="False"/>
					</div>
					<div class="form-group">
						<label>Tipo de estudiante</label>
						<input type="text" class="form-control" id="TipoE" disabled="False"/>
					</div>
					<div class="form-group">
						<label>Seleccione nuevo tipo estudiante</label>
						<select class="form-control" id="NuevoTipoE">
							<option>LLENAR EL COMBOBOX CON LA BD</option>
						</select>
					</div>
					<button type="submit" class="btn btn-default">Guardar</button>
					<button type="submit" class= "btn btn-default">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>