$( document ).ready(function() {
	
	$("form").submit(function(e) {
	    e.preventDefault();
		$("#compose-modal-actualizar").modal('hide');
            data={
                DescripcionEstadoSeguimiento:$("#Insertar_DescripcionEstadoSeguimiento").val(),
                tipoProcedimiento:"insertar"
            };

            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_estado_seguimiento.php", 
                success:NuevoEstadoSeguimiento,
                timeout:4000,
                error:problemas
            }); 
            return false;
    });

});
        function NuevoEstadoSeguimiento(){

		    $('body').removeClass('modal-open');
            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_estado_seguimiento.php',data);
        }
        function problemas(){

            $("#div_contenido").text('Problemas en el servidor.');
        }
