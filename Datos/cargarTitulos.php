<?php
//include '../../Datos/conexion.php';

 $pame = mysql_query("SELECT * FROM titulo");


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
                x.click(editarTitulo);
            };
            
            
            
            function fn_dar_eliminar(){
          
                $(".elimina").click(function(){
                    id1 = $(this).parents("tr").find("td").eq(0).html();
                    eliminarTitulo();
                  
                });
            };
            
            
   function eliminarTitulo(){
        var respuesta=confirm("¿Esta seguro de que desea eliminar el registro seleccionado?");
        if (respuesta){  
             data1 ={ titulo:id1,tipoProcedimiento:"eliminar"};
    
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        url:"Datos/eliminarPOA.php",     
        beforeSend:inicioEnvio,
        success:llegadaEliminarTitulo,
        timeout:4000,
        error:problemas
    }); 
    return false;
        }
} 
            
            
                  
            

                function editarTitulo()
            {
                var titulo=$(this).parents("tr").find("td").eq(0).html();
               
              
                
                
                 data ={titulo:titulo}; 
                
                
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    beforeSend: inicioEnvio,
                    success: llegadaEditarTitulo,
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
            
             function llegadaEditarTitulo()
            {
                $("#contenedor").load('pages/recursos_humanos/modi_Titulo.php',data);
                //$("#contenedor").load('../cargarPOAs.php');
            }
            
              function llegadaEliminarTitulo()
            {
                $("#contenedor").load('pages/recursos_humanos/Titulo.php',data1);
                //$("#contenedor").load('../cargarPOAs.php');
            }

            function problemas()
            {
                $("#contenedor").text('Problemas en el servidor.');
            }



        </script>
    
    
    

    
</head>

<body>
    
    <div class="row">
        <div class="col-lg-12">

            <h1 class="page-header">Lista de Tipos de Estudio</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

   
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
        <tr>
            <th><strong>ID Titulo</strong></th>
            <th><strong>Nombre del Titulo</strong></th>
            <th><strong>Eliminar</strong></th>
            <th><strong>Modificar</strong></th>

        </tr>
            </thead>
      <tbody>
          
        <?php
        while ($row = mysql_fetch_array($pame)) {
            $id = $row['id_titulo'];
         ?>
            
          <tr>
                  <td id="id4"><?php echo $id ?></td>
                  <td><div class="text" id="ntitulo-<?php echo $id ?>"><?php echo $row['titulo'] ?></div></td>
                  
<?php
   if($_SESSION['user_rol'] != 100){
           echo'       <td>
          <center>
              <button class="elimina btn btn-danger glyphicon glyphicon-trash" disabled="TRUE"></button>

          </center>
            </td> ';
   }  else {
         echo'       <td>
          <center>
              <button class="elimina btn btn-danger glyphicon glyphicon-trash"></button>

          </center>
            </td> ';
       
   }
?>
            <td>

            <center>

                <button   type="button"  id="editar" href="#" class="editarb btn btn-primary glyphicon glyphicon-edit" >
                  
                </button>
            </center>

            </td>


    </tr>

   <?php } ?>
 </tbody>
    </table>

    </div>


</body>

</html>

