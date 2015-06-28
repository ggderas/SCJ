<?php
   include '../../Datos/conexion.php';
    $maindir = "../../";
    
  echo $_SERVER['SERVER_NAME'];
 
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

  require_once($maindir."pages/navbar.php");
  
  
  $rol = $_SESSION['user_rol']; 

?>

<html lang="es">
    <head>
        
        
        
    <meta charset="utf-8">
    
    </head>
    
    <body>
	
    <div class="container-fluid">
         <div class="row">
             <div class="col-sm-3">

       <ul class="list-unstyled">
       <li class="nav-header active"> <a id="Recursos_humanos" href="#"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
       <hr>
        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#userMenu">
          <h5><i class="fa fa-male fa-fw"></i> Gestión de perfiles <i class="glyphicon glyphicon-chevron-down"></i></h5>
          </a>
            <ul class="list-unstyled collapse in" id="userMenu">
                
                     <li>
                                <a id="personas" href="#"><i class="fa fa-user"></i> Perfiles</a>
                            </li>
                            <li>
                                <a id="Busqueda"  href="#"><i class="glyphicon glyphicon-search"></i> Búsqueda</a>
                            </li>
                    
                   
                
            </ul>
        </li>
        
        
        
             <li class="nav-header"  <?php if($rol <= 44) echo 'style="display: none;"';?>  > <a href="#" data-toggle="collapse" data-target="#userMenu2">
          <h5><i class="fa fa-user fa-fw"></i> Gestión de Empleados <i class="glyphicon glyphicon-chevron-down"></i></h5>
          </a>
            <ul class="list-unstyled collapse in" id="userMenu2">
                
                <li><a id="empleado" href="#"><i class="fa fa-suitcase"></i> Empleados </a></li>
                <li><a id="gestionGC" href="#"><i class="fa fa-users "></i> Gestión de Grupos</a></li>
                
            </ul>
        </li>
        
 
        
        
        <li class="nav-header" <?php if($rol <= 44) echo 'style="display: none;"';?> > <a href="#" data-toggle="collapse" data-target="#menu4">
          <h5><i class="fa fa-cogs fa-fw"></i> Mantenimiento <i class="glyphicon glyphicon-chevron-right"></i></h5>
          </a>
        
            <ul class="list-unstyled collapse" id="menu4">
                <li><a id="idiomas" href="#">Idiomas</a>
                </li>
                <li><a id="clases" href="#">Clases</a>
                </li>
                <li><a id="cargos" href="#">Cargos</a>
                </li>
                <li><a id="universidad" href="#">Universidades</a>
                </li>
                <li><a  id="tipos" href="#">Tipo Estudio</a>
                </li>
                  <li><a id="departamentos" href="#">Departamentos</a>
                </li>
                  <li><a id="comite" href="#">Grupo o Comité</a>
                </li>
                  <li><a id="pais" href="#">Paises</a>
                </li>
                  <li><a id="titulo" href="#">Título</a>
                </li>
		
                
            </ul>
        </li>
      </ul>
              <hr>
       </div>
                            
                            
      
       <div class="col-sm-9">
           <div class="row mt">
                  <div class="col-md-12">
                      <div id="contenedor" class="content-panel">


                        <div class="col-lg-12">
                            <h1 class="page-header"><strong>Gestión Curricular</strong></h1>
                        </div>
                          

                          
                        
                          
               <div id="wrapper">
                   
                   <?php
                   
                   
                   $query = mysql_query("select count(N_identidad) as perfiles from persona");
                   $row = mysql_fetch_array($query);
                   $Total = $row["perfiles"];
                   
                   $query = mysql_query("select count(*)as activos from empleado where estado_empleado=1");
                   $row = mysql_fetch_array($query);
                   $TotalEmpleadoActivo = $row["activos"];
                   
                   $query = mysql_query("select count(*) as desactivos from empleado where estado_empleado!=1");
                   $row = mysql_fetch_array($query);
                   $TotalEmpleadoDes = $row["desactivos"];
                   
                    $query = mysql_query("select count(*) as Aspirante from persona where N_identidad not in (Select N_identidad from empleado)");
                   $row = mysql_fetch_array($query);
                   $Asparitante = $row["Aspirante"];
                    
                   
                //   select count(*) from empleado where estado_empleado=1
                  // select count(*) from empleado where estado_empleado!=1
                  // select count(*) from persona where N_identidad not in (Select N_identidad from empleado)
                  // select estado_empleado, count(*) from empleado group by estado_empleado;
                   
                   
                   ?>
                   
        
        <input id="Total" type="hidden" value="<?php echo $Total; ?>" >
        <input id="TotalEmpleadoActivo" type="hidden" value="<?php echo $TotalEmpleadoActivo; ?>" >
        <input id="TotalEmpleadoDes" type="hidden" value="<?php echo $TotalEmpleadoDes; ?>" >
        <input id="Asparitante" type="hidden" value="<?php echo $Asparitante; ?>" >
  

            
            <!-- /.row -->
            <div class="row">
            
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Total de perfiles
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                        </div>
                    </div>
                </div>
                
                     <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Empleados
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Aspirantes
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart3"></div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
          
            
                                                
           <!--  </div> -->
                       
                    </div>
                </div>
            </div>
        
       </div>    



    </div>
 </div>

    </div>
    <script>
   /* history.pushState(
            'data',
    'recursos_humanos',
    'page1'
            
            
            );
    
    window.addEventListener('popstate',function(e){
       console.log(e);
    });
    */
    </script>
        
    
    
         <script>

            /* 
             * To change this license header, choose License Headers in Project Properties.
             * To change this template file, choose Tools | Templates
             * and open the template in the editor.
             */

            var x;
            x = $(document);
            x.ready(menuInicioEmpleado);
            function menuInicioEmpleado()
            {
                var x;
                x = $("#clases");
                x.click(clases);
                
                var x;
                x = $("#cargos");
                x.click(cargos);
                
                var x;
                x = $("#pais");
                x.click(paises);
                
         
				
                var x;
                x=$("#departamentos");
                x.click(departamentos);
                
                var x;
                x = $("#idiomas");
                x.click(idiomas);
                
                var x;
                x = $("#tipos");
                x.click(tipo);
                var x;
                x = $("#comite");
                x.click(comite);
                
                   
                var x;
                x = $("#idioma");
                x.click(idiomas);
                
                var x;
                x = $("#empleado");
                x.click(empleados);
               
                
                var x;
                x = $("#universidad");
                x.click(universidades);
                
         var x;
        x = $("#personas");
        x.click(personas);
   
        
        var x;
        x = $("#gestionGC");
        x.click(gestiondeGrupos);
        
        
         var x;
        x = $("#titulo");
        x.click(Titulo);
        
        
         var x;
        x = $("#Busqueda");
        x.click(busqueda);
        
        
          
        
  
                
                
            }
            
            
        
            
            function idiomas()
            {
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaidioma,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            }
            function comite()
            {
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadacomite,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            }



            function clases()
            {
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaClases,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            }
            
            function cargos()
            {
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaCargos,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            }
            function departamentos()
            {
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaDepartamentos,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            }
            
             function tipo()
            {
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaTipos,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            }
            
                      
                 function empleados()
            {
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaempleado,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            }
            
            function paises()
            {
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadapais,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            }
           
    
			
	
            
                    function persona()
            {
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadapersona,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            }
            
            function universidades()
            {
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadauniversidad,
                    timeout: 4000,
                    error: problemas
                });
                return false;
            }
            
            function personas()
    {
        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            url:"pages/recursos_humanos/cv/menuPersona.php",
            contentType: "application/x-www-form-urlencoded",
            beforeSend: inicioEnvio,
            success: llegadaPersonas,
            timeout: 4000,
            error: problemas
        });
        return false;
    }
  
    
        function gestiondeGrupos()
    {
        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            beforeSend: inicioEnvio,
            success: llegadagestiondeGrupos,
            timeout: 4000,
            error: problemas
        });
        return false;
    }
    
            function Titulo()
    {
        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            beforeSend: inicioEnvio,
            success: llegadaTitulo,
            timeout: 4000,
            error: problemas
        });
        return false;
    }
    
                  function busqueda()
    {
        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            beforeSend: inicioEnvio,
            success: llegadabusqueda,
            timeout: 4000,
            error: problemas
        });
        return false;
    } 
 
            
            


            function inicioEnvio()
            {
                var x = $("#contenedor");
                x.html('Cargando...');
            }
            
            
           
            

            function llegadaClases()
            {
                $("#contenedor").load('pages/recursos_humanos/Clases.php');
                //$("#contenedor").load('../cargarPOAs.php');
            }
             function llegadaidioma()
            {
                $("#contenedor").load('pages/recursos_humanos/Idiomas.php');
                //$("#contenedor").load('../cargarPOAs.php');
            }
            function llegadacomite()
            {
                $("#contenedor").load('pages/recursos_humanos/Comite_Grupo.php');
                //$("#contenedor").load('../cargarPOAs.php');
            }
               function llegadaCargos()
            {
                $("#contenedor").load('pages/recursos_humanos/Cargos.php');
                //$("#contenedor").load('../cargarPOAs.php');
            }
                function llegadaDepartamentos()
            {
                $("#contenedor").load('pages/recursos_humanos/Departamentos.php');
                //$("#contenedor").load('../cargarPOAs.php');
            }
            
                function llegadaTipos()
            {
                $("#contenedor").load('pages/recursos_humanos/Tipo_estudio.php');
                //$("#contenedor").load('../cargarPOAs.php');
            }
            
               function llegadapais()
            {
                $("#contenedor").load('pages/recursos_humanos/Pais.php');
                //$("#contenedor").load('../cargarPOAs.php');
            }
			
	
            
                     function llegadaempleado()
            {
                $("#contenedor").load('pages/recursos_humanos/Empleados.php');
                //$("#contenedor").load('../cargarPOAs.php');
            }
            
        
            
                 function llegadauniversidad()
            {
                $("#contenedor").load('pages/recursos_humanos/universidades.php');
                //$("#contenedor").load('../cargarPOAs.php');
            }
            
            
             function llegadaPersonas()
    {
        $("#contenedor").load('pages/recursos_humanos/cv/menuPersona.php');
        
    }

    
      function llegadagestiondeGrupos()
    {
        $("#contenedor").load('pages/recursos_humanos/gestion_Grupos_comite.php');
    }
    
       function llegadaTitulo()
    {
        $("#contenedor").load('pages/recursos_humanos/Titulo.php');
    }
    
        function llegadabusqueda()
    {
        $("#contenedor").load('pages/recursos_humanos/cv/MenuBusqueda.php');
    }

            
            

            function problemas()
            {
                $("#contenedor").text('Problemas en el servidor.');
            }



        </script>
        
        
         <script>
        vari= $("#realizadasDelMes").val();
        Total=$("#Total").val();
        TotalEmpleadoActivo=$("#TotalEmpleadoActivo").val();
        TotalEmpleadoDes=$("#TotalEmpleadoDes").val();
        Asparitante=$("#Asparitante").val();
        
        
        $(function() {

     Morris.Donut({
        element: 'morris-donut-chart',
       // data:'estadisticasActDelMes.php',
        data:[{
            label: "Perfiles",
            value: Total,
            color:"green"
        }],
        resize: true
    });
    
       Morris.Donut({
        element: 'morris-donut-chart2',
       // data:'estadisticasActDelMes.php',
        data:[{
            label: "Empleados",
            value: TotalEmpleadoActivo,
            color:"green"
        }, {
            label: "Ex-Empleados",
            value: TotalEmpleadoDes
        }],
        resize: true
    });
    
     Morris.Donut({
        element: 'morris-donut-chart3',
       // data:'estadisticasActDelMes.php',
        data:[{
            label: "Aspirantes",
            value: Asparitante,
            color:"green"
        }],
        resize: true
    });
    
    
   
    

});
        
        </script>
        
        
        
  
        
     
        
        
    </body>
        
</html>