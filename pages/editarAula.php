<?php

include '../Datos/conexion.php';

$codigoAula = $_POST['codigoAula'];
$codigoEdificio = $_POST['codigoEdificio'];
$nombreAula = NULL;

$consulta = "SELECT * FROM ca_aulas WHERE codigo = " . $codigoAula;

if ($resultado = $conectar->query($consulta)) {

    while ($fila = $resultado->fetch_row()) 
    {
        $nombreAula = $fila[2];
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
                    $("#editarAulaForm").modal('hide');
                    //var pnombre = $("#titulo").val();
                    // alert(pnombre);
                    data = {
                        accion : 2,
                        codigoEdificio : <?php echo $codigoEdificio; ?>,
                        numeroAula : $("#nombreAula2").val(),
                        codigoAula : <?php echo $codigoAula; ?>
                    };
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        //contentType: "application/x-www-form-urlencoded",
                        //url: "Datos/insertarPOA.php",
                        //beforeSend: inicioEnvio,
                        success: llegadaActualizarAula,
                        //timeout: 4000,
                        //error: problemas
                    });
                    //limpiarCampos();
                    return false

                });
            });

            function llegadaActualizarAula()
            {
                $("#contenedor2").load('Datos/ca_gestionar_aulas.php', data);
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
        <input type="hidden" id="codigoAula" value="<?php echo $codigoAula; ?>">  
        <form role="form" id="form" name="form">
            <div class="form-group">
                <label>Número de aula</label>
                <input id="nombreAula2" class="form-control" value="<?php echo $nombreAula; ?>"  required="">
            </div>


            <div class="modal-footer">

                <button  id="guardar" class="btn btn-primary" >Guardar</button>

            </div>

        </form>
    </body>