<?php
  include '../../../Datos/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tipo de Solicitud</title>
  <!-- NOTA: Codigo Inecesario by: Claudio Paz --> 
  <!-- <link rel="stylesheet" type="text/css" href="../../media/css/jquery.dataTables.css">
  <link type="text/css" rel="stylesheet" href="./media/css/jquery.dataTables_themeroller.css" />
  <script type="text/javascript" language="javascript" src="../../media/js/jquery.js"></script>
  <script type="text/javascript" language="javascript" src="../../media/js/jquery.dataTables.js"></script> -->
  
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

                  setTimeout(function() {
                  $(".content").fadeIn(1500);
                  },500);

                  setTimeout(function() {
                  $(".content").fadeOut(1500);
                  },500);

                  $('#exampleModal').modal('hide');
                  $('#tbody').load("pages/SecretariaAcademica/tipo_de_solicitud/recargarTablaSolicitud.php");
              },
              timeout: 4000
          }); 
          //La función implemente ajax para enviar la información a otros 
          //documentos que realizaran otros procedimientos sin necesidad de refrescar toda la pagina
      });
    });
</script>
<script type="text/javascript">
  $(document).ready(function() {
  $('#tblSolicitudes').dataTable(); // example es el id de la tabla
  });
  var x;
  x = $(document);
  x.ready(inicio);

  function inicio()
  {
      var x;
      x = $(".editar");
      x.click(editarTSolicitud);
  };

  function editarTSolicitud()
  {
    var cod=$(this).parents("tr").find("td").eq(0).html();
    var mitexto = document.getElementById("codSolicitud");
    mitexto.value=$.trim(cod);

    var nom=$(this).parents("tr").find("td").eq(1).html();
    var mitexto2 = document.getElementById("nomSolicitud");
    mitexto2.value= $trim(nom);
  }
</script>

<script type="text/javascript">
function actualizarTipoSolicitud()
{
  //alert('alert');
  var data2 = {
  "codSolicitud":$('#codSolicitud').val(),
  "nomSolicitud":$('#nomSolicitud').val()
  };
  //alert(data2);
  $.ajax({
    async: true,
    type: "POST",
    // dataType: "html",
    // contentType: "application/x-www-form-urlencoded",
    url: "pages/SecretariaAcademica/tipo_de_solicitud/editar_tipo_de_solicitud.php",
    data: data2,
    success: function(data){
        //alert(data);
        $('#notificaciones').html(data);
        $('#editarModal').modal('hide');
        $('#tbody').load("pages/SecretariaAcademica/tipo_de_solicitud/recargarTablaSolicitud.php");
    },
    timeout: 4000
  }); 
}
</script>
 
</head> 
  <div class="panel panel-default">
    <div class="col-lg-12">
      <h1 class="page-header">Tipo de Solicitudes</h1>
    </div>
    <div class="panel-body"> 
      <div class="conteiner">
        <div class="col-md-12">
          <form >
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Agregar Nuevo Tipo de solicitud</button>   
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="solicitud">Agregar Nuevo Tipo de Solicitud</h4>
                  </div>
                  <div class="modal-body">
                    <form id = "form" name="form" method="POST" action="pages/SecretariaAcademica/tipo_de_solicitud/tipo_de_solicitud.php">
                      <div class="form-group">
                        <label for="message-text" class="control-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombreSolicitud"  placeholder="Nombre" required>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id = "submit" class="btn btn-success" type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-12">
        <hr>
        <div class="panel panel-default">
        <div class="panel-heading">
          <h4 > <b>Mis Tipos de Solicitudes </b></h4>
        </div>
          <form >
          <div  class="content" id= "notificaciones"></div>
          <div class="panel-body">
            <div class="col-lg-12">
              <div class="form-group" >
                <div class="box-body table-responsive">
                  <table class="table table-bordered table-hover table-striped" id="tblSolicitudes" >
                    <thead>
                        <tr align="center" height="50px">
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Editar</th>
                            <th>Eliminar</th>                           
                        </tr>
                    </thead>
                    <tbody id="tbody">
                      <?php
                        $resultado= mysql_query("SELECT codigo, nombre FROM sa_tipos_solicitud");
                        while ($row = mysql_fetch_array($resultado)) 
                        {
                            $codigo = $row['codigo'];
                            $nom=$row['nombre'];
                        ?>
                          <tr height="50px">
                            <td id="codigo">
                              <?php echo $codigo ?>
                            </td>
                            <td id="nombreT">
                              <?php echo $nom ?>
                            </td>
                            <td>
                              <center>
                                <button type="button"  id="editar" href="#" class="editar btn btn-primary glyphicon glyphicon-edit"  data-toggle="modal" data-target="#editarModal" data-whatever="@mdo"></button>
                              </center>
                            </td>
                            <td>
                              <center>
                                <button type="button"  id="eliminar" href="#" class="elimina btn btn-danger glyphicon glyphicon-trash"></button>
                              </center>
                            </td>
                          </tr>
                        <?php
                         } 
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </form>
        </div>
        </div>
        
      </div>
    </div>
  </div>

  <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="solicitud">Editar Tipo de Solicitud</h4>
        </div>
        <div class="modal-body">
          <form id = "formEditar" name="formEditar">
            <div class="form-group">
              <label for="message-text" class="control-label">Código:</label>
              <input type="text" class="form-control" name="codSolicitud"  id="codSolicitud" style="text-align:left" disabled>
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label">Nuevo nombre:</label>
              <input type="text" class="form-control" name="nomSolicitud" id="nomSolicitud" style="text-align:left" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button id="btnActualizar" onclick="actualizarTipoSolicitud()" class="btn btn-success"  type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</html>

