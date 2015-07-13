$( document ).ready(function() {
	
	$("form").submit(function(e) {
	    e.preventDefault();
		$("#compose-modal-actualizar").modal('hide');
            data={
			    Id_Prioridad:$("#Insertar_Id_Prioridad").val(),
                DescripcionPrioridad:$("#Insertar_DescripcionPrioridad").val(),
                tipoProcedimiento:"insertar"
            };

            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_prioridad.php", 
                success:NuevaPrioridad,
                timeout:4000,
                error:problemas
            }); 
            return false;
    });

});
        function NuevaPrioridad(){

		    $('body').removeClass('modal-open');
            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_prioridad.php',data);
        }
        function problemas(){

            $("#div_contenido").text('Problemas en el servidor.');
        }
