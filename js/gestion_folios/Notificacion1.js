$( document ).ready(function() {
	
    $("form").submit(function(e) {
        e.preventDefault();
        $("#compose-modal").modal('hide');
            data={
                NroFolio:$("#NroFolio").val(),
                idEmisor:$("#Insertar_Emisor").val(),
                Titulo:$("#Insertar_Titulo").val(),
                Cuerpo:$("#Insertar_Mensaje").val(),
                FechaCreacion:$("#FechaCreacion").val(),
                UsuariosNotificados:$("#Destinatarios").val(),
                tipoProcedimiento:"insertar",
                tipoNotificacion:"NotificacionEnviada"
            };

            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/Notificacion.php", 
                success:EnviarNotificacion,
                timeout:4000,
                error:problemas  
            }); 
            return false;
    });

 $( "#enviadas" ).click(function() {
        data={
            tipoNotificacion:"NotificacionEnviada"
        };
        $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/Notificacion.php", 
                success:notificacion,
                timeout:4000,
                error:problemas
        }); 
        return false;
    });

    $( "#recibidas" ).click(function() {
        data={
            tipoNotificacion:"NotificacionRecibida"
        };
        $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/Notificacion.php", 
                success:notificacion,
                timeout:4000,
                error:problemas
        }); 
        return false;
    });

    $( "#basurero" ).click(function() {
        data={
            tipoNotificacion:"Basurero"
        };
        $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/Notificacion.php", 
                success:notificacion,
                timeout:4000,
                error:problemas
        }); 
        return false;
    });



 $( "#enviadas" ).click(function() {
        data={
            tipoNotificacion:"NotificacionEnviada"
        };
        $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/Notificacion.php", 
                success:notificacion,
                timeout:4000,
                error:problemas
        }); 
        return false;
    });

    $( "#recibidas" ).click(function() {
        data={
            tipoNotificacion:"NotificacionRecibida"
        };
        $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/Notificacion.php", 
                success:notificacion,
                timeout:4000,
                error:problemas
        }); 
        return false;
    });

    $( "#basurero" ).click(function() {
        data={
            tipoNotificacion:"Basurero"
        };
        $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/Notificacion.php", 
                success:notificacion,
                timeout:4000,
                error:problemas
        }); 
        return false;
    });


});
function Ver(){

    $("#div_contenido").load('pages/gestion_folios/datos_folio.php',data);
}

function InfoNotifificacion(){

    $("#div_contenido").load('pages/gestion_folios/datos_notificacion.php',data);
}




 function notificacion(){

    $("#div_contenido").load('pages/gestion_folios/Notificacion.php',data);
}

function EnviarNotificacion(){
         $('body').removeClass('modal-open');

            $("#div_contenido").load('pages/gestion_folios/Notificacion.php',data);
        }
 function problemas(){

            $("#div_contenido").text('Problemas con el servidor.');
        }
        
