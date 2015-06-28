<?php
session_start();
include "../../../../Datos/conexion.php";
if (isset($_POST['id'])) {
    $idioma = $_POST['idioma'];
    $nivel = $_POST['nivel'];
    $identidad= $_POST['identi'];
    echo <<<HTML
<label>Idioma</label>
<select id="modIdioma" name="modIdioma" class="form-control">
HTML;
    $pa = mysql_query("SELECT Idioma FROM idioma");
    while ($row = mysql_fetch_array($pa)) {
        echo '<option value="' . $row['Idioma'] .'" ';
        if($row['Idioma'] == $_POST['idioma']){echo 'selected';}
        echo '>' . $row['Idioma'] . '</option>';
    }
    echo <<<HTML
    </select>
</div></br>
<div class="form-group">
    <label>Nivel de dominio (0-99)</label>
    <input class="form-control" name="modNivel" id="modNivel" maxlength="2" required></br>
HTML;
    echo '<button class="btn btn-primary" id="btActualizar">Guardar Información</button>
</div>
<script src="pages/recursos_humanos/cv/validacion.js"></script>
    <script>
        $(function(){
            $("#modNivel").validCampo("0123456789");
        });
</script>';
    $_SESSION['id'] = $_POST['id'];
}
?>

<script>

    var x;
    x = $(document);
    x.ready(inicio);

    function inicio() {
        var x;
        x = $("#btActualizar");
        x.click(actIDI);
    }


    function actIDI() {
        var identi = "<?php echo $identidad; ?>" ;
        data = {
            modIdioma: $('#modIdioma').val(),
            modNivel: $('#modNivel').val(),
            identi:identi,
            tipoProcedimiento:'actualizarIDI'
        };

        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            beforeSend: inicioEnvio,
            success: llegadaSelecIDI,
            timeout: 4000,
            error: problemas
        });
        return false;
    }

    function inicioEnvio() {
        var x = $("#cuerpoActIDI");
        x.html('Cargando...');
    }

    function llegadaSelecIDI() {
        $('body').removeClass('modal-open');
          $("#contenedor").load('pages/recursos_humanos/cv/EditarCV.php',data);
    }

    function problemas() {
        $("#cuerpoActIDI").text('Problemas en el servidor.');
    }
</script>
