var id;
var data;
var x;
    x=$(document);
    x.ready(inicio);

    function inicio(){

        var x;
        x=$("#gestion_folios");
        x.click(gestion_folios);

        var x1;
        x1=$("#folios");
        x1.click(folios);
 
        var x2;
        x2=$("#alertas");
        x2.click(alertas);

        var x3;
        x3=$("#notificaciones");
        x3.click(notificaciones);

        var x4;
        x4=$("#misFolios");
        x4.click(misFolios);

        var y;
        y=$("#mantenimiento_organizacion");
        y.click(mantenimiento_organizacion);
		
		var y1;
		y1=$("#mantenimiento_unidadacademica");
		y1.click(mantenimiento_unidadacademica);
		
		var y2;
		y2=$("#mantenimiento_prioridad");
		y2.click(mantenimiento_prioridad);
		
		var y3;
		y3=$("#mantenimiento_ubicacionfisica");
		y3.click(mantenimiento_ubicacion_archivofisico);
		
		var y4;
		y4=$("#mantenimiento_estado_seguimiento");
		y4.click(mantenimiento_estado_seguimiento);
		
		var y5;
		y5=$("#mantenimiento_ubicacion_notificaciones");
		y5.click(mantenimiento_ubicacion_notificaciones);
		
		var y6;
		y6=$("#mantenimiento_folios");
		y6.click(mantenimiento_folios);
		
		var y7;
		y7=$("#mantenimiento_categoria");
		y7.click(mantenimiento_categoria);
       
    }

        function gestion_folios() {
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/gestion_de_folios.php", 
                success:GestionFolios,
                timeout:4000,
                error:problemas
            }); 
            return false;
        }

        function folios() {
		    data={
			    tipoFolio:"todos"
			};
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/folios.php", 
                success:Folios,
                timeout:4000,
                error:problemas
            }); 
            return false;
        }

        function misFolios() {
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/misFolios.php", 
                success:MisFolios,
                timeout:4000,
                error:problemas
            }); 
            return false;
        }

        function alertas() {
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/alertas.php", 
                success:Alertas,
                timeout:4000,
                error:problemas
            }); 
            return false;
        }

        function notificaciones() {
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/Notificacion.php", 
                success:Notificaciones,
                timeout:4000,
                error:problemas
            }); 
            return false;
        }

        function mantenimiento_organizacion() {
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_organizacion.php", 
                success:MantenimientoOrganizacion,
                timeout:4000,
                error:problemas
            }); 
            return false;
        }
		
		function mantenimiento_unidadacademica() {
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_unidadacademica.php", 
                success:MantenimientoUnidadAcademica,
                timeout:4000,
                error:problemas
            }); 
            return false;
        }
		
		function mantenimiento_prioridad() {
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_prioridad.php", 
                success:MantenimientoPrioridad,
                timeout:4000,
                error:problemas
            }); 
            return false;
        }
		
		function mantenimiento_ubicacion_archivofisico() {
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_archivofisico.php", 
                success:MantenimientoUbicacionArchivoFisico,
                timeout:4000,
                error:problemas
            }); 
            return false;
        }
		
		function mantenimiento_estado_seguimiento() {
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_estado_seguimiento.php", 
                success:MantenimientoEstadoSeguimiento,
                timeout:4000,
                error:problemas
            }); 
            return false;
        }
		
		function mantenimiento_ubicacion_notificaciones() {
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_notificaciones.php", 
                success:MantenimientoUbicacionNotificaciones,
                timeout:4000,
                error:problemas
            }); 
            return false;
        }
		
		function mantenimiento_folios() {
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_folios.php", 
                success:MantenimientoFolios,
                timeout:4000,
                error:problemas
            }); 
            return false;
        }
		
		function mantenimiento_categoria() {
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_categorias_folios.php", 
                success:MantenimientoCategorias,
                timeout:4000,
                error:problemas
            }); 
            return false;
        }

        function GestionFolios(){

            $("#div_contenido").load('pages/gestion_folios/gestion_de_folios.php');
        }
        function Folios(){

            $("#div_contenido").load('pages/gestion_folios/folios.php',data);
        }
        function MisFolios(){

            $("#div_contenido").load('pages/gestion_folios/misFolios.php');
        }

        function Alertas(){

            $("#div_contenido").load('pages/gestion_folios/alertas.php');
        }
        function Notificaciones(){

            $("#div_contenido").load('pages/gestion_folios/Notificacion.php');
        }
        function MantenimientoOrganizacion(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_organizacion.php');
        }
		function MantenimientoUnidadAcademica(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_unidadacademica.php');
        }
		function MantenimientoPrioridad(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_prioridad.php');
        }
		function MantenimientoUbicacionArchivoFisico(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_archivofisico.php');
        }
		function MantenimientoEstadoSeguimiento(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_estado_seguimiento.php');
        }
		function MantenimientoUbicacionNotificaciones(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_notificaciones.php');
        }
		function MantenimientoFolios(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_folios.php');
        }
		function MantenimientoCategorias(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_categorias_folios.php');
        }
        function problemas(){

            $("#div_contenido").text('Problemas en el servidor.');
        }
