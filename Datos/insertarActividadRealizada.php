<?php
include '../Datos/conexion.php';
$idAct=$_POST['idAct'];
$obs=$_POST['obs'];
session_start();
$user= $_SESSION['nombreUsuario'];
$fecha = date('Y-m-d');
$estado="REALIZADA";
//echo $user;

$consulta = $conectar->prepare("CALL pa_insertar_actividades_terminadas(?,?,?,?,?)");
$consulta->bind_param('issss', $idAct, $fecha,$estado,$user ,$obs);
$resultado = $consulta->execute();

if ($resultado > 0) {
    echo '<div id="resultado" class="alert alert-success">
        Ha Dado por Finalizada La Actividad
         
         </div>';
} else {
    echo '<div id="resultado" class="alert alert-danger">
        Problemas con el Serividor
         
         </div>';
}
?>


<?php
                        $consulta = "SELECT * FROM actividades where id_actividad='" . $idAct . "'";

                        if ($resultado = $conectar->query($consulta)) {
                            $fila = $resultado->fetch_row()
                            ?>
   
        <input type="hidden" id="idAct" value="<?php echo $idAct; ?>">
        <input type="hidden" id="idInd" value="<?php echo $fila[1]; ?>"> 
        <div class="row">
            
<div class="panel panel-default">
                   <a id="retonoAct" href="#"><i class="fa fa-table fa-fw"></i><strong> Mis Actividades </strong></a>

                </div>
            <div class="col-lg-14">
                <div class="panel-default">
                    <div class="panel-heading">
                        
                            <h2><strong> Correlativo: </strong><?php echo $fila[3] ?>  <strong> Actividad:</strong> <?php echo $fila[2] ?></h2>
                        </div>
                        <div class="panel-body">


                            <div class="col-lg-4">
                                <table>


                                    <tr>
                                        <td><strong> Supuesto:  </strong></td>
                                        <td><?php echo $fila[4] ?></td>
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


        
        <script>




            $(document).ready(function() {

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



            });
            
            
       
            function llegadaVerSubActividad()
            {
                $("#contenedor").load('pages/SubActividad.php', data4);
                //$('#myModal2').modal('show');
            }

            function problemasSub()
            {
                $("#contenedor").text('Problemas en el servidor.');
            }



        </script>
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            $("#resultado").fadeOut(1500);
        }, 3000);

    });
</script>



      
        
        


