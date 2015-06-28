<?php
include "../../../../Datos/conexion.php";
session_start();
if (isset($_POST['id'])) {
    $institucion = $_POST['institucion'];
    $tiempo = $_POST['tiempo'];
    $identidad = $_POST['identi'];
      echo '<form role="form" id="form" action="#" method="POST">';
    echo '<div class="form-group">
     <label>Institución</label>
      <input id="modInst" class="form-control" value="'.$institucion.'" required>
      </div>';
    echo '<div class="form-group">
      <label>Tiempo (meses)</label>
       <input id="modTiem" class="form-control" value="'.$tiempo.'" required>
       </div>';
    
       echo <<<HTML
    <label>CLase</label>
<select id="modclase" name="clase" class="form-control">
HTML;
    $pa = mysql_query("SELECT * FROM clases");
    while ($row = mysql_fetch_array($pa)) {
        echo '<option value="' . $row['ID_Clases'] .'" ';
        if($row['Clase'] == $_POST['clase']){echo 'selected';}
        echo '>' . $row['Clase'] . '</option>';
    }
   
echo <<<HTML
    </select>
</div></br>
HTML;
    
    echo '<button class="btn btn-primary" id="btActualizar">Guardar Información</button>';
    echo '</form>';
    $_SESSION['id'] = $_POST['id'];
}
?>

<script>

  
    
    
         $( document ).ready(function() {

    $("form").submit(function(e) {
	    e.preventDefault();
            var identi = "<?php echo $identidad; ?>" ;
            
       data={
            modInst:$('#modInst').val(),
            modTiem:$('#modTiem').val(),
            modClas:$('#modclase').val(),
            identi:identi,
            tipoProcedimiento:"actualizarEA"
        };

        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            beforeSend: inicioEnvio,
            success: llegadaSelecPersona,
            timeout: 4000,
            error: problemas
        });
        return false; 
            
        });
    });



    function inicioEnvio()
    {
        var x = $("#cuerpoActEA");
        x.html('Cargando...');
    }

    function llegadaSelecPersona()
    {
         $('body').removeClass('modal-open');
         $("#contenedor").load('pages/recursos_humanos/cv/EditarCV.php',data);
    }

    function problemas()
    {
        $("#cuerpoActEA").text('Problemas en el servidor.');
    }

</script>
<script src="pages/recursos_humanos/cv/validacion.js"></script>
<script>
    $(function(){
        $('#modInst').validCampo('-+/*abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZáéíóúÁÉÍÓÚ ');
        $('#modTiem').validCampo('0123456789');
    });
</script>
