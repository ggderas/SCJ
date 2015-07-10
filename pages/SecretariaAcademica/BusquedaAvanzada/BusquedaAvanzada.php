
<!-- ESTO TAMBIEN-->
<?php

$maindir = "../../../";
 
  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");
  
   if(!isset( $_SESSION['user_id'] ))
  {
    header('Location: '.$maindir.'login/logout.php?code=100');
    exit();
  }
  
?>
<body>


<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                   <div align="left">
                     <ul class="list-unstyled">
                       <li  class="nav-header active"> <a id="SecretariAcademica" href="#"><i class="glyphicon glyphicon-home"></i> Inicio Secretaria Academica</a> </li>
                     </ul>
              </div>
                <ul class="list-unstyled"><hr align="left">
                   <li class="nav-header"> 
                     <h5 align="left"><a href="#" data-toggle="collapse" data-target="#userMenu"><i class="fa fa-male fa-fw"></i>Gestión de Estudiantes<i class="glyphicon glyphicon-chevron-down"></i></a></h5>
                        <div align="left">
                          <ul class="list-unstyled collapse in" id="userMenu">
                            <li>
                              <a id="RegistroEstudiante" href="#"><i class="glyphicon glyphicon-edit"></i>Registro de Estudiantes</a>
                            </li>
                            <li>
                              <a id="TipoEstudiante"  href="#"><i class="fa fa-user fa-fw"></i>Tipo Estudiante</a>
                            </li>
                          </ul>
                        </div>
                   </li>
                    <li class="nav-header"> 
                      <h5 align="left"><a href="#" data-toggle="collapse" data-target="#userMenu2"><i class="fa fa-users "></i>Gestión de Solicitudes<i class="glyphicon glyphicon-chevron-down"></i></a></h5>
                        <div align="left">
                          <ul class="list-unstyled collapse in" id="userMenu2">     
                            <li><a id="nuevaSolicitud" href="#"><i class="fa fa-suitcase"></i>Nueva solicitud</a></li>
                            <li><a id="SolicitudEstudiante" href="#"><i class="fa fa-user fa-fw"></i>Solicitud estudiante</a></li>
                          </ul>
                        </div>
                    </li>
                    <li id = "BusquedaAvanzada" class="nav-header"> 
                      <h5 align="left"><a href="#" data-toggle="collapse" data-target="#userMenu2"><i class="glyphicon glyphicon-search"></i>Busqueda vanzada</a></h5>
                    </li>
                </ul>
            </div>

             <div class="col-sm-9">
              <div class="col-md-12">
                <div id="contenedor" class="content-panel">
                  <div class="col-lg-12">                  </div>
                  <div id="wrapper">
                    <div align="left">
                      <!-- Patanlla principal de la secretaria academica -->
                      </div>
                  </div>                       
                </div>
              </div>
            </div>
        </div>
      </div>
      
<div>
<fieldset>
<legend><strong>Busqueda Avanzada</strong></legend>
<form id="form1" name="form1" method="post" action="">
  <p>
    <label></label>
    <span class="Estilo4">
    <span class="Estilo6">
    
    </span>    </span><br/>
    <br/>
    <label>
    <input name="tbuscar" type="text" id="tbuscar" value="" size="60" hspace="20" />
    <input type="submit" name="Buscar" id="Buscar" value="Buscar"  hspace="40" vspace=" 10" />
    
    <br/>
    </label>
</p>
  <p>
    <label></label>
    <label></label>
    <label></label>
  
    <span class="Estilo2">
    <label><strong>Elegir</strong></label>
  <strong>    una Opción de busqueda  </strong></span></p>

    <span class="Estilo2">
    <label></label>
    <label></label>
    </span>
    <table width="842" border="0">
    <tr>
      <th width="176" class="Estilo2" scope="row"><label></label>
          <label> </label>
          <div align="left">
            <input type="checkbox" name="tipo1" id="tipo1" />
            Tipo de Solicitud</div>
        <label> </label></th>
      <td width="247" class="Estilo2"><strong>
        <label>
        <input type="checkbox" name="tipo2" id="tipo2" />
        Estudiante de Pregrado</label>
      </strong></td>
      <td width="195" class="Estilo2"><strong>
        <label>
        <input type="checkbox" name="indice" id="indice" />
        Indice Academico</label>
      </strong></td>
      <td width="206" class="Estilo2"><strong>
        <label></label>
        <label>
        <input type="checkbox" name="fecha" id="fecha" />
          Fecha de Solicitud</label>
      </strong></td>
    </tr>
    <tr>
      <th class="Estilo2" scope="row"><div align="left">
          <input type="checkbox" name="Tipo de Solicitud4" id="Tipo de Solicitud4" />
        Nº de Solicitud </div></th>
      <td class="Estilo2"><strong>
        <label>
        <input type="checkbox" name="tipo4" id="tipo4" />
        Estudiante de Postgrado</label>
      </strong></td>
      <td class="Estilo2"><strong>
        <label>
        <input type="checkbox" name="mension" id="mension" />
        </label>
        Mención
        <label> Honorifica</label>
      </strong></td>
      <td class="Estilo2">&nbsp;</td>
    </tr>
  </table>
  <p class="Estilo2">&nbsp;</p>
  <p class="Estilo2"><strong>Datos generados por la busqueda:</strong></p>
  <table width="907" height="202" border="1">
    <tr>
      <th width="101" scope="row"><div align="center" class="Estilo1">Nombre</div></th>
      <td width="106"><div align="center" class="Estilo1">Apellidos</div></td>
      <td width="141"><div align="center" class="Estilo1">Nº Identidad</div></td>
      <td width="193"><div align="center" class="Estilo1">Tipo de Estudiante</div></td>
      <td width="188"><div align="center" class="Estilo1">Indice Academico</div></td>
      <td width="138"><div align="center" class="Estilo1">Titulo</div></td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>

 <br />
    <br />

  <div  align= "center" > 
    <div align="right">
      <input type="submit" name="button" id="button" value="Generar Reporte" a/>
    </div>
  </div>
    <br />
    <br />
  </p>
</form>
</fieldset>
</div>
</body>
</html>
