$( document ).ready(function() {
	
	$("form").submit(function(e) {
	    e.preventDefault();
		$("#compose-modal-actualizar").modal('hide');
            data={
                UnidadAcademica:$("#Insertar_NombreUnidadAcademica").val(),
                Ubicacion:$("#Insertar_UbicacionUnidadAcademica").val(),
                tipoProcedimiento:"insertar"
            };

            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_unidadacademica.php", 
                success:NuevaUnidadAcademica,
                timeout:4000,
                error:problemas
            }); 
            return false;
    });
	
});

        function NuevaUnidadAcademica(){

		    $('body').removeClass('modal-open');
            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_unidadacademica.php',data);
        }
        function problemas(){

            $("#div_contenido").text('Problemas en el servidor.');
        }
