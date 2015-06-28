$( document ).ready(function() {
	
	$("form").submit(function(e) {
	    e.preventDefault();
		$("#compose-modal-actualizar").modal('hide');
            data={
                DescripcionUbicacionNotificaciones:$("#Insertar_DescripcionUbicacionNotificaciones").val(),
                tipoProcedimiento:"insertar"
            };

            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_notificaciones.php", 
                success:NuevoUbicacionNotificaciones,
                timeout:4000,
                error:problemas
            }); 
            return false;
    });

});
        function NuevoUbicacionNotificaciones(){

		    $('body').removeClass('modal-open');
            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_notificaciones.php',data);
        }
        function problemas(){

            $("#div_contenido").text('Problemas en el servidor.');
        }
