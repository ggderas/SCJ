<div class="col-lg-12">
    <h1 class="page-header">Solicitudes</h1>
</div>  


<script type="text/javascript">
$(document).ready(function(e) {
  $("form").submit(//Se realiza cuando se ejecuta un "submit" en el formulario, el "submit" se encuentra en el boton "Envíar Solicitud
  function(e) {
      e.preventDefault();    
      var data1 = {
              "nombreSolicitud":$('#nombreSolicitud').val()
          };

      $.ajax({
          async: true,
          type: "POST",
          // dataType: "html",
          // contentType: "application/x-www-form-urlencoded",
          url: "pages/SecretariaAcademica/tipo_de_solicitud/registrar_tipo_de_solicitud.php",
          data: data1,
          success: function(data){
              $('#notificaciones').html(data);
          },
          timeout: 4000
      }); 
      //La función implemente ajax para enviar la información a otros 
      //documentos que realizaran otros procedimientos sin necesidad de refrescar toda la pagina
  });
});

</script>
<br>
<div class="panel panel-default">
  <div class="panel-body"> 
         
    <div class="conteiner">
      <div class="col-md-3" class="vertical-line">
        <form >
          <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Nueva solicitud</button>      
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="solicitud">Nueva Solicitud</h4>
                </div>
                <div class="modal-body">
                  <form id = "form" name="form" method="POST" action="pages/SecretariaAcademica/tipo_de_solicitud/tipo_de_solicitud.php">
                    <div class="form-group">
                      <label for="message-text" class="control-label">Nombre:</label>
                      <input type="text" class="form-control" id="nombreSolicitud" placeholder="Nombre">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button id = "submit" type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-9">
        <form>
          <div class="panel panel-primary">
              <div class="panel-body">
               <h3> Solicitudes</h3>
              </div>
              <div class="form-group">
                <h1>no hay solicitudes</h1>
              </div>
              </div>
        </form>
      </div>
      <div id= "notificaciones"></div>
    </div>
  </div>
</div>