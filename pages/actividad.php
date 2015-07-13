<?php
$idAct = $_POST['ide'];
//$idInd=$_POST['idInd'];
$idInd;
session_start();
 
include '../Datos/conexion.php';


//verifica si la actividad ya fue terminadad

?>

<!DOCTYPE html>
<html lang="es">

    <head>



        <script>

            if (top.location != location) {
                top.location.href = document.location.href;
            }
            $(function() {
                window.prettyPrint && prettyPrint();
                $('#dp1').datepicker({
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


                var startDate = new Date(2012, 1, 20);
                var endDate = new Date(2012, 1, 25);


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
<?php

$consulta24 = "SELECT * FROM actividades_terminadas where id_Actividad='" . $idAct . "'";

                        if ($resultado24 = $conectar->query($consulta24)) {
                            
                            if (!$fila24 = $resultado24->fetch_row()) {

?>

        
        
        <div class="row">
<div class="panel panel-default">
                   <a id="retonoAct" href="#"><i class="fa fa-table fa-fw"></i><strong> Mis Actividades </strong></a>

                </div>
            <div class="col-lg-14">
                <div class="panel-default">
                    <div class="panel-heading">
                        <?php
                        $consulta = "SELECT * FROM actividades where id_actividad='" . $idAct . "'";

                        if ($resultado = $conectar->query($consulta)) {
                            $fila = $resultado->fetch_row()
                            
                            ?>
                            <h2><strong> Correlativo: </strong><?php echo $fila[3] ?>  <strong> Actividad:</strong> <?php echo $fila[2] ?></h2>
                        </div>
                        <div class="panel-body">


                            <div class="col-lg-4">
                                <table>


                                    <tr>
                                        <td><strong> Supuesto:  </strong></td>
                                        <td><?php $idInd=$fila[1]; echo $fila[4] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong> Justificacion:  </strong></td>
                                        <td><?php echo $fila[5] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong> Medio de Verificacion:  </strong>  </td>
                                        <td>  <?php echo $fila[6] ?></td>
                                    </tr>
                                </table>

                            </div>           
                            <div class="col-lg-4">
                                <table>
                                    <tr>
                                        <td><strong> Poblacion Objetivo:  </strong></td>
                                        <td><?php echo $fila[7] ?></td> 
                                    </tr>
                                    <tr>
                                        <td><strong> Fecha De Inicio:   </strong></td>
                                        <td><?php $_SESSION['iniAct']=$fila[8]; echo $fila[8] ?></td>
                                        <input type="hidden" id="iniAct" value="<?php echo $_SESSION["iniAct"]; ?>"> 
        
                                    <tr>
                                        <td><strong> Fecha de Fin:   </strong></td>
                                        <td><?php $_SESSION['finAct']=$fila[9]; echo $fila[9] ?></td>
                                        <input type="hidden" id="finAct" value="<?php echo $_SESSION["finAct"]; ?>"> 
                                        <input type="hidden" id="idAct" value="<?php echo $idAct; ?>">
                                        <input type="hidden" id="idInd" value="<?php echo $idInd; ?>"> 
                                    </tr>
                                </table> 
                            </div>

                            <div class="col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Estadisticas
                                    </div>
                                    <div class="panel-body">

                                    </div>
                                </div>
                            </div>



                            <?php
                            $resultado->close();
                        }

//$conectar->close();
                        ?>

                        <div class="col-lg-12">

                            <?php
                            $consulta2 = "SELECT * FROM actividades_terminadas where id_Actividad=" . $idAct;

                            if ($resultado2 = $conectar->query($consulta2)) {


                                if ($fila2 = $resultado2->fetch_row()) {

                                    $fecha = $fila2[2];
                                    $obs = $fila2[3];
                                    //echo $fecha;
                                    ?>

                                    <div class="panel-default">
                                        <div class="panel-heading">
                                            Esta Actividada Ya Se Dio por Realizada
                                        </div>
                                        <div class="panel-body">
                                            <div>
                                                <strong>Fecha de Realización:  </strong> <?php echo $fecha; ?>
                                            </div>
                                            <div>
                                                <strong>Observación:  </strong> <?php echo $obs; ?>
                                            </div>
                                        </div>

                                    </div> 



                                    <?php
                                } else {
                                    ?>

                                    <div class="panel-default">
                                        <div class="panel-heading">
                                            Dar Actividad Por Realizada 
                                        </div>
                                        <div class="panel-body">
                                            <div>
                                                <button id="finalizarActividad" type="button" class="btn btn-success "><i class="fa fa-check"></i>
                                                </button>
                                            </div>
                                            <div>
                                                haciendo click podras dar por finalizada esta Actividad
                                            </div>
                                        </div>

                                    </div>



                                    <?php
                                }
                            }
                            ?>

                        </div>

                    </div>
                </div>
            </div>









            <div class="col-lg-7">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Costos De Actividad
                    </div>
                    <div class="panel-body">
                        <div class="panel-default ">
                            <button id="asignarCostoActividad" class="btn btn-success fa fa-file ">
                                Agregar Costo de Actividad
                            </button>                       
                        </div>
                        <div id="costosActividad" class="panel-default">

                            <table class="table">
                                <thead>
                                <th>ID</th>
                                <th>Costo</th>
                                <th>Porcentaje</th>
                                <th>Trimestre</th>
                                <th>Observacion</th>
                                <th></th>
                                </thead>

                                <?php
                                $consulta3 = "SELECT * FROM costo_porcentaje_actividad_por_trimestre  where id_Actividad=" . $idAct;
                                $nombre;
                                if ($resultado3 = $conectar->query($consulta3)) {

                                    while ($fila3 = $resultado3->fetch_row()) {
                                        ?>



                                        <tr>
                                            <td><?php echo $fila3[0] ?></td>
                                            <td><?php echo $fila3[2] ?></td>
                                            <td><?php echo $fila3[3] ?></td>
                                            <td><?php echo $fila3[5] ?></td>
                                            <td><?php echo $fila3[4] ?></td>

                                            <td>
                                                <a class="editar btn btn-info fa fa-pencil "></a>

                                            </td>

                                        </tr>

                                        <?php
                                    }
                                    $resultado3->close();
                                }

//$conectar->close();
                                ?>
                            </table>

                        </div>
                    </div>
                </div>
            </div>











            <div class="col-lg-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Responsable  de Actividad
                    </div>
                    <div class="panel-body">
                        <div class="panel-default ">
                            <button class="btn btn-success fa fa-file" data-toggle="modal" data-target="#myModal">
                                Asignar Responsable
                            </button>                        
                        </div>
                        <div id="responsables" class="panel-default">

                            <table class="table">
                                <thead>
                                <th></th>
                                </thead>

                                <?php
                                $consulta2 = "SELECT * FROM responsables_por_actividad inner join grupo_o_comite on responsables_por_actividad.id_Responsable=grupo_o_comite.ID_Grupo_o_comite where responsables_por_actividad.id_Actividad=" . $idAct;

                                if ($resultado2 = $conectar->query($consulta2)) {

                                    while ($fila2 = $resultado2->fetch_row()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $fila2[6] ?></td>
                                            <td> <a class="elimina btn btn-danger fa fa-trash-o"></a></td>
                                        </tr>                     

                                        <?php
                                    }
                                    $resultado2->close();
                                }

//$conectar->close();
                                ?>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Sub Actividades
                    </div>
                    <div class="panel-body">
                        <div class="panel-default ">
                            <button id="asignarSubActividad" class="btn btn-success fa fa-file ">
                                Asignar Sub Actividades
                            </button>                        
                        </div>




                        <div id="subActividades" class="panel-default">

                            <table class="table">
                                <thead>
                                <th>ID</th>
                                <th>SubActividad</th>
                                <th>Encargado</th>
                                <th>Fecha Monitoreo</th>
                                <th></th>
                                </thead>

                                <?php
                                $consulta3 = "SELECT * FROM sub_actividad  where idActividad=" . $idAct;
                                $nombre;
                                if ($resultado3 = $conectar->query($consulta3)) {

                                    while ($fila3 = $resultado3->fetch_row()) {
                                        $consulta4 = "SELECT * FROM persona where N_identidad in(select N_identidad FROM empleado where No_Empleado='" . $fila3[5] . "')";
                                        if ($resultado4 = $conectar->query($consulta4)) {
                                            $fila4 = $resultado4->fetch_row();
                                            $nombre = $fila4[1] . " " . $fila4[2] . " " . $fila4[3] . " " . $fila4[4];


                                            $resultado4->close();
                                        }
                                        ?>



                                        <tr>
                                            <td><?php echo $fila3[0] ?></td>
                                            <td><?php echo $fila3[2] ?></td>
                                            <td><?php echo $nombre ?></td>
                                            <td><?php echo $fila3[4] ?></td>

                                            <td><a class="verSubActividad btn btn-success  fa fa-arrow-right "></a>
                                                <a class="editarSubActividad btn btn-info fa fa-pencil "></a>
                                                <a class="eliminaSubActividad btn btn-danger fa fa-trash-o"></a>
                                            </td>

                                        </tr>

                                        <?php
                                    }
                                    $resultado3->close();
                                }

                                $conectar->close();
                                ?>
                            </table>
                            <div id="nuevaSub"></div>
                        </div>




                    </div>
                </div>
            </div>


        </div>


        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Agregar Responsable</h4>
                    </div>
                    <div class="modal-body">

                        <form role='form' name="form" id="form">


                            <div class="form-group">
                                <label>Grupo o Comite </label>
                                <select id="grupo" class="form-control">
                                    <option value="0">Seleccione..</option>



                                    <?php
                                    $query = mysql_query("SELECT * FROM grupo_o_comite", $enlace);
                                    while ($row = mysql_fetch_array($query)) {
                                        $idgrupo = $row['ID_Grupo_o_comite'];
                                        $nombre = $row['Nombre_Grupo_o_comite'];
                                        ?>
                                        <option value="<?php echo $idgrupo; ?>"><?php echo $nombre; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Observacion</label>
                                <textarea id="observacionres" class="form-control" rows="3"></textarea>
                            </div>



                            <div class="modal-footer">
                                <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button class="btn btn-primary">Guardar</button>
                            </div>

                        </form>


                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>


        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Agregar Sub Actividad</h4>
                    </div>
                    <div class="modal-body" id="myModal2body">



                    </div>

                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>


        <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Costos de Actividad</h4>
                    </div>
                    <div class="modal-body" id="myModal3body">



                    </div>

                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
        
       
        
        
        <div class="modal fade" id="actividadRealizada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Finalizar  Actividad</h4>
                </div>
                <div class="modal-body" id="cuerpoActividadRealizada">
                    
                </div>

            </div>
        </div>

    </div> 
<?php
                        }
                        
                        
                        else {
?>

   
         
        <div class="row">
<div class="panel panel-default">
                   <a id="retonoAct" href="#"><i class="fa fa-table fa-fw"></i><strong> Mis Actividades </strong></a>

                </div>
            <div class="col-lg-14">
                <div class="panel-default">
                    <div class="panel-heading">
                        <?php
                        $consulta = "SELECT * FROM actividades where id_actividad='" . $idAct . "'";

                        if ($resultado = $conectar->query($consulta)) {
                            $fila = $resultado->fetch_row()
                            ?>
                            <h2><strong> Correlativo: </strong><?php echo $fila[3] ?>  <strong> Actividad:</strong> <?php echo $fila[2] ?></h2>
                        </div>
                        <div class="panel-body">


                            <div class="col-lg-4">
                                <table>


                                    <tr>
                                        <td><strong> Supuesto:  </strong></td>
                                        <td><?php echo $fila[4] ?></td>
                                        
                                        <input type="hidden" id="idAct" value="<?php echo $idAct; ?>">
                                        <input type="hidden" id="idInd" value="<?php echo $fila[1]; ?>">
                                    </tr>
                                    <tr>
                                        <td><strong> Justificacion:  </strong></td>
                                        <td><?php echo $fila[5] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong> Medio de Verificacion:  </strong>  </td>
                                        <td>  <?php echo $fila[6] ?></td>
                                    </tr>
                                </table>

                            </div>           
                            <div class="col-lg-4">
                                <table>
                                    <tr>
                                        <td><strong> Poblacion Objetivo:  </strong></td>
                                        <td><?php echo $fila[7] ?></td> 
                                    </tr>
                                    <tr>
                                        <td><strong> Fecha De Inicio:   </strong></td>
                                        <td><?php echo $fila[8] ?></td>
                                    <tr>
                                        <td><strong> Fecha de Fin:   </strong></td>
                                        <td><?php echo $fila[9] ?></td>
                                    </tr>
                                </table> 
                            </div>

                            <div class="col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Estadisticas
                                    </div>
                                    <div class="panel-body">

                                    </div>
                                </div>
                            </div>



                            <?php
                            $resultado->close();
                        }

//$conectar->close();
                        ?>

                        <div class="col-lg-12">

                                    <?php
            $consulta2 = "SELECT * FROM actividades_terminadas where id_Actividad=". $idAct;

            if ($resultado2 = $conectar->query($consulta2)) {
                
                
                if($fila2 = $resultado2->fetch_row()){

                $fecha = $fila2[2] ;
                $estado = $fila2[3] ;
                $usuario=$fila2[4] ;
                $obs = $fila2[5] ;
                //echo $fecha;
                ?>
            
                <div class="panel-default">
                    <div class="panel-heading">
                        Esta Sub Actividada Ya Se Dio por Realizada
                    </div>
                    <div class="panel-body">
                        <div>
                            <strong>Fecha de Realización:  </strong> <?php echo $fecha;?>
                        </div>
                        <div>
                            <strong>Estado:  </strong> <?php echo $estado;?>
                        </div>
                        <div>
                            <strong>Usuario:  </strong> <?php echo $usuario;?>
                        </div>
                        
                        <div>
                            <strong>Observación:  </strong> <?php echo $obs;?>
                        </div>
                    </div>

                </div> 



                                    <?php
                                }
                            }
                            ?>

                        </div>

                    </div>
                </div>
            </div>









            <div class="col-lg-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Costos De Actividad
                    </div>
                    <div class="panel-body">
                        
                        <div id="costosActividad" class="panel-default">

                            <table class="table">
                                <thead>
                                <th>ID</th>
                                <th>Costo</th>
                                <th>Porcentaje</th>
                                <th>Trimestre</th>
                                <th>Observacion</th>
                                <th></th>
                                </thead>

                                <?php
                                $consulta3 = "SELECT * FROM costo_porcentaje_actividad_por_trimestre  where id_Actividad=" . $idAct;
                                $nombre;
                                if ($resultado3 = $conectar->query($consulta3)) {

                                    while ($fila3 = $resultado3->fetch_row()) {
                                        ?>



                                        <tr>
                                            <td><?php echo $fila3[0] ?></td>
                                            <td><?php echo $fila3[2] ?></td>
                                            <td><?php echo $fila3[3] ?></td>
                                            <td><?php echo $fila3[5] ?></td>
                                            <td><?php echo $fila3[4] ?></td>

                                            <td>
                                                <!--<a class="editar btn btn-info fa fa-pencil "></a>-->

                                            </td>

                                        </tr>

                                        <?php
                                    }
                                    $resultado3->close();
                                }

//$conectar->close();
                                ?>
                            </table>

                        </div>
                    </div>
                </div>
            </div>











            <div class="col-lg-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Responsable  de Actividad
                    </div>
                    <div class="panel-body">
                        
                        <div id="responsables" class="panel-default">

                            <table class="table">
                                <thead>
                                <th></th>
                                </thead>

                                <?php
                                $consulta2 = "SELECT * FROM responsables_por_actividad inner join grupo_o_comite on responsables_por_actividad.id_Responsable=grupo_o_comite.ID_Grupo_o_comite where responsables_por_actividad.id_Actividad=" . $idAct;

                                if ($resultado2 = $conectar->query($consulta2)) {

                                    while ($fila2 = $resultado2->fetch_row()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $fila2[6] ?></td>
<!--                                            <td> <a class="elimina btn btn-danger fa fa-trash-o"></a></td>-->
                                        </tr>                     

                                        <?php
                                    }
                                    $resultado2->close();
                                }

//$conectar->close();
                                ?>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Sub Actividades
                    </div>
                    <div class="panel-body">
                        

                        <div id="subActividades" class="panel-default">

                            <table class="table">
                                <thead>
                                <th>ID</th>
                                <th>SubActividad</th>
                                <th>Encargado</th>
                                <th>Fecha Monitoreo</th>
                                <th></th>
                                </thead>

                                <?php
                                $consulta3 = "SELECT * FROM sub_actividad  where idActividad=" . $idAct;
                                $nombre;
                                if ($resultado3 = $conectar->query($consulta3)) {

                                    while ($fila3 = $resultado3->fetch_row()) {
                                        $consulta4 = "SELECT * FROM persona where N_identidad in(select N_identidad FROM empleado where No_Empleado='" . $fila3[5] . "')";
                                        if ($resultado4 = $conectar->query($consulta4)) {
                                            $fila4 = $resultado4->fetch_row();
                                            $nombre = $fila4[1] . " " . $fila4[2] . " " . $fila4[3] . " " . $fila4[4];


                                            $resultado4->close();
                                        }
                                        ?>



                                        <tr>
                                            <td><?php echo $fila3[0] ?></td>
                                            <td><?php echo $fila3[2] ?></td>
                                            <td><?php echo $nombre ?></td>
                                            <td><?php echo $fila3[4] ?></td>

                                            <td><a class="verSubActividad btn btn-success  fa fa-arrow-right "></a>
<!--                                                <a class="editarSubActividad btn btn-info fa fa-pencil "></a>
                                                <a class="eliminaSubActividad btn btn-danger fa fa-trash-o"></a>-->
                                            </td>

                                        </tr>

                                        <?php
                                    }
                                    $resultado3->close();
                                }

                                $conectar->close();
                                ?>
                            </table>
                            <div id="nuevaSub"></div>
                        </div>




                    </div>
                </div>
            </div>


        </div>





      
        
        





<?php

                        }}
?>







        <script>




            $(document).ready(function() {
                
                
                
                
                
                
                $("#retonoAct").click(function () {
                    //id = $(this).parents("tr").find("td").eq(0).html();
                    //alert(id);
                    id=$("#idInd").val();
                    data1 = {ide: id};
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "pages/crearObjetivo.php",
                        //beforeSend: inicioVer,
                        success: llegadaRetornoAct,
                        //timeout: 4000,
                        //error: problemas
                    });
                    return false;
                });
              
              
              function llegadaRetornoAct()
            {
                $("#contenedor").load('pages/crearActividad.php', data1);
            }
                
                
                
                
                
                
                
                

                $("form").submit(function(e) {
                    e.preventDefault();
         
                    $("#myModal").modal('hide');
                    data = {obs: $("#observacionres").val(),
                        grupo: $("#grupo").val(),
                        idAct: $("#idAct").val()
                    };
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "Datos/insertarActividad.php",
                        beforeSend: inicioEnvio,
                        success: llegadaGuardarRes,
                        timeout: 4000,
                        error: problemasRes
                    });
                    return false;

                });
                
                
                $("#finalizarActividad").click(function() {


                        //id = $(this).parents("tr").find("td").eq(0).html();
                        // alert(id);      
                        data6 = {
                            idAct: $('#idAct').val()
                        };
                        $.ajax({
                            async: true,
                            type: "POST",
                            dataType: "html",
                            //: "application/x-www-form-urlencoded",
                            //url: "pages/editarPOA.php",
                            //beforeSend: inicioEliminar,
                            success: llegadaFinalizarActividad,
                            //timeout: 4000,
                           // error: problemas
                        });
                        return false;

                    });
                

                $("#asignarSubActividad").click(function(e) {
                    e.preventDefault();
                    $("#myModal2").modal('hide');
                    data2 = {
                        idAct: $("#idAct").val(),
                        iniAct:$("#iniAct").val(),
                        finAct:$("#finAct").val()
                    };
                    //alert($("#nombre").val()); 
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        //contentType: "application/x-www-form-urlencoded",
                        //url: "pages/crearSubActividad.php",
                        //beforeSend:inicioSub,
                        success: llegadaasignarSubActividad,
                        timeout: 4000,
                        error: problemasSub
                    });
                    return false;

                });

                $(".verSubActividad").click(function(e) {
                    id = $(this).parents("tr").find("td").eq(0).html();
                    data4 = {
                        idAct: $("#idAct").val(),
                        idSubAct: id
                    };
                    //alert($("#nombre").val()); 
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        //contentType: "application/x-www-form-urlencoded",
                        //url: "pages/crearSubActividad.php",
                        //beforeSend:inicioSub,
                        success: llegadaVerSubActividad,
                        timeout: 4000,
                        error: problemasSub
                    });
                    return false;

                });


                $("#asignarCostoActividad").click(function(e) {
                    e.preventDefault();
                    $("#myModal3").modal('hide');
                    data3 = {
                        idAct: $("#idAct").val()
                    };
                    //alert($("#nombre").val()); 
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        //contentType: "application/x-www-form-urlencoded",
                        //url: "pages/crearSubActividad.php",
                        //beforeSend:inicioSub,
                        success: llegadaAsignarCostoActividad,
                        timeout: 4000,
                        error: problemasSub
                    });
                    return false;

                });



            });
            
            
            
            function llegadaFinalizarActividad()
                {
                    $("#cuerpoActividadRealizada").load('pages/activiadadRealizada.php', data6);
                    $('#actividadRealizada').modal('show');
                }



            function inicioEnvio()
            {
                var x = $("#responsables");
                x.html('Cargando...');
            }

            function llegadaVerSubActividad()
            {
                $("#contenedor").load('pages/SubActividad.php', data4);
                //$('#myModal2').modal('show');
            }


            function llegadaasignarSubActividad()
            {
                $("#myModal2body").load('pages/crearSubActividad.php', data2);
                $('#myModal2').modal('show');
            }
            function llegadaAsignarCostoActividad()
            {
                $("#myModal3body").load('pages/crearCostoActividad.php', data3);
                $('#myModal3').modal('show');
            }
            function llegadaGuardarRes()
            {
                $("#responsables").load('Datos/insertarResponsable.php', data);
            }

            function problemasSub()
            {
                $("#nuevaSub").text('Problemas en el servidor.');
            }


            function problemasRes()
            {
                $("#responsables").text('Problemas en el servidor.');
            }


        </script>







    </body>

</html>
