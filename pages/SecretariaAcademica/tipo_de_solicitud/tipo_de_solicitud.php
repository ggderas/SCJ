<div class="col-lg-12">
    <h1 class="page-header">Solicitudes</h1>
</div>  


<script type="text/javascript">
  function soloNumeros(e){
 var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46))
return true;
 
return /\d/.test(String.fromCharCode(keynum));
</script>
<br>
<div class="panel panel-default">
  <div class="panel-body"> 
         
    <div class="conteiner">
      <div class="col-md-3" class="vertical-line">
        <form>
          
          <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Nueva solicitud</button>
                    
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="solicitud">Nueva Solicitud</h4>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="form-group">
                      <label for="recipient-name" class="control-label">Código:</label>
                      <input type="text" class="form-control" id="codigoSolicitud"   onkeypress="return soloNumeros(event)">
                    </div>
                    <div class="form-group">
                      <label for="message-text" class="control-label">Nombre:</label>
                      <input type="text" class="form-control" id="codigoSolicitud" value="nombre">
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary">Guardar</button>
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
              no hay solicitudes
              </div>
              </div>
        </form>
      </div>
    </div>
  </div>
</div>