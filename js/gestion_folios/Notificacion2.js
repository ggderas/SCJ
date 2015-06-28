$( document ).ready(function() {
	
	$(".btn-primary").on('click',function(){
        mode = $(this).data('mode');
        id = $(this).data('id');
        if(mode == "folio"){
          data={
            idFolio:id
          };
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/datos_folio.php", 
                success:Ver,
                timeout:4000,
                error:problemas
          }); 
          return false;
        }else if(mode == "notificacion"){
          data={
            idNotificacion:id
          };
         
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/datos_notificacion.php", 
                success:InfoNotifificacion,
                timeout:4000,
                error:problemas
          }); 
          
          return false;
        }

        else if(mode == "eliminar"){
          data={
            
                IdUsuario:$("#usuarioeliminar").val(),
                IdNotificacion:$("#EliminarNotificacion").val(),
                tipoProcedimiento:"eliminar",
                tipoNotificacion:"Basurero"
          };
         if (confirm('Esta seguro que desea eliminar esta notificacion?')) {
          $.ajax({
              async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/Notificacion.php", 
                success:notificacion,
                timeout:4000,
                error:problemas
          }); }
          
          return false;
        }
        else if(mode =="basurero_enviada"){
          data={
            idNotificacion:id,
            tipoProcedimiento:"actualizar_enviada",
            tipoNotificacion:"NotificacionEnviada"
          };
          if (confirm('Esta seguro que desea enviar al basurero esta notificacion?')) {
        
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
          }
          return false;
        }

        else if(mode =="basurero_recibida"){
          data={
            idNotificacion:id,
            IdUsuario:$("#usuarioeliminar").val(),
            tipoProcedimiento:"actualizar_recibida",
            tipoNotificacion:"NotificacionRecibida"
          };
          if (confirm('Esta seguro que desea enviar al basurero esta notificacion?')) {
        
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
          }
          return false;
        }

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
        
