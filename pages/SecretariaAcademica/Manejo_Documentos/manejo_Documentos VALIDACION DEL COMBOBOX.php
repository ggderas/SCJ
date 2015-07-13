<DOCTYPE! html>

<head>
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="includes/css/bootstrap-glyphicons.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="includes/css/styles.css" rel="stylesheet">
    
    <!-- Include Modernizr in the head, before any other Javascript -->
    <script src="includes/js/modernizr-2.6.2.min.js"></script>

    <script language="javascript" type="text/javascript">

    function enviarReporte() 
    {
      window.location.href = "manejo.php";
    }

    </script>



</head>



<body>

  <script>

  function cambiarEstadoInput(codigoInput)
  {
   var elementoInput = document.getElementById(codigoInput);
   if($("#idTipo").val() !== "NULL")
   {  
       if(elementoInput.disabled)
       {
          elementoInput.disabled = false;  
       }
       else
       {
          elementoInput.disabled = true;
       }
   }
  }

  </script>


<div class="container">

<div class="page-header">
  <h1>Generación de Documentos</h1>
</div>


<div class="form-group">

  <div class="form-group">
    <label for="tipo-estudiante" class="control-label">Tipo de Estudiante</label>
    
    <?php    

    include '../../../Datos/conexion.php';

    // Se crea el parametro de salida
    $conectar -> query ("SET @out");

    if (!$conectar->multi_query("CALL SP_OBTENER_TIPOS_ESTUDIANTES(@out)")) {
    echo "Falló la llamada: (" . $conectar->errno . ") " . $conectar->error;
    }


?>
<select id="idTipo" onchange="cambiarEstadoInput('id-estudiante')">

<?php
do {
    
    /*Recogemos una fila de la tabla*/
    if ($res = $conectar->store_result()) { 
        // Recorre cada dato dentro de la fila

        echo '<option value="NULL">-----Seleccione una opción-----</option>';
        while ($row = mysqli_fetch_array($res,MYSQL_ASSOC)) {

        $nombre = $row['descripcion'];
              
        echo "<option value='" . $row['codigo'] . "'>" . $nombre . "</option>";

    } 

    echo '</select>';
        
        $res->free();
    } else {
        if ($conectar->errno) {
            echo "Store failed: (" . $conectar->errno . ") " . $conectar->error;
        }
    }
} while ($conectar->more_results() && $conectar->next_result());
/*El bucle se ejecuta mientras haya más resultados y se pueda saltar al siguiente*/


/*
    mysql_query("SET @out");
    $query = mysql_query("CALL SP_OBTENER_TIPOS_ESTUDIANTES(@out)");

    echo '<select>';

    while ($row = mysql_fetch_array($query,MYSQL_ASSOC)) {

        $codigo = $row['descripcion'];
              
        echo "<option>$codigo</option>";

    } 

    echo "</select>";
       

      */  

   ?>

  </div>
    
   
    <form> 

    <div class="form-group">

      <div class="row">

        <div class="col-xs-1"> 
        <label for="buscar-estudiante" class="control-label">Ingresar ID: </label>
        </div>

      <div class="input-group col-xs-4"> 

        <input type="text"  id= "id-estudiante" name="id-estudiante" class="form-control" disabled>

        <span class="input-group-btn">

        <button type="button" class="btn btn-primary "><span class="glyphicon glyphicon-search"> </span> </button>
        </span>
      
      </div>

      </div>
    </form>
    
       <div class="row">

        <div class="col-md-6">

          <div class="panel panel-primary">
            <div class="panel-heading"> <b>Resultado de la búsqueda</b></div>

              <table class = "table table-striped" >
                
                 

                <tr>
                  <th scope="row"><div align="center">Nombre </div></th>
                  <th ><div align="center">Apellidos</div></th>
                  <th ><div align="center">Nº Identidad</div></th>
                  <!-- <th ><div align="center">Tipo de Estudiante</div></th>-->              
                </tr>
                
                <?php

                include 'Datos/conexion.php';

                $query = mysql_query("SELECT CONCAT(Primer_nombre, ' ', Segundo_nombre),
                                             CONCAT( Primer_apellido, ' ', Segundo_apellido), N_identidad
                                      FROM persona
                                      WHERE (SELECT no_cuenta 
                                      FROM sa_estudiantes
                                      WHERE persona.N_identidad = sa_estudiantes.dni);");

                while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) 
                {

                    echo "<tr>\n";  

                   foreach ($row as $val) 
                   {
                      echo "<td>$val</td>";
                   }
                   echo '</tr>';
                   // $id = $row['ID_Rol'];
                }
                ?>  


              </table>
            </div>

          </div>

          <div class="col-md-6">

            <div class="panel panel-primary">
              <div class="panel-heading"><b>Estudiantes Seleccionados </b></div>
              <div class="panel-body">
                <ul class="list-group" >
            <li class="list-group-item">Op1</li>
            <li class="list-group-item">Op2</li>
            <li class="list-group-item">Op3</li>
          </ul> 
            </div>
            </div>
         
        </div>


        </div>
        

        <div class="form-group">     


        <label for="tipoDocumento">Documento: </label>
    
        <select>
            <option value="pregrado">Certificado</option>
            <option value="posgrado">Constancia</option>
        </select>
        <br/>
    </div>   

    </div>
          
</div>    

  <div class="row">

    <div class="col-md-1">
      


      <button type="button" class="btn btn-success"  onclick="enviarReporte()">Generar Reporte <a href="manejo.php"> </a> <span class="glyphicon glyphicon glyphicon-export"></span></button>



    </div>



  </div>

    </form>



</div> 


</body>



</html>

