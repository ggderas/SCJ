<?php

  $maindir = "../";

  require_once($maindir.'check_session.php');

  require_once( $maindir."head.php");

?>

<!-- Main -->
<div class="container-fluid">
<div class="row">
  <div class="col-sm-3">
      <!-- Left column -->
      <a href="#"><strong><i class="glyphicon glyphicon-wrench"></i>Panel de control</strong></a>  
      
      <hr>
      
      <ul class="list-unstyled">
        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#userMenu">
          <h5>Manejo de folios <i class="glyphicon glyphicon-chevron-down"></i></h5>
          </a>
            <ul class="list-unstyled collapse in" id="userMenu">
                <li class="active"> <a href="#"><i class="glyphicon glyphicon-home"></i> Inicio </a></li>
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
                <li><a href="#">Information &amp; Stats</a>
                </li>
                <li><a href="#">Views</a>
                </li>
                <li><a href="#">Requests</a>
                </li>
                <li><a href="#">Timetable</a>
                </li>
                <li><a href="#">Alerts</a>
                </li>
            </ul>
        </li>
      </ul>
           
      <hr>
      
    </div><!-- /col-3 -->
    <div class="col-sm-9">
        
       <div class="row">
        <div class="col-md-12">
          <ul class="list-group">
            <li class="list-group-item"><a href="#"><i class="glyphicon glyphicon-flash"></i> <small>(3 mins ago)</small> The 3rd page reports don't contain any links. Does anyone know why..</a></li>
            <li class="list-group-item"><a href="#"><i class="glyphicon glyphicon-flash"></i> <small>(1 hour ago)</small> Hi all, I've just post a report that show the relationship betwe..</a></li>
            <li class="list-group-item"><a href="#"><i class="glyphicon glyphicon-heart"></i> <small>(2 hrs ago)</small> Paul. That document you posted yesterday doesn't seem to contain the over..</a></li>
            <li class="list-group-item"><a href="#"><i class="glyphicon glyphicon-heart-empty"></i> <small>(4 hrs ago)</small> The map service on c243 is down today. I will be fixing the..</a></li>
            <li class="list-group-item"><a href="#"><i class="glyphicon glyphicon-heart"></i> <small>(yesterday)</small> I posted a new document that shows how to install the services layer..</a></li>
            <li class="list-group-item"><a href="#"><i class="glyphicon glyphicon-flash"></i> <small>(yesterday)</small> ..</a></li>
          </ul>
        </div>
      </div>
    </div><!--/col-span-9-->
      
    <div class="row">
           
            
          
            <!-- center left--> 
        <div class="col-md-6">              
              
     
   
        </div><!--/col-->
        <div class="col-md-6">
          
          <div class="panel panel-default">
            <div class="panel-heading"><h4>Notices</h4></div>
              <div class="panel-body">
  
                  <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    This is a dismissable alert.. just sayin'.
                  </div>

                  This is a dashboard-style layout that uses Bootstrap 3. You can use this template as a starting point to create something more unique.
                  <br><br>
                  Visit the Bootstrap Playground at <a href="http://bootply.com">Bootply</a> to tweak this layout or discover more useful code snippets.
            </div>
          </div>
                        
        </div><!--/col-span-6-->
      </div><!--/row-->
      

</div>
</div>
<!-- /Main -->

<?php

  require_once($maindir."footer.php");

?>