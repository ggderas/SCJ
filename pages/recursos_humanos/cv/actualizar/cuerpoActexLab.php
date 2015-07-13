<?php
include "../../../../Datos/conexion.php";
session_start();
if (isset($_POST['id'])) {
    $empresa = $_POST['empresa'];
    $tiempo = $_POST['tiempo'];
    $cargo = $_POST['cargo'];
    $identidad = $_POST['identi'];
    echo '<div class="form-group">
                      <label>Nombre de la Empresa</label>
                      <input id="modEmp" class="form-control" value="'.$empresa.'" required>
                      </div>';
    echo '<div class="form-group">
                      <label>Tiempo (meses)</label>
                       <input id="modTiem" class="form-control" value="'.$tiempo.'" required>
                       </div>';
     echo <<<HTML
    <label>Cargo</label>
<select id="modcargo" name="cargo" class="form-control">
HTML;
    $pa = mysql_query("SELECT * FROM cargo");
    while ($row = mysql_fetch_array($pa)) {
        echo '<option value="' . $row['ID_cargo'] .'" ';
        if($row['Cargo'] == $_POST['cargo']){echo 'selected';}
        echo '>' . $row['Cargo'] . '</option>';
    }
   
echo <<<HTML
    </select>
</div></br>
HTML;
    
    echo '<button class="btn btn-primary" id="btActualizar">Guardar Información</button>';
    $_SESSION['id'] = $_POST['id'];
}
?>

<script>

    var x;
    x = $(document);
    x.ready(inicio);

    function inicio()
    {
        var x;
        x = $("#btActualizar");
        x.click(actexLab);
    }


    function actexLab()
    {
         var identi = "<?php echo $identidad; ?>" ;
        data={
            modEmp:$('#modEmp').val(),
            modTiem:$('#modTiem').val(),
            modCarg:$('#modcargo').val(),
            identi:identi,
            tipoProcedimiento:"actualizarEL"
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
    }

    function inicioEnvio()
    {
        var x = $("#cuerpoActEL");
        x.html('Cargando...');
    }

    function llegadaSelecPersona()
    {
        $('body').removeClass('modal-open');
        $("#contenedor").load('pages/recursos_humanos/cv/EditarCV.php',data);
    }

    function problemas()
    {
        $("#cuerpoActEL").text('Problemas en el servidor.');
    }

</script>
<script src="pages/recursos_humanos/cv/validacion.js"></script>
<script>
    $(function(){
        $('#modEmp').validCampo('-+/*abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZáéíóúÁÉÍÓÚ ');
        $('#modTiem').validCampo('0123456789');
    });
</script>
