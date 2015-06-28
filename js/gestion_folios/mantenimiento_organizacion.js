$( document ).ready(function() {
	
	$("form").submit(function(e) {
	    e.preventDefault();
		$("#compose-modal-actualizar").modal('hide');
            data={
                Organizacion:$("#Insertar_NombreOrganizacion").val(),
                Ubicacion:$("#Insertar_Ubicacion").val(),
                tipoProcedimiento:"insertar"
            };

            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_organizacion.php", 
                success:NuevaOrganizacion,
                timeout:4000,
                error:problemas
            }); 
            return false;
    });

});
        function NuevaOrganizacion(){

		    $('body').removeClass('modal-open');
            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_organizacion.php',data);
        }
        function problemas(){

            $("#div_contenido").text('Problemas en el servidor.');
        }
