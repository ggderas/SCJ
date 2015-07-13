<?php

echo <<<HTML

<footer class="text-center"> Sistema creado por el equipo de <a href="#"><strong> Industria del software </strong></a></footer>

    <!-- <script type="text/javascript" language="javascript" src="js/jquery-1.10.2.min.js"></script> -->
    <!-- <script type="text/javascript" language="javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/plugins/datatables/dataTables.bootstrap.js"></script> -->

    <!-- Dorian js begin -->

    <script type="text/javascript" src="js/jquery-2.1.1.min.js" ></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>   
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="bower_components/raphael/raphael-min.js"></script>
    <script src="bower_components/morrisjs/morris.min.js"></script>
    
    <!-- Problemas con esta libreria: no la encuentra -->
    <!-- <script src="js/morris-data.js"></script> -->    
    <script src="dist/js/sb-admin-2.js"></script>

    <!-- Dorian js end -->

    <script type="text/javascript" src="bower_components/datatables/media/js/jquery.dataTables.js"></script>
	
	<script type="text/javascript" src="bower_components/bootstrap-switch-master/dist/js/bootstrap-switch.js" ></script>

    <!-- <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"></script> -->
    <!-- <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script> -->

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js" rel="stylesheet" type="text/javascript"></script>-->
        
    <!-- <script src="js/jquery.js" type="text/javascript"></script> -->

    <!--<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script> -->
    <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <!-- JavaScript jQuery code from Bootply.com editor  -->
        
        <script type='text/javascript'>
        
        function ajax_(str)
        {
	        $('#div_contenido').load(str,function(){
              //$('#div_contenido').trigger('create');
            });
        }

        </script>
        
        <!--
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
          ga('create', 'UA-40413119-1', 'bootply.com');
          ga('send', 'pageview');
        </script>
        -->
        
    </body>
</html>

HTML;

?>