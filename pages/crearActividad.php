<?php
$id = $_POST['ide'];
session_start();
$inicioPoa = $_SESSION['inicio_Poa'];
$finPoa = $_SESSION['fin_Poa'];

include '../Datos/conexion.php';
$query = mysql_query("SELECT indicadores.nombre as ind,objetivos_institucionales.definicion as obj,objetivos_institucionales.id_Objetivo as idObj,poa.nombre as poa,poa.id_Poa as idPoa FROM indicadores inner join objetivos_institucionales on indicadores.id_ObjetivosInsitucionales = objetivos_institucionales.id_Objetivo inner join poa on objetivos_institucionales.id_Poa=poa.id_Poa where indicadores.id_Indicadores='" . $id . "'", $enlace);
while ($row = mysql_fetch_array($query)) {
    $objetivo = $row['obj'];
    $indicador = $row['ind'];
    $poa = $row['poa'];
    $idObj = $row['idObj'];
    $idPoa = $row['idPoa'];
    //$idObj=$row['id_Objetivo'];
}
?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">

    <head>
        <meta charset="utf-8">c
            <script type="text/javascript">

        $(document).ready(function () {
            $('#tabla_prioridad').dataTable({
                "order": [[0, "asc"]],
                "fnDrawCallback": function (oSettings) {


                }
                ,
                "language":
                {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se han encontrado registros",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(Filtrado de _MAX_ registros)"   ,
                    "search": "Buscar",
                    "paginate":
                            {
                                "previous": "Anterior",
                                "next" : "Siguiente"
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



$(document).on("click","#retonoPOA",function () {
    
   

                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        //url:"pages/crearPOA.php",    
                        // url:"../cargarPOAs.php",  
                        //beforeSend:inicioEnvio,
                        success: llegadaCrear,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;
               

                

    
    
});

function llegadaCrear()
                {
                    $("#contenedor").load('pages/crearPOA.php');
                    //$("#contenedor").load('../cargarPOAs.php');
                }

$(document).on("click","#retonoOBJ",function () {
    
    
                    //id = $(this).parents("tr").find("td").eq(0).html();
                    //alert(id);
                    id = $("#idPoa").val();
                    data1 = {ide: id};
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        //url: "pages/crearObjetivo.php",
                        //beforeSend: inicioVer,
                        success: llegadaRetornoObj,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;
              
                

    
    
});

function llegadaRetornoObj()
                {
                    $("#contenedor").load('pages/crearObjetivo.php', data1);
                }
$(document).on("click","#retonoIND",function () {
    
 
                    //id1 = $(this).parents("tr").find("td").eq(0).html();
                    // alert(id1); 
                    id1 = $("#idObj").val();
                    data1 = {ide: id1};
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        //url: "pages/crearIndicador.php",
                        //beforeSend: inicioVer,
                        success: llegadaRetornoInd,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;
                


              
    
    
});

  function llegadaRetornoInd()
                {
                    $("#contenedor").load('pages/crearIndicador.php', data1);
                }

$(document).on("click",".verActividad",function () {
    
  
                    id2 = $(this).parents("tr").find("td").eq(0).html();
                    idInd = $("#idInd").val();
                    //alert(id);      
                    data2 = {ide: id2, idInd: idInd};
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                       // url: "pages/actividad.php",
                        beforeSend: inicioVer,
                        success: llegadaVer,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;
              
    
    
});


$(document).on("click",".eliminarActividad",function () {
   
   
                    var respuesta = confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
                    if (respuesta)
                    {
                        idac = $(this).parents("tr").find("td").eq(0).html();
                        data3 = {idActividad: idac, idIndice: $("#idInd").val()};
                        $.ajax({
                            async: true,
                            type: "POST",
                            dataType: "html",
                            contentType: "application/x-www-form-urlencoded",
                            //url: "Datos/eliminarActividad.php",
                            beforeSend: inicioEliminar,
                            success: llegadaEliminar,
                            timeout: 4000,
                            error: problemas
                        });
                        return false;
                    }
                
    
    
    
});



$(document).on("click",".editarActividad",function () {
    



                    id56 = $(this).parents("tr").find("td").eq(0).html();
                    // alert(id);      
                    data70 = {idAct: id56,
                        idInd: $('#idInd').val()
                    };
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        //: "application/x-www-form-urlencoded",
                        //url: "pages/editarPOA.php",
                        //beforeSend: inicioEliminar,
                        success: llegadaEditarActividad,
                        timeout: 4000,
                        error: problemas
                    });
                    return false;

               
    
    
});



            $(document).ready(function () {


                $("#form5").submit(function (e) {
                    e.preventDefault();

                    inicioP = document.getElementById('inicioPOA').value;
                    finalP = document.getElementById('finPOA').value;

                    inicioA = document.getElementById('dp1').value;
                    finalA = document.getElementById('dp2').value;
                    inicioA = new Date(inicioA);
                    finalA = new Date(finalA);
                    inicioP = new Date(inicioP);
                    finalP = new Date(finalP);
                    if (inicioA > finalA || inicioA < inicioP || finalA > finalP) {
                        alert("La fecha de inicio y fin del POA son " + document.getElementById('inicioPOA').value
                              + " y " + document.getElementById('finPOA').value 
                              + " correspondiente. Las actividades deben de estar dentro de esas fechas.");
                    } else {




                        $("#myModal").modal('hide');

                        data = {act: $("#act").val(),
                            cor: $("#cor").val(),
                            sup: $("#sup").val(),
                            jus: $("#jus").val(),
                            ver: $("#ver").val(),
                            pob: $("#pob").val(),
                            inicio: $("#dp1").val(),
                            fin: $("#dp2").val(),
                            id: $("#idInd").val()
                        };
                        $.ajax({
                            async: true,
                            type: "POST",
                            dataType: "html",
                            contentType: "application/x-www-form-urlencoded",
                            url: "Datos/insertarActividad.php",
                            beforeSend: inicioEnvio,
                            success: llegadaGuardar,
                            timeout: 4000,
                            error: problemas
                        });


                        //limpiarCamposActividad();
                        return false;




                    }

                });

            });



            function llegadaEditarActividad()
            {
                $("#cuerpoEditarActividad").load('pages/editarActividad.php', data70);
                $('#editarActividad').modal('show');
            }


            function inicioVer()
            {
                var x = $("#contenedor");
                x.html('Cargando...');
            }

            function inicioEliminar()
            {
                var x = $("#contenedor2");
                x.html('Cargando...');
            }

            function inicioEnvio()
            {
                var x = $("#contenedor2");
                x.html('Cargando...');
            }

            function llegadaVer()
            {
                $("#contenedor").load('pages/actividad.php', data2);
            }

            function llegadaEliminar()
            {
                $("#contenedor2").load('Datos/eliminarActividad.php', data3);
            }

            function llegadaGuardar()
            {
                $("#contenedor2").load('Datos/insertarActividad.php', data);
            }

            function problemas()
            {
                $("#contenedor2").text('Problemas en el servidor.');
            }


        </script>
        <script>
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


                var startDate = new Date(2012, 1, 20);
                var endDate = new Date(2012, 1, 25);
                $('#dp4').datepicker()
                        .on('changeDate', function (ev) {
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
                        .on('changeDate', function (ev) {
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
        </script>

    </script>
    <script type="text/javascript">
        _uacct = "UA-106117-1";
        urchinTracker();
    </script>






</head> 
<body>
    <input type="hidden" id="inicioPOA" value="<?php echo $inicioPoa; ?>"> 
    <input type="hidden" id="finPOA" value="<?php echo $finPoa; ?>"> 
    <input type="hidden" id="idInd" value="<?php echo $id; ?>">  
    <input type="hidden" id="idObj" value="<?php echo $idObj; ?>">  
    <input type="hidden" id="idPoa" value="<?php echo $idPoa; ?>">  
    <div class="col-lg-12">




        <div class="panel panel-default">
            <a id="retonoPOA" href="#"><i class="fa fa-table fa-fw"></i>POA:<strong> <?php echo " " . $poa; ?></strong></a>
            <a id="retonoOBJ" href="#"><i class="fa fa-table fa-fw"></i>OBJETIVO:<strong> <?php echo " " . $objetivo; ?> </strong></a>
            <a id="retonoIND" href="#"><i class="fa fa-table fa-fw"></i>INDICADOR:<strong> <?php echo " " . $indicador; ?> </strong></a>

        </div>




        
            <div class="panel panel-default">
                <button class="btn btn-success" data-toggle="modal" data-target="#myModal">
                    Nueva Actividad
                </button>
            </div> 
       

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <label >Mis Actividades</label>
                </h4>
            </div>
            <div >
                <div id="contenedor2" class="panel-body">
                    <?php
                    //include '../Datos/cargarIndicadores.php'; 
//include '../Datos/conexion.php';
// aqui falta aplicar el filtro para que solo carge los indicadores de un solo objetivo
                    $query = mysql_query("SELECT * FROM actividades where id_indicador='" . $id . "'", $enlace);
                    ?>


                    <div class="box-body table-responsive">
                        <table id="tabla_prioridad" class='table table-bordered table-striped'>
                            <thead>
                                <tr>  
                                    <th>Id</th>
                                    <th>Actividad</th>
                                    <th>Fecha Inicio  </th> 
                                    <th>Fecha Fin</th> 
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysql_fetch_array($query)) {
                                    $id = $row['id_actividad'];
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id_actividad'] ?></td>
                                        <td><div class="text" id="nombre-<?php echo $id ?>"><?php echo $row['descripcion'] ?></div></td>
                                        <td><div class="text" id="descripcion-<?php echo $id ?>"><?php echo $row['fecha_inicio'] ?></div></td> 
                                        <td><div class="text" id="descripcion-<?php echo $id ?>"><?php echo $row['fecha_fin'] ?></div></td> 

                                        <td><a class="verActividad btn btn-success  fa fa-arrow-right "></a>
                                            <a class="editarActividad btn btn-info fa fa-pencil "></a>
                                            <a class="eliminarActividad   btn btn-danger fa fa-trash-o"></a>
                                        </td>

                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->










                </div>
            </div>
        </div> 

    </div>





    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Nueva Actividad</h4>
                </div>
                <div class="modal-body">

                    <form role='form5' name="form5" id="form5">


                        <div class="form-group">
                            <label>Descripcion Actividad</label>
                            <textarea id="act" class="form-control" rows="1"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="dtp_input2" class="col-md-2 control-label">Del</label>
                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-m-d" data-link-field="dtp_input2" data-link-format="yyyy-m-d">
                                <input type="text" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" placeholder="Ingrese una fecha"
                                       class="form-control" size="5"  id="dp1" required>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <label for="dtp_input2" class="col-md-2 control-label">Al</label>
                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-m-d" data-link-field="dtp_input2" data-link-format="yyyy-m-d">
                                <input type="text" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" placeholder="Ingrese una fecha"
                                       class="form-control" size="5"  id="dp2" required>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <input type="hidden" id="dtp_input2" value="" /><br/>
                        </div>
                        <div class="form-group">
                            <label>Correlativo</label>
                            <textarea id="cor" class="form-control" rows="1"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Supuesto</label>
                            <textarea id="sup" class="form-control" rows="1"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Justificacion</label>
                            <textarea id="jus" class="form-control" rows="1"></textarea>
                        </div> 
                        <div class="form-group">
                            <label>Medio De Verificacion</label>
                            <textarea id="ver" class="form-control" rows="1"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Poblacion Objetivo</label>
                            <textarea id="pob" class="form-control" rows="1"></textarea>
                        </div>



                        <div class="modal-footer">
                            <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" >Guardar</button>
                        </div>

                    </form>

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>  





    <div class="modal fade" id="editarActividad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Editar Una Actividad</h4>
                </div>
                <div class="modal-body" id="cuerpoEditarActividad">

                </div>

            </div>
        </div>

    </div> 




</body>
</html>

