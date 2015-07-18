<?php
include '../../Datos/conexion.php'
?>

<?php
$GLOBALS['option'] = "";
$queryFacultades = mysql_query("SELECT * FROM ca_facultades");
while($row = mysql_fetch_assoc($queryFacultades)){
  $option .= ("<option value='".$row['codigo']."'>".$row['nombre']."</option>");
}
?>

<script type="text/javascript">
  $(document).ready(function() {
    $('#tabla_prioridad').dataTable({
      "order": [
        [0, "asc"]
      ],
      "destroy": true,
      "fnDrawCallback": function(oSettings) {


      },
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros por página",
        "zeroRecords": "No se han encontrado registros",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(Filtrado de _MAX_ registros)",
        "search": "Buscar",
        "paginate": {
          "previous": "Anterior",
          "next": "Siguiente"
        }
      }
    }); // example es el id de la tabla
  });
</script>
<!-- Script necesario para que la tabla se ajuste a el tamanio de la pag-->
<script type="text/javascript">
  // For demo to fit into DataTables site builder...
  $('#tabla_prioridad')
    .removeClass('display')
    .addClass('table table-striped table-bordered');
</script>
<link href="css/datepicker.css" rel="stylesheet">
<style>
  .container {
    background: #fff;
  }

  #alert {
    display: none;
  }
</style>
<link href="css/prettify.css" rel="stylesheet">
<script src="js/prettify.js"></script>
<script src="js/bootstrap-datepicker.js"></script>

<script>
  // $(document).on("click", ".ver", function() {
  //
  //   id = $(this).parents("tr").find("td").eq(0).html();
  //   //alert(id);
  //   data1 = {
  //     codigoEdificio: id
  //   };
  //   $.ajax({
  //     async: true,
  //     type: "POST",
  //     dataType: "html",
  //     contentType: "application/x-www-form-urlencoded",
  //     url: "pages/CargaAcademica/ca_crearAulas.php",
  //     beforeSend: inicioVer,
  //     success: llegadaVer,
  //     timeout: 4000,
  //     error: problemas
  //   });
  //   return false;
  //
  // });

  $(document).on("click", ".elimina", function() {
    var respuesta = confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
    if (respuesta) {
      id = $(this).parents("tr").find("td").eq(0).html();
      data = {
        nombreArea: null,
        accion: 3,
        codigoArea: id.trim(),
        codigoFacultad: null
      };
      $.ajax({
        async: true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        url: "Datos/ca_gestionar_areas_vinculacion.php",
        beforeSend: inicioEliminar,
        success: llegadaEliminar,
        timeout: 4000,
        error: problemas
      });
      return false;
    }
  });
  $(document).on("click", ".editar", function() {
    id = $(this).parents("tr").find("td").eq(0).html();
    alert(id.trim());
    data4 = {
      nombreArea: null,
      accion: 2,
      codigoArea: id.trim(),
      codigoFacultad: null
    };
    $.ajax({
      async: true,
      type: "POST",
      dataType: "html",
      contentType: "application/x-www-form-urlencoded",
      url: "Datos/ca_gestionar_areas_vinculacion.php",
      //beforeSend: inicioEliminar,
      success: llegadaEditarArea,
      timeout: 4000,
      error: problemas
    });
    return false;
  });



  $(document).ready(function() {
    $("form").submit(function(e) {
      e.preventDefault();
      $("#agregarArea").modal('hide');
      data2 = {
        codigoArea: $("#codigoArea").val(),
        nombreArea: $("#nombreArea").val(),
        codigoFacultad: $("#facultad").val(),
        accion: 1
      };
      $.ajax({
        async: true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        url: "Datos/ca_gestionar_areas_vinculacion.php",
        beforeSend: inicioEnvio,
        success: llegadaGuardar,
        timeout: 4000,
        error: problemas
      });
      limpiarCampos();
      return false;
    });
  });

  function inicioVer() {
    var x = $("#contenedor");
    x.html('Cargando...');
  }

  function inicioEliminar() {
    var x = $("#contenedor2");
    x.html('Cargando...');
  }

  function inicioEnvio() {
    var x = $("#contenedor2");
    x.html('Cargando...');
  }

  function llegadaEditarArea() {
    $("#cuerpoEditar").load('pages/editarAreaVinculacion.php', data4);
    $('#editarAreaVinculacion').modal('show');
  }

  function llegadaEliminar() {
    $("#contenedor2").load('Datos/ca_gestionar_areas_vinculacion.php', data);
  }

  function llegadaGuardar() {
    $("#contenedor2").load('Datos/ca_gestionar_areas_vinculacion.php', data2);
  }

  function problemas() {
    $("#contenedor2").text('Problemas en el servidor.');
  }

  function limpiarCampos() {
    $("#nombreArea").val('');
  }
</script>
<!--        <script>
            if (top.location != location) {
                top.location.href = document.location.href;
            }
            $(function () {
                window.prettyPrint && prettyPrint();
                $('#dp1').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayBtn: true
                }).on('show', function () {
                    // Obtener valores actuales z-index de cada elemento
                    var zIndexModal = $('#myModal').css('z-index');
                    var zIndexFecha = $('.datepicker').css('z-index');
                    //alert(zIndexModal + zIndexFEcha);
                    $('.datepicker').css('z-index', zIndexModal + 1);
                });
                $('#dp2').datepicker({
                    language: "es",
                    format: 'yyyy-mm-dd'
                });
                $('#dp3').datepicker();
                $('#dp3').datepicker();
                $('#dpYears').datepicker();
                $('#dpMonths').datepicker();
                // disabling dates
                var nowTemp = new Date();
                var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
                var checkin = $('#dpd1').datepicker({
                    onRender: function (date) {
                        return date.valueOf() < now.valueOf() ? 'disabled' : '';
                    }
                }).on('changeDate', function (ev) {
                    if (ev.date.valueOf() > checkout.date.valueOf()) {
                        var newDate = new Date(ev.date)
                        newDate.setDate(newDate.getDate() + 1);
                        checkout.setValue(newDate);
                    }
                    checkin.hide();
                    $('#dpd2')[0].focus();
                }).data('datepicker');
                var checkout = $('#dpd2').datepicker({
                    onRender: function (date) {
                        return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                    }
                }).on('changeDate', function (ev) {
                    checkout.hide();
                }).data('datepicker');
            });
        </script>-->

</script>
<script type="text/javascript">
  _uacct = "UA-106117-1";
  urchinTracker();
</script>

<body>
  <div class="row">
    <div class="panel-body">
      <div class="panel panel-default">
        <div class="panel-body">
          <button class="btn btn-success" data-toggle="modal" data-target="#agregarArea"> Nueva Área de Vinculación</button>
        </div>
      </div>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h4 class="panel-title">
            <label>Áreas de Vinculación</label>
          </h4>
        </div>
        <div>
          <div id="contenedor2" class="panel-body">
            <?php
              include '../../Datos/ca_cargarAreaVinculacion.php';
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="agregarArea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form role="form" id="form" name="form">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel"> Nueva Área de Vinculación</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="control-label">
                <span class="glyphicon glyphicon-exclamation-sign" pattern="[0-9]+" aria-hidden="true"></span> Código Área</label>
              <input id="codigoArea" class="form-control col-sm-9" required="" onblur="validar()">
            </div>
            <div class="form-group">
              <label class="control-label">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Nombre Área</label>
              <input id="nombreArea" class="form-control col-sm-9" required="" onblur="validar()">
            </div>
            <div class="form-group">
              <label class="control-label">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Facultad</label>
              <select class="form-control" id="facultad" name="facultad">
                <?php
                echo $option;
                ?>
              </select>
            </div>
            <div id="noti1" class="alert alert-info" role="alert">IMPORTANTE: Los campos marcados con el signo
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> son obligatorios.</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button id="guardar" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="editarAreaVinculacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Editar Área de Vinculación</h4>
        </div>
        <div class="modal-body" id="cuerpoEditar">
        </div>
      </div>
    </div>
  </div>
</body>
