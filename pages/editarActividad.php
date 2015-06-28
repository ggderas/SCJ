<?php

$idAct = $_POST['idAct'];
$idInd = $_POST['idInd'];

//echo $idAct."  ".$idInd;


include '../Datos/conexion.php';

$nombre;
$corr;
$pues;
$just;
$medio;
$pob;
$inicio;
$fin;
$consulta = "SELECT * FROM actividades WHERE id_actividad=" . $idAct;

if ($resultado = $conectar->query($consulta)) {

    while ($fila = $resultado->fetch_row()) {
        $nombre = $fila[2];
        $corr = $fila[3];
        $pues = $fila[4];
        $just = $fila[5];
        $medio = $fila[6];
        $pob = $fila[7];
        $inicio = $fila[8];
        $fin = $fila[9];
    }
    $resultado->close();
}
?>



<script>
$(document).ready(function() {

                $("#form7").submit(function(e) {
                    e.preventDefault();
                    $("#editarActividad").modal('hide');
                    
                data = {act: $("#actA").val(),
                    cor: $("#corA").val(),
                    sup: $("#supAaa").val(),
                    jus: $("#jusA").val(),
                    ver: $("#verA").val(),
                    pob: $("#pobA").val(),
                    inicio: $("#dp1A").val(),
                    fin: $("#dp2A").val(),
                    idInd: $("#idIndA").val(),
                    idAct: $("#idAct").val()
                };
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    //contentType: "application/x-www-form-urlencoded",
                    //url: "Datos/insertarActividad.php",
                    //beforeSend: inicioEnvio,
                    success: llegadaActualizarActividad,
                    timeout: 4000,
                    error: problemasActividad
                });
               

                    //limpiarCamposActividad();
                    return false;

                });
            });
            
             function problemasActividad()
            {
                $("#contenedor2").text('Problemas en el servidor.');
                //$('#editarPOA').modal('show');
            }
            function llegadaActualizarActividad()
            {
                $("#contenedor2").load('Datos/actualizarActividad.php', data);
                 
                //$('#editarPOA').modal('show');
            }




</script>


<script>
            if (top.location != location) {
                top.location.href = document.location.href;
            }
            $(function() {
                window.prettyPrint && prettyPrint();
                $('#dp1A').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayBtn: true
                   
                }).on('show', function() {
                    // Obtener valores actuales z-index de cada elemento
                    var zIndexModal = $('#myModal').css('z-index');
                    var zIndexFecha = $('.datepicker').css('z-index');
                    //alert(zIndexModal + zIndexFEcha);
                    $('.datepicker').css('z-index', zIndexModal + 1);
                });
                $('#dp2A').datepicker({
                    language: "es",
                    format: 'yyyy-mm-dd'
                });
                $('#dp3').datepicker();
                $('#dp3').datepicker();
                $('#dpYears').datepicker();
                $('#dpMonths').datepicker();


                var startDate = new Date(2012, 1, 20);
                var endDate = new Date(2012, 1, 25);
                $('#dp4').datepicker()
                        .on('changeDate', function(ev) {
                            if (ev.date.valueOf() > endDate.valueOf()) {
                                $('#alert').show().find('strong').text('The start date can not be greater then the end date');
                            } else {
                                $('#alert').hide();
                                startDate = new Date(ev.date);
                                $('#startDate').text($('#dp4').data('date'));
                            }
                            $('#dp4').datepicker('hide');
                        });
                $('#dp5').datepicker()
                        .on('changeDate', function(ev) {
                            if (ev.date.valueOf() < startDate.valueOf()) {
                                $('#alert').show().find('strong').text('The end date can not be less then the start date');
                            } else {
                                $('#alert').hide();
                                endDate = new Date(ev.date);
                                $('#endDate').text($('#dp5').data('date'));
                            }
                            $('#dp5').datepicker('hide');
                        });

                // disabling dates
                var nowTemp = new Date();
                var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

                var checkin = $('#dpd1').datepicker({
                    onRender: function(date) {
                        return date.valueOf() < now.valueOf() ? 'disabled' : '';
                    }
                }).on('changeDate', function(ev) {
                    if (ev.date.valueOf() > checkout.date.valueOf()) {
                        var newDate = new Date(ev.date)
                        newDate.setDate(newDate.getDate() + 1);
                        checkout.setValue(newDate);
                    }
                    checkin.hide();
                    $('#dpd2')[0].focus();
                }).data('datepicker');
                var checkout = $('#dpd2').datepicker({
                    onRender: function(date) {
                        return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                    }
                }).on('changeDate', function(ev) {
                    checkout.hide();
                }).data('datepicker');
            });
        </script>




<form role='form7' name="form7" id="form7">
         <input type="hidden" id="idIndA" value="<?php echo $idInd; ?>"> 
          <input type="hidden" id="idAct" value="<?php echo $idAct; ?>">  

                    <div class="form-group">
                        <label>Descripcion Actividad</label>
                        <textarea id="actA" class="form-control" rows="1"> <?php echo $nombre; ?></textarea>
                    </div>
                        <div class="form-group">
                        <label for="dtp_input2" class="col-md-2 control-label">Del</label>
                        <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-m-d" data-link-field="dtp_input2" data-link-format="yyyy-m-d">
                            <input type="text" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" placeholder="Ingrese una fecha" 
                                   class="form-control" size="5"  id="dp1A" value="<?php echo $inicio; ?>" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        <label for="dtp_input2" class="col-md-2 control-label">Al</label>
                        <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-m-d" data-link-field="dtp_input2" data-link-format="yyyy-m-d">
                            <input type="text" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" placeholder="Ingrese una fecha"
                                   class="form-control" size="5"  id="dp2A" value="<?php echo $fin; ?>" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label>Correlativo</label>
                        <textarea id="corA" class="form-control" required="" rows="1"><?php echo $corr; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Supuesto</label>
                        <textarea id="supAaa" class="form-control" required="" rows="1"><?php echo $pues; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Justificacion</label>
                        <textarea id="jusA" class="form-control" required="" rows="1"><?php echo $just; ?></textarea>
                    </div> 
                    <div class="form-group">
                        <label>Medio De Verificacion</label>
                        <textarea id="verA" class="form-control" required="" rows="1"><?php echo $medio; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Poblacion Objetivo</label>
                        <textarea id="pobA" class="form-control"  rows="1"><?php echo $pob; ?></textarea>
                    </div>

                    
                        
                        <div class="modal-footer">
                    <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" >Guardar</button>
                </div>
                        
                    </form>