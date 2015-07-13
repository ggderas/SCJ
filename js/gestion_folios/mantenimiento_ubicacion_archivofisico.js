$( document ).ready(function() {
	
	$("form").submit(function(e) {
	    e.preventDefault();
		$("#compose-modal-actualizar").modal('hide');
            data={
                DescripcionUbicacionFisica:$("#Insertar_DescripcionUbicacionFisica").val(),
                Capacidad:$("#Insertar_Capacidad").val(),
				TotalIngresados:$("#Insertar_TotalIngresados").val(),
				HabilitadoParaAlmacenar:$("#Insertar_HabilitadoParaAlmacenar option:selected").val(),
                tipoProcedimiento:"insertar"
            };

            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_archivofisico.php", 
                success:NuevaUbicacionArchivoFisico,
                timeout:4000,
                error:problemas
            }); 
            return false;
    });

});

        function NuevaUbicacionArchivoFisico(){

		    $('body').removeClass('modal-open');
            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_archivofisico.php',data);
        }
        function problemas(){

            $("#div_contenido").text('Problemas en el servidor.');
        }
