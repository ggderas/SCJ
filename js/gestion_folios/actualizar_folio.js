$( document ).ready(function() {

    $("form").submit(function(e) {
	    e.preventDefault();
            data ={ 
			    idFolioAnt:$("#NroFolioAnt").val(),
                idFolio:$("#NroFolio").val(),
                fechaCreacion:$("#dp1").val(),
                personaReferente:$("#personaReferente").val(),
                unidadAcademica:$("#unidadAcademica option:selected").val(),
                organizacion:$("#Organizacion option:selected").val(),
				categoria:$("#Categoria option:selected").val(),
                descripcion:$("#Descripcion").val(),
                tipoFolio:$("#TipoFolio option:selected").val(),
                ubicacionFisica:$("#ubicacionFisica option:selected").val(),
                prioridad:$("#Prioridad option:selected").val(),
				prioridadAnt:$("#PrioridadAnt").val(),
                tipoProcedimiento:"actualizar_folio_"
            };
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/datos_folio.php", 
                success:cargarFolios,
                timeout:4000,
                error:problemas
            }); 
            return false;
	});

	$( "#cancel" ).click(function() {
	    data ={ 
			    idFolio:$("#NroFolioAnt").val()
			};
	    $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/datos_folio.php", 
                success:cargarFolios,
                timeout:4000,
                error:problemas
        }); 
        return false;
    });		
	
});
	
    function cargarFolios()
    {
        $("#div_contenido").load('pages/gestion_folios/datos_folio.php',data);
    }

    function problemas()
    {
        $("#div_contenido").text('Problemas en el servidor.');
    }