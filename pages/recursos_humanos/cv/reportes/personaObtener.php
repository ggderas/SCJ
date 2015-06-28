<?php
session_start();

include "../../../../Datos/conexion.php";


if (isset($_POST['identi'])) {
    $identi = $_POST['identi'];
    $_SESSION['Nidenti'] = $identi;

    $s = mysql_query("SELECT * FROM persona WHERE N_identidad = '" . $identi . "'");
    if ($row = mysql_fetch_array($s)) {
        $id = $row['N_identidad'];
        $pNombre = $row['Primer_nombre'];
        $sNombre = $row['Segundo_nombre'];
        $pApellido = $row['Primer_apellido'];
        $sApellido = $row['Segundo_apellido'];
        $fNac = $row['Fecha_nacimiento'];
        $sexo = $row['Sexo'];
        $direc = $row['Direccion'];
        $email = $row['Correo_electronico'];
        $estCivil = $row['Estado_Civil'];
        $nacionalidad = $row['Nacionalidad'];

        //Experiencia Académica
        $query = mysql_query("SELECT experiencia_academica.ID_Experiencia_academica, Institucion, Tiempo,Clase FROM experiencia_academica inner join clases_has_experiencia_academica on clases_has_experiencia_academica.ID_Experiencia_academica=experiencia_academica.ID_Experiencia_academica inner join clases on clases.ID_Clases=clases_has_experiencia_academica.ID_Clases WHERE N_identidad='".$_POST['identi']."'");
        //Formación académica
        $queryFA = mysql_query("SELECT ID_Estudios_academico, Nombre_titulo, ID_Tipo_estudio, Id_universidad FROM estudios_academico WHERE N_identidad= '".$_POST['identi']."'");
        //Experiencia laboral
        $queryEL = mysql_query("SELECT experiencia_laboral.ID_Experiencia_laboral, Nombre_empresa, Tiempo, cargo FROM experiencia_laboral inner join experiencia_laboral_has_cargo on experiencia_laboral_has_cargo.ID_Experiencia_laboral=experiencia_laboral.ID_Experiencia_laboral inner join cargo on cargo.ID_cargo=experiencia_laboral_has_cargo.ID_cargo WHERE experiencia_laboral.N_identidad='".$_POST['identi']."'");
        //numeros de telefono
        $queryTEL = mysql_query("SELECT ID_Telefono, Tipo, Numero FROM telefono WHERE N_identidad= '".$_POST['identi']."'");

        echo '<form role="form" method="post" class="form-horizontal">
                        <!-- .panel-heading -->
                        <div class="panel-body">
                            <h1>Reporte de Persona</h1><button class="btn btn-warning pull-right" data-mode="verPDF" data-id="'.$id.'" href="#">Exportar a PDF</button></br></br></br>
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <label><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Datos Generales</label>
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                <div class="col-lg-8">
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label">Número de Identidad: </label>
                                                            <div class="col-sm-7 control-label">' . $id . '</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label">Nombre Completo: </label>
                                                            <div class="col-sm-7 control-label">' . $pNombre . ' ';
        if ($sNombre != '') {
            echo $sNombre . ' ';
        }
        echo $pApellido . ' ' . $sApellido . '.</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label">Sexo: </label>';
        if ($sexo == 'F') {
            echo '<div class="col-sm-7 control-label">Femenino</div>';
        }
        if ($sexo == 'M') {
            echo '<div class="col-sm-7 control-label">Masculino</div>';
        }
        echo '</div>
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label">Nacionalidad: </label>
                                                            <div class="col-sm-7 control-label">' . $nacionalidad . '</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label"><strong>Fecha de Nacimiento</strong></label>
                                                            <div class="col-sm-7 control-label">' . $fNac . '</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label">Estado civil: </label>
                                                            <div class="col-sm-7 control-label">';
        if ($estCivil == "Soltero")
            echo 'Soltero';
        if ($estCivil == "Casado")
            echo 'Casado';
        if ($estCivil == "Divorciado")
            echo 'Divorciado';
        if ($estCivil == "Viudo")
            echo 'Viudo';
        echo '
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <label><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Información de contacto</label>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label">Dirección</label>
                                                    <div class="col-sm-7 control-label">' . $direc . '</div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label">Correo electrónico</label>
                                                    <div class="col-sm-7 control-label">' . $email . '</div>
                                                </div>
                                            </div>
<div class="col-lg-12 center">
            <table id="tabla_telefonos" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>                                            
                                      
                                            <th>Tipo</th>
                                            <th>Número</th>
                                          
                                             </tr>
                                        </thead>
                                        <tbody> ';
            

        while ($row = mysql_fetch_array($queryTEL)){
            $id = $row['ID_Telefono'];
            $tipo = $row['Tipo'];
            $numero = $row['Numero'];
         
            echo "<tr data-id='".$id."'>";
            echo <<<HTML
               
HTML;
            echo <<<HTML
                <td>$tipo</td>
HTML;
            echo <<<HTML
            <td>$numero</td>
HTML;
            echo <<<HTML
   
HTML;
            echo "</tr>";

        }
     


    echo '  </tbody>
    </table>
</div>



                                        </div>
                                    </div>
                                    
                 
                                    

                                    


                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <label><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Experiencia Académica</label>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-lg-10">
                                                         <table id="tabla_telefonos" class="table table-bordered table-striped">';
                if(mysql_num_rows($query) != 0) {
                    echo '<thead>
                                                                <tr>
                                                                <th>Institución</th>
                                                                <th>Tiempo (meses)</th>
                                                                <th>Clases</th>
                                                            </tr>
                                                            </thead>';
                }
                else echo '<thead>Vacío</thead>';
                                                            echo '<tbody>';
        while ($row = mysql_fetch_array($query)) {
            $id = $row['ID_Experiencia_academica'];
            $inst = $row['Institucion'];
            $tiempo = $row['Tiempo'];
            $clase = $row['Clase'];

            echo "<tr data-id='" . $id . "'>";
            echo <<<HTML
                <td>$inst</td>
HTML;
            echo <<<HTML
            <td>$tiempo</td>
HTML;
            echo <<<HTML
            <td>$clase</td>
HTML;
            echo "</tr>";
        }
        echo "
                    </tbody>
                    </table>
                    </div>
                    </div>
              </div>";

        echo '
              <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <label><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Formación Académica</label>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-lg-10">
                                                 <table id="tabla_formaciones" class="table table-bordered table-striped">';
        if(mysql_num_rows($queryFA) != 0) {
            echo '
                                                <thead>
                                                    <tr>
                                                    <th>Nombre del Título</th>
                                                    <th>Tipo de estudio</th>
                                                    <th>Universidad</th>
                                                </tr>
                                                </thead>';

        }
        else echo '<thead>Vacío</thead>';
        echo  '<tbody>';
        while ($row = mysql_fetch_array($queryFA)){
            $id = $row['ID_Estudios_academico'];
            $titulo = $row['Nombre_titulo'];
            $s = mysql_query("SELECT Tipo_estudio FROM tipo_estudio WHERE ID_Tipo_estudio = '".$row['ID_Tipo_estudio']."'");
            $row1 = mysql_fetch_array($s);
            $tipoEs = $row1['Tipo_estudio'];
            $t = mysql_query("SELECT nombre_universidad FROM universidad WHERE Id_universidad = '".$row['Id_universidad']."'");
            $row2 = mysql_fetch_array($t);
            $univ = $row2['nombre_universidad'];

            echo "<tr data-id='".$id."'>";
            echo <<<HTML
                <td>$titulo</td>
HTML;
            echo <<<HTML
            <td>$tipoEs</td>
HTML;
            echo <<<HTML
            <td>$univ</td>
HTML;
            echo "</tr>";
        }
        echo "</tbody>
                    </table>
                    </div>
                    </div>
              </div>";

        echo '
              <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <label><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Experiencia Laboral</label>
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-lg-10">
                                                 <table id="tabla_formaciones" class="table table-bordered table-striped">';
        if(mysql_num_rows($queryEL) != 0) {
            echo '
                                                <thead>
                                                    <tr>
                                                    <th>Nombre de la Empresa</th>
                                                    <th>Tiempo (meses)</th>
                                                    <th>Cargo</th>
                                                    
                                                </tr>
                                                </thead>';

        }
        else echo '<thead>Vacío</thead>';
        echo  '<tbody>';

        while ($row = mysql_fetch_array($queryEL)){
            $id = $row['ID_Experiencia_laboral'];
            $nomEmp = $row['Nombre_empresa'];
            $tiempo = $row['Tiempo'];
            $Cargo =  $row['cargo'];

            echo "<tr data-id='".$id."'>";
            echo <<<HTML
                <td>$nomEmp</td>
HTML;
            echo <<<HTML
            <td>$tiempo</td>
            <td>$Cargo</td>
HTML;
            echo "</tr>";

        }

        echo "</tbody>
                    </table>
                    </div>
                    </div>
              </div>";
                                echo '
                                </div>
                                </div>
                                </form>';
    }
}
?>

<?php
   //echo '<button class="btn btn-primary pull-right" data-mode="verPDF" data-id="'.$id.'" href="#">Exportar a PDF</button>';
    ?>

<script>

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    
    $( document ).ready(function() {
        
        
       $(".btn-warning").on('click',function(){
          mode = $(this).data('mode');
          iden = $(this).data('id');
          if(mode == "verPDF"){
           
			data={
          //  NroEmpleado:id
            };
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                //url:"pages/gestion_folios/crear_pdf.php", 
                success:reportePDF,
                timeout:4000,
                error:problemas
            }); 
            return false;
          }
        });
        
        
        
        
        
    });
    
    
    function reportePDF(){
		window.open('pages/recursos_humanos/cv/reportes/crearPDFpersona.php?iden='+iden);
	}
        
           function problemas()
            {
                $("#contenedor").text('Problemas en el servidor.');
            }

</script>