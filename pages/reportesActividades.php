<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <script>
        
        $(document).ready(function () {


                $("#actFin").click(function () {

                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        //url:"pages/crearPOA.php",    
                        // url:"../cargarPOAs.php",  
                        //beforeSend:inicioEnvio,
                        success: llegadaCrear,
                        //timeout: 4000,
                        //error: problemas
                    });
                    return false;
                });

                function llegadaCrear()
                {
                    $("#contenedor").load('pages/reporteActFin.php');
                    //$("#contenedor").load('../cargarPOAs.php');
                }
                
                $("#actNOFin").click(function () {

                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        //url:"pages/crearPOA.php",    
                        // url:"../cargarPOAs.php",  
                        //beforeSend:inicioEnvio,
                        success: llegadaCrear2,
                        //timeout: 4000,
                        //error: problemas
                    });
                    return false;
                });

                function llegadaCrear2()
                {
                    $("#contenedor").load('pages/reporteActNOFin.php');
                    //$("#contenedor").load('../cargarPOAs.php');
                }

    });
        
        </script>
    </head>
    <body>


        <a >
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div>Actividades Terminadas</div>
                            </div>
                        </div>
                    </div>
                    <a id="actFin" href="#" >
                        <div class="panel-footer">
                            <span class="pull-left">Ver detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </a>
        <a>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                               
                                <div>Actividades Que No se Cumplieron</div>
                            </div>
                        </div>
                    </div>
                    <a id="actNOFin" href="#">
                        <div class="panel-footer">
                            <span class="pull-left">Ver detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </a>

    </body>
</html>
