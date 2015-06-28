$( document ).ready(function() {
	
	$("#form1").submit(function(e) {
	    e.preventDefault();
		$("#compose-modal-actualizar").modal('hide');
            data ={ 
			    idFolio:$("#id_folio").data("folio"),
				prioridad:$("#id_folio").data("prioridad"),
				finalizar:$("#chkFinalizado").prop('checked'),
			    seguimiento:$("#Seguimiento_actualizar option:selected").val(),
				notas:$("#NotasSeguimiento_actualizar").val(),
				tipoProcedimiento:"actualizar"
            };
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/datos_folio.php", 
                success:llegadaGuardar,
                timeout:4000,
                error:problemas
            }); 
            return false;
	});

	$("#form2").submit(function(e) {
	    e.preventDefault();
		$("#compose-modal-actualizar").modal('hide');
            data ={ 
			    idFolio:$("#id_folio").data("folio"),
			    encargado:$("#modEncargado option:selected").val(),
			    tipoProcedimiento:"actualizar_Asignado"
            };
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/datos_folio.php", 
                success:llegadaGuardar,
                timeout:4000,
                error:problemas
            }); 
            return false;
	});

	$( "#modificar_datos" ).click(function() {
	    data ={
		    idFolio:$("#id_folio").data("folio")
		};
	    $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/actualizar_datos_folio.php", 
                success:modificarDatosFolio,
                timeout:4000,
                error:problemas
        }); 
        return false;
    });	
	
	$( "#folio_respuesta" ).click(function() {
	    data ={
		    idFolio:$("#id_folio").data("folio")
		};
	    $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/nuevo_folio.php", 
                success:folioRespuesta,
                timeout:4000,
                error:problemas
        }); 
        return false;
    });	

	$( "#FolioRes" ).click(function() {
	    id = $("#FolioRes").data('id');
          data ={ idFolio:id};     
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/datos_folio.php", 
                success:llegadaVer,
                timeout:4000,
                error:problemas
            }); 
            return false;
	});
});

    function modificarDatosFolio()
    {
        $("#div_contenido").load('pages/gestion_folios/actualizar_datos_folio.php',data);
    }
	
	function folioRespuesta()
    {
        $("#div_contenido").load('pages/gestion_folios/nuevo_folio.php',data);
    }
	
    function llegadaGuardar()
    {
	    $('body').removeClass('modal-open');
        $("#div_contenido").load('pages/gestion_folios/datos_folio.php',data);
    }
	
	function llegadaVer(){

        $("#div_contenido").load('pages/gestion_folios/datos_folio.php',data);
    }

    function problemas()
    {
        $("#div_contenido").text('Problemas en el servidor.');
    }