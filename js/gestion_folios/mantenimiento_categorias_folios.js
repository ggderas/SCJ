$( document ).ready(function() {
	
	$("form").submit(function(e) {
	    e.preventDefault();
		$("#compose-modal-actualizar").modal('hide');
            data={
                NombreCategoria:$("#Insertar_NombreCategoria").val(),
                DescripcionCategoria:$("#Insertar_DescripcionCategoria").val(),
                tipoProcedimiento:"insertar"
            };

            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_categorias_folios.php", 
                success:NuevaCategoriasFolios,
                timeout:4000,
                error:problemas
            }); 
            return false;
    });

});
        function NuevaCategoriasFolios(){

		    $('body').removeClass('modal-open');
            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_categorias_folios.php',data);
        }
        function problemas(){

            $("#div_contenido").text('Problemas en el servidor.');
        }
