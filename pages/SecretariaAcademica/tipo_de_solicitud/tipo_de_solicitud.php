<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tipo de Solicitud</title>
  <link rel="stylesheet" type="text/css" href="../../media/css/jquery.dataTables.css">
  <link type="text/css" rel="stylesheet" href="./media/css/jquery.dataTables_themeroller.css" />
  <script type="text/javascript" language="javascript" src="../../media/js/jquery.js"></script>
  <script type="text/javascript" language="javascript" src="../../media/js/jquery.dataTables.js"></script>
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

  $(document).ready(function() {
    $('#tblSolicitudes').dataTable( {
        "ajax": {
            "url": "pages/SecretariaAcademica/tipo_de_solicitud/dataTableSolicitud.php",
            "type": "POST"
          },
        "columns": [
            { "data": "codigo" },
            { "data": "nombre" },
            { "data": "acciones" },
          ]
    } );
  } );

  function cerrarModal(){
    $('#exampleModal').modal('hide'); 
  }
</script>
</head>
<body>
  <div class="col-lg-12">
      <h1 class="page-header">Tipo de Solicitudes</h1>
  </div>  
  <div class="panel panel-default">
    <div class="panel-body"> 
      <div class="conteiner">
        <div class="col-md-3" class="vertical-line">
          <form >
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Nuevo Tipo de solicitud</button>      
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="solicitud">Nuevo Tipo de Solicitud</h4>
                  </div>
                  <div class="modal-body">
                    <form id = "form" name="form" method="POST" action="pages/SecretariaAcademica/tipo_de_solicitud/tipo_de_solicitud.php">
                      <div class="form-group">
                        <label for="message-text" class="control-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombreSolicitud" placeholder="Nombre">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id = "submit" class="btn btn-success" onclick="cerrarModal()" type="submit" class="btn btn-primary">Guardar</button>
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
               <h3> Tipos de solicitud</h3>
              </div>
              <div class="form-group">
                <div class="box-body table-responsive">
                  <table  width="98%" id="tblSolicitudes" class="display block" cellspacing="0"  rules="all" border="2" align="center">
                    <thead>
                        <tr align="center" height="40px">
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Accinoes</th>                          
                        </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div id= "notificaciones">
          
        </div>
      </div>
    </div>
  </div>

</body>
</html>