<?php
  include '../../../Datos/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
  <head>

    <meta charset="UTF-8">
    <title>Tipo de Solicitud</title>
    <link rel="stylesheet" type="text/css" href="../../media/css/jquery.dataTables.css">
    <link type="text/css" rel="stylesheet" href="./media/css/jquery.dataTables_themeroller.css" />
    <script type="text/javascript" language="javascript" src="../../media/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="../../media/js/jquery.dataTables.js"></script>

    <!--Funcion que permite insertar un area en la base de datos, 
    se genera al presionar el boton guardar del modal agregar-->
    <script type="text/javascript">
      $(document).ready(function(e) {
        $("form").submit(//Se realiza cuando se ejecuta un "submit" en el formulario, el "submit" se encuentra en el boton "Envíar Solicitud
        function(e) {
            e.preventDefault();    
            /*Se envian los parametros que necesita el procedimiento almacenado*/
            var data1 = {
                  "nombreAreaProyecto":$('#nombreAreaProyecto').val()
                };
            /*Se carga contenido ca_registrar_Areas_de_Proyecto*/
            $.ajax({
                async: true,
                type: "POST",
                url: "pages/CargaAcademica/Areas_de_Proyectos/ca_registrar_Areas_de_Proyecto.php",
                data: data1,
                success: function(data){
                  /*Se recibe valor devuelto*/
                  $('#notificaciones').html(data);
                  /*Funcion que permita mostrar un alerta en cierto tiempo*/
                  setTimeout(function() {
                  $(".content").fadeIn(1500);
                  },500);
                  /*Funcion que permita ocultar un alerta en cierto tiempo*/
                  setTimeout(function() {
                  $(".content").fadeOut(1500);
                  },500);
                  /*Se esconde el modal agregar area*/
                  $('#exampleModal').modal('hide');
                  /*Se recarga contenido de la tabla*/
                  $('#tbody').load("pages/CargaAcademica/Areas_de_Proyectos/ca_cargar_Tabla_Areas_de_Proyecto.php");
                  $('#nombreAreaProyecto').val('');
                },
                timeout: 4000
            }); 
        });
      });
    </script>

    <!--Funcion que permite agregar un estilo Datatable-->
    <script type="text/javascript">
      $(document).ready(function() {
      $('#tblAreasProyecto').dataTable();
      });
    </script>

    <!--Funcion que se sucede al dar click sobre el boton editar del Datatable-->
    <script type="text/javascript">
      $(document).on("click",".editar",function () {
        /*Se extrae valor de codigo y nombre, del datatable*/
        codigoAP = $(this).parents("tr").find("td").eq(0).text().trim();
        nombreAP = $(this).parents("tr").find("td").eq(1).text().trim();
        /*Se asigna valor extraido a sus respectivos input, en el modal editar*/
        $("#codAreaProyecto").val(codigoAP);
        $("#nomAreaProyecto").val(nombreAP); 
        /*Se abre el modal editar*/               
        $("#editarModal").modal('show');
          });
    </script>

    <!--Funcion que permite modificar un area, se genera al presionar el boton guardar del modal editar-->
    <script type="text/javascript">
      function actualizarAreaProyecto()
      {
        /*Se envian los parametros que necesita el procedimiento almacenado*/
        var data2 = {
        "codAreaProyecto":$('#codAreaProyecto').val(),
        "nomAreaProyecto":$('#nomAreaProyecto').val()
        };
        /*Se carga contenido ca_editar_Areas_de_Proyecto*/
        $.ajax({
          async: true,
          type: "POST",
          url: "pages/CargaAcademica/Areas_de_Proyectos/ca_editar_Areas_de_Proyecto.php",
          data: data2,
          success: function(data){
              /*Se recibe valor devuelto*/
              $('#notificaciones').html(data);
              /*Funcion que permita mostrar un alerta en cierto tiempo*/
              setTimeout(function() {
              $(".content").fadeIn(1500);
              },500);
              /*Funcion que permita ocultar un alerta en cierto tiempo*/
              setTimeout(function() {
              $(".content").fadeOut(1500);
              },1500);
              /*Se esconde el modal agregar area*/
              $('#editarModal').modal('hide');
              /*Se recarga contenido de la tabla*/
              $('#tbody').load("pages/CargaAcademica/Areas_de_Proyectos/ca_cargar_Tabla_Areas_de_Proyecto.php");
            },
            timeout: 4000
          }); 
      }
    </script>


    <!--Funcion que permite modificar un area, se genera al presionar el boton guardar del modal editar-->
    <script type="text/javascript">
      $(document).on("click",".elimina",function () {
        /*Muestra un mensaje, con el contenido espesificado*/
        var respuesta = confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
        if (respuesta)
        {
          /*Se obtiene el valor selccionado del datatable*/
          codigoAP = $(this).parents("tr").find("td").eq(0).text().trim();
          /*Se envian los parametros que necesita el procedimiento almacenado*/
          var data3 = 
          {
            "codAreaProyecto":codigoAP
          };
          /*Se carga contenido ca_editar_Areas_de_Proyecto*/
          $.ajax({
          async: true,
          type: "POST",
          url: "pages/CargaAcademica/Areas_de_Proyectos/Eliminar_area.php",
          data: data3,
          success: function(data){
            /*Se recibe valor devuelto*/
            $('#notificaciones').html(data);
            /*Funcion que permita mostrar un alerta en cierto tiempo*/
            setTimeout(function() {
            $(".content").fadeIn(1500);
            },500);
            /*Se esconde el modal agregar area*/
            setTimeout(function() {
              $(".content").fadeOut(1500);
              },1500);
              /*Se esconde el modal agregar area*/
              $('#editarModal').modal('hide');
              /*Se recarga contenido de la tabla*/
              $('#tbody').load("pages/CargaAcademica/Areas_de_Proyectos/ca_cargar_Tabla_Areas_de_Proyecto.php");
            },
            timeout: 4000
          }); 
        } 
      });
    </script>
  </head>

  <body> 
      <div class="row"> 
        <!---->
        <div class="panel panel-default">
          <div class="panel-body">
              <div class="col-lg-8">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Agregar nueva área</button>  
              </div>
          </div>
        </div> 
        <!--Datatable con el contenido de la tabla ca_areas-->
        <div class="panel panel-default">
          <div class="panel-heading">
              <h4><b>Áreas de proyecto</b></h4>
          </div>
          <!--Se recibe mensaje de procedimiento almacenado-->
          <div  style="display:none" class="content" id= "notificaciones"></div>
          <!--Contenido de tabla-->
          <div class="panel-body">
            <table class="table table-bordered table-hover table-striped" id="tblAreasProyecto" >
              <thead>
                <tr align="center" height="50px">
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Editar</th>
                  <th>Eliminar</th>                           
                </tr>
              </thead>
              <tbody id="tbody">
                <?php include 'ca_cargar_Tabla_Areas_de_Proyecto.php'; ?>
              </tbody>
            </table>   
          </div>
        </div> 
        <!--Modal agregar areas-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <form role="form" id="form" name="form" >
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="areadR">Agregar nueva área</h4>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                              <label for="message-text" class="control-label">Nombre:</label>
                              <input type="text" class="form-control" id="nombreAreaProyecto"  placeholder="Nombre" required>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id = "submit" class="btn btn-success" type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
        <!-- Modal para Editar -->
        <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <form role="form" id = "formEditar" name="formEditar" >
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="areaE">Editar Área</h4>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                            <input type="hidden" class="form-control" name="codAreaProyecto"  id="codAreaProyecto" style="text-align:left" disabled>
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="control-label">Nuevo nombre:</label>
                            <input type="text" class="form-control" name="nomAreaProyecto" id="nomAreaProyecto" style="text-align:left" required>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="btnActualizar" onclick="actualizarAreaProyecto()" class="btn btn-success"  type="button" class="btn btn-primary">Guardar</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
      </div>
  </body>
</html>