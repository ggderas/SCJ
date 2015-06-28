$( document ).ready(function() {

    $( "#todosFolios" ).click(function() {
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
	});
	
	$( "#foliosSalida" ).click(function() {
	    data={
			tipoFolio:"foliosSalida"
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
	});
	
	$( "#foliosEntrada" ).click(function() {
	    data={
			tipoFolio:"foliosEntrada"
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
	});

    $( "#nuevo_folio" ).click(function() {
	    $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/nuevo_folio.php", 
                success:llegadaNuevoFolio,
                timeout:4000,
                error:problemas
        }); 
        return false;
	});

});    

function Folios(){

    $("#div_contenido").load('pages/gestion_folios/folios.php',data);
}
function llegadaVer(){

    $("#div_contenido").load('pages/gestion_folios/datos_folio.php',data);
}
function llegadaNuevoFolio(){

    $("#div_contenido").load('pages/gestion_folios/nuevo_folio.php');
}
function problemas(){

    $("#div_contenido").text('Problemas en el servidor.');
}