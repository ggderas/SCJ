<?php

  $maindir = "../../";

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");
  
  if(isset($_GET['contenido']))
  {
    $contenido = $_GET['contenido'];
  }
else
  {
    $contenido = 'gestion_de_folios';
  }
  
  require_once($maindir.'pages/navbar.php');

?>

<!-- Main -->
<div class="container-fluid">
<div class="row">
  <div class="col-sm-3">
      <!-- Left column -->
      <a href="#"><strong><i class="glyphicon glyphicon-wrench"></i>Panel de control</strong></a>  
      
      <hr>
      
      <ul class="list-unstyled">
        <li class="nav-header active"> <a href="#"><i class="glyphicon glyphicon-home"></i> Inicio </a></li>
        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#userMenu">
          <h5>Manejo de folios <i class="glyphicon glyphicon-chevron-down"></i></h5>
          </a>
            <ul class="list-unstyled collapse in" id="userMenu">
                
                <li><a href="#"><i class="glyphicon glyphicon-inbox"></i> Bandeja de entrada 
                  <span class="badge badge-info">4</span></a></li>
                <li><a href="#"><i class="glyphicon glyphicon-envelope"></i> Bandeja de salida </a></li>
                <li><a href="#"><i class="glyphicon glyphicon-trash"></i> Basurero </a></li>
                <li><a href="#"><i class="glyphicon glyphicon-flag"></i> Folios de entrada </a></li>
                <li><a href="#"><i class="glyphicon glyphicon-send"></i> Folios de salida </a></li>
                <li><a href="#"><i class="glyphicon glyphicon-exclamation-sign"></i> Folios pendientes 
                  <span class="badge badge-info">6</span></a></li>
            </ul>
        </li>
        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu2">
          <h5>Reportes <i class="glyphicon glyphicon-chevron-right"></i></h5>
          </a>
        
            <ul class="list-unstyled collapse" id="menu2">
                <li><a href="#">Informacion y Estadisticas</a>
                </li>
                <li><a href="#">Vistas</a>
                </li>
                <li><a href="#">Peticiones</a>
                </li>
                <li><a href="#">Tablas</a>
                </li>
                <li><a href="#">Alertas</a>
                </li>
            </ul>
        </li>
      </ul>
           
      <hr>

    </div><!-- /col-3 -->
    <div class="col-sm-9">
           <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
                              <h4><i class="fa fa-angle-right"></i> Advanced Table</h4>
                              <hr>
                              <thead>
                              <tr>
                                  <th><i class="fa fa-bullhorn"></i> Company</th>
                                  <th class="hidden-phone"><i class="fa fa-question-circle"></i> Descrition</th>
                                  <th><i class="fa fa-bookmark"></i> Profit</th>
                                  <th><i class=" fa fa-edit"></i> Status</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <td><a href="basic_table.html#">Company Ltd</a></td>
                                  <td class="hidden-phone">Lorem Ipsum dolor</td>
                                  <td>12000.00$ </td>
                                  <td><span class="label label-info label-mini">Due</span></td>
                                  <td>
                                      <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <a href="basic_table.html#">
                                          Dashgum co
                                      </a>
                                  </td>
                                  <td class="hidden-phone">Lorem Ipsum dolor</td>
                                  <td>17900.00$ </td>
                                  <td><span class="label label-warning label-mini">Due</span></td>
                                  <td>
                                      <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <a href="basic_table.html#">
                                          Another Co
                                      </a>
                                  </td>
                                  <td class="hidden-phone">Lorem Ipsum dolor</td>
                                  <td>14400.00$ </td>
                                  <td><span class="label label-success label-mini">Paid</span></td>
                                  <td>
                                      <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <a href="basic_table.html#">
                                          Dashgum ext
                                      </a>
                                  </td>
                                  <td class="hidden-phone">Lorem Ipsum dolor</td>
                                  <td>22000.50$ </td>
                                  <td><span class="label label-success label-mini">Paid</span></td>
                                  <td>
                                      <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                  </td>
                              </tr>
                              <tr>
                                  <td><a href="basic_table.html#">Total Ltd</a></td>
                                  <td class="hidden-phone">Lorem Ipsum dolor</td>
                                  <td>12120.00$ </td>
                                  <td><span class="label label-warning label-mini">Due</span></td>
                                  <td>
                                      <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                                  </td>
                              </tr>
                              </tbody>
                          </table>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->
    </div><!--/col-span-9-->

</div>
</div>
<!-- /Main -->