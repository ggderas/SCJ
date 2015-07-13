$(document).ready(function() {

    $('#event').on('switchChange.bootstrapSwitch', function (event, state) {
		$('#mensajes').load("pages/administracion/eventos.php?active=" + state);
	}); 
	
	$('#cargar_usuarios').on("click",function(){
	    $('#usuariosLog').load("pages/administracion/Usuarios.php");
	});
	
	$('#cargas_logs').on("click",function(){
	    $('#usuariosLog').load("pages/administracion/cargarLogs.php");
	});
});