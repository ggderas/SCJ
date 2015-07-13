<?php


 //include '../../Datos/conexion.php';
 
 $pame = mysql_query("SELECT * FROM pais");
 
  
  if(isset($_GET['contenido']))
    {
      $contenido = $_GET['contenido'];
    
    }
  else
    {
      $contenido = 'recursos_humanos';
    }

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");

?>
<html lang="es">

<head>

    
    
       <script>

            /* 
             * To change this license header, choose License Headers in Project Properties.
             * To change this template file, choose Tools | Templates
             * and open the template in the editor.
             */


             $(document).ready(function(){
                fn_dar_eliminar();               
            });

            var x;
            x = $(document);
            x.ready(inicio);
            
            
        
            function inicio()
            {
              
                 var x;
                x = $(".editarb");
                x.click(editarPais);
            };
            
            
            
            function fn_dar_eliminar(){
          
                $(".elimina").click(function(){
                    id1 = $(this).parents("tr").find("td").eq(0).html();
                    eliminarPais();
                  
                });
            };
            
            
   function eliminarPais(){
        var respuesta=confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
        if (respuesta){  
             data1 ={ Id_Pais:id1, tipoProcedimiento:"eliminar"};
    
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        url:"Datos/eliminarPOA.php",     
        beforeSend:inicioEnvio,
        success:llegadaEliminarPais,
        timeout:4000,
        error:problemas
    }); 
    return false;
        }
} 
            
            
                  
            

                function editarPais()
            {
                var pid=$(this).parents("tr").find("td").eq(0).html();
               
              
                
                
                 data ={pid:pid}; 
                
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaEditarPais,
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
            
             function llegadaEditarPais()
            {
                $("#contenedor").load('pages/recursos_humanos/modi_pais.php',data);
                //$("#contenedor").load('../cargarPOAs.php');
            }
            
              function llegadaEliminarPais()
            {
                $("#contenedor").load('pages/recursos_humanos/Pais.php',data1);
                //$("#contenedor").load('../cargarPOAs.php');
            }

            function problemas()
            {
                $("#contenedor").text('Problemas en el servidor.');
            }



        </script>
        
                 <script type="text/javascript" charset="utf-8">
          
 $(document).ready(function() {
  
    $('#tabla_paises').dataTable({
	  "order": [[ 1, "desc" ]],
	  "fnDrawCallback": function(oSettings ) {
              	

      }
	}); // example es el id de la tabla
  });

    </script>
    
    
    

    
</head>

<body>
    
    <div class="row">
        <div class="col-lg-12">

            <h1 class="page-header">Lista de paises</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

   
    <div class="table-responsive">
        <table id="tabla_paises"  class="table table-bordered table-hover table-striped">
            <thead>
        <tr>
            <th><strong>ID pais</strong></th>
            <th><strong>Nombre del Pais</strong></th>
            <th><strong>Eliminar</strong></th>
            <th><strong>Modificar</strong></th>

        </tr>
            </thead>
      <tbody>
          
        <?php
        while ($row = mysql_fetch_array($pame)) {
            $id = $row['Id_pais'];
         ?>
            
          <tr>
                  <td id="id4"><?php echo $id ?></td>
                  <td><div class="text" id="npais-<?php echo $id ?>"><?php echo $row['Nombre_pais'] ?></div></td>

<?php

  if($_SESSION['user_rol'] != 100){
             echo'      <td> <center>
             <button class="elimina btn btn-danger glyphicon glyphicon-trash" disabled="TRUE"></button>

          </center></td> ';
  }else{
      
    echo'   <td> <center>
              <button class="elimina btn btn-danger glyphicon glyphicon-trash"></button>

       </center></td> ';
         
  }
                          
                          
?>                          

            <td>

            <center>

                <button   type="button"  id="editar" href="#" class="editarb btn btn-primary glyphicon glyphicon-edit" >
                  
                </button>
            </center>

            </td>


    </tr>

    <!-- aqui Omar -->



   <?php } ?>
 </tbody>
    </table>

    </div>


</body>

</html>

