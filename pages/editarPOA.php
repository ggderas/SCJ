<?php
$idPoa = $_POST['id'];
//echo $idPoa;
include '../Datos/conexion.php';

$titulo;
$del;
$al;
$observacion;

$consulta = "SELECT * FROM POA WHERE id_Poa=" . $idPoa;

if ($resultado = $conectar->query($consulta)) {

    while ($fila = $resultado->fetch_row()) {
        $titulo = $fila[1];
        $del = $fila[2];
        $al = $fila[3];
        $observacion = $fila[4];
    }
    $resultado->close();
}

$conectar->close();
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">

    <head>
        <meta charset="utf-8">
        <title></title>

        <link href="css/datepicker.css" rel="stylesheet">
        <link href="css/prettify.css" rel="stylesheet">
        <script src="js/prettify.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>

        <script>


            $(document).ready(function() {
                $("form").submit(function(e) {
                    e.preventDefault();
                    $("#editarPOA").modal('hide');
                    //var pnombre = $("#titulo").val();
                    // alert(pnombre);
                    data = {titulo: $("#titulo2").val(),
                        inicio: $("#dp24").val(),
                        idPOA: $("#idPOA").val(),
                        fin: $("#dp25").val(),
                        observacion: $("#observacion2").val()
                    };
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        //contentType: "application/x-www-form-urlencoded",
                        //url: "Datos/insertarPOA.php",
                        //beforeSend: inicioEnvio,
                        success: llegadaActualizarPOA,
                        //timeout: 4000,
                        //error: problemas
                    });
                    //limpiarCampos();
                    return false

                });
            });

            function llegadaActualizarPOA()
            {
                $("#contenedor2").load('Datos/actualizarPOA.php', data);
                //$('#editarPOA').modal('show');
            }
        </script>
        <script>
            if (top.location != location) {
                top.location.href = document.location.href;
            }
            $(function() {
                window.prettyPrint && prettyPrint();
                $('#dp24').datepicker({
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
                $('#dp25').datepicker({
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



    </head>

    <body>
        <input type="hidden" id="idPOA" value="<?php echo $idPoa; ?>">  
        <form role="form" id="form" name="form">
            <div class="form-group">
                <label>Titulo Del POA</label>
                <input id="titulo2" class="form-control" value="<?php echo $titulo; ?>"  required="">
            </div>
            <div class="form-group">
                <label for="dtp_input2" class="col-md-2 control-label">Del</label>
                <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-m-d" data-link-field="dtp_input2" data-link-format="yyyy-m-d">
                    <input type="text" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"
                           class="form-control" size="5"  id="dp24" value="<?php echo $del; ?>" required>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <label for="dtp_input2" class="col-md-2 control-label">Al</label>
                <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-m-d" data-link-field="dtp_input2" data-link-format="yyyy-m-d">
                    <input type="text"pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"
                           class="form-control" size="5"  id="dp25" value="<?php echo $al; ?>" required>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            <div class="form-group">
                <label>Observacion</label>
                <textarea id="observacion2" class="form-control" rows="3"><?php echo $observacion; ?></textarea>
            </div>


            <div class="modal-footer">

                <button  id="guardar" class="btn btn-primary" >Guardar</button>

            </div>

        </form>
    </body>