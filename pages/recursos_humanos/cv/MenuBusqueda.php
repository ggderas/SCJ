<?php
    $maindir = "../../../";

  if(isset($_GET['contenido']))
    {
      $contenido = $_GET['contenido'];
    }
  else
    {
      $contenido = 'recursos_humanos';
      $navbar_loc = 'contenido';
    }

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");
  
   if(!isset( $_SESSION['user_id'] ))
  {
    header('Location: '.$maindir.'login/logout.php?code=100');
    exit();
  }

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div id="container">
    <div class="row">
        <div class="col-lg-10">
            <h1 class="page-header">Menú de búsqueda</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row ex2">
       
            
            
            
             <div class="panel-group" id="accordion">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <label><span class="glyphicon" aria-hidden="true"></span> Búsqueda Generales</label>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-10">
            
               <div class="col-lg-3 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-globe fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div>General</div>
                            </div>
                        </div>
                    </div>
                    <a id="BusquedaG" href="#">
                        <div class="panel-footer" data-toggle="modal" data-target="#compose-modal" >
                            <span class="pull-left"  >Buscar</span>
                            <span class="pull-right"  ><i class="fa fa-arrow-circle-right" ></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
                            <div><h2>Descripción :</h2> <h4>Se hara una búsqueda general de todos los perfiles existentes en la base de datos incluye
                                    empleados,ex-empleados y solicitantes.
                                    </h4></div>
                        </div>
                        
                        
                        
                    </div>
                </div>
             </div>
            
            
            
                  <div class="panel-group" id="accordion">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <label><span class="glyphicon" aria-hidden="true"></span> Búsqueda por solicitante</label>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-10">
            
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div>Solicitantes</div>
                            </div>
                        </div>
                    </div>
                    <a id="solicitante" href="#">
                        <div class="panel-footer">
                            <span class="pull-left">Buscar</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
                            <div><h2>Descripción :</h2> <h4>  Se hara una búsqueda solo de los solicitantes a puestos de trabajo excluyendo a 
                                    los empleados.
                                    </h4></div>
                        </div>
                    </div>
                </div>
             </div>
            
            
            
                  <div class="panel-group" id="accordion">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <label><span class="glyphicon" aria-hidden="true"></span> Búsqueda por empleado</label>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-10">
            
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div>Empleados</div>
                            </div>
                        </div>
                    </div>
                    <a id="BusquedaE" href="#">
                        <div class="panel-footer">
                            <span class="pull-left">Buscar</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
                            <div><h2>Descripción :</h2> <h4>Se hara una búsqueda solo de los empleados actules excluyendo ex-empleados.
                                    </h4></div>
                        </div>
                    </div>
                </div>
             </div>
                            
                            
                            
        
     
    </div>
    
    
    
    
     <script>
    var x;
        x = $(document);
        x.ready(menuBusqueda);
        function menuBusqueda()
        {
            var x;
            x = $("#BusquedaG");
            x.click(BusquedaGeneral);
            var x;
            x = $("#BusquedaE");
            x.click(BusquedaEmpleados);
            var x;
            x=$("#solicitante");
            x.click(BusquedaSolicitante);
            var x;
            x=$("#eliminar");
            x.click(eliminar);
        }
        function BusquedaGeneral()
        {
            $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: inicioEnvio,
                success: llegadaBusquefaGeneral,
                timeout: 4000,
                error: problemas
            });
            return false;
        }
        function BusquedaEmpleados()
        {
            $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: inicioEnvio,
                success: llegadaBusquedaEmpleado,
                timeout: 4000,
                error: problemas
            });
            return false;
        }
         function BusquedaSolicitante()
        {
            $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: inicioEnvio,
                success: llegadaBusquedaSolicitante,
                timeout: 4000,
                error: problemas
            });
            return false;
        }

        function eliminar()
        {
            $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: inicioEnvio,
                success: llegadaEliminar,
                timeout: 4000,
                error: problemas
            });
            return false;
        }

        function inicioEnvio()
        {
            var x = $("#container");
            x.html('Cargando...');
        }

        function llegadaBusquefaGeneral()
        {
            $("#container").load('pages/recursos_humanos/cv/Busquedas/BusquedaGeneral.php');
        }
        function llegadaBusquedaEmpleado()
        {
            $("#container").load('pages/recursos_humanos/cv/Busquedas/BusquedaXempleados.php');
        }
         function llegadaBusquedaSolicitante()
        {
            $("#container").load('pages/recursos_humanos/cv/Busquedas/BusquedaSolicitante.php');
        }
        function llegadaEliminar()
        {
            $("#container").load('pages/recursos_humanos/cv/eliminar/formAcademica.php');
        }

    </script>
    
    