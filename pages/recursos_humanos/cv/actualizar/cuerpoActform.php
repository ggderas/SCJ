<?php
session_start();
include "../../../../Datos/conexion.php";
if (isset($_POST['id'])) {
    $titulo = $_POST['titulo'];
    $tipo = $_POST['tipo'];
    $universidad = $_POST['universidad'];
    $identidad=$_POST['identi'];
    echo <<<HTML
<label>Típo</label>
<select id="modTipo" name="tipo" class="form-control">
HTML;
    $pa = mysql_query("SELECT Tipo_estudio FROM tipo_estudio");
    while ($row = mysql_fetch_array($pa)) {
        echo '<option value="' . $row['Tipo_estudio'] .'" ';
        if($row['Tipo_estudio'] == $_POST['tipo']){echo 'selected';}
        echo '>' . $row['Tipo_estudio'] . '</option>';
    }
echo <<<HTML
    </select>
</div></br>
<div class="form-group">
<label>Título</label>
<select id="modTitulo" name="titulo" class="form-control">
HTML;
        $pa=mysql_query("SELECT titulo FROM titulo");
        while($row=mysql_fetch_array($pa)){
            echo '<option value="' . $row['titulo'].'" ';
            if($row['titulo'] == $_POST['titulo']){echo 'selected';}
            echo '>' . $row['titulo'] . '</option>';
        }
echo <<<HTML
    </select>
</div>
<div class="form-group">
    <label>Universidad</label>
    <select id="modUniversidad" name="universidad" class="form-control">
HTML;
        $pa = mysql_query("SELECT nombre_universidad FROM universidad");
        while ($row = mysql_fetch_array($pa)) {
            echo '<option value="' . $row['nombre_universidad'].'" ';
            if($row['nombre_universidad'] == $_POST['universidad']){echo 'selected';}
            echo '>' . $row['nombre_universidad'] . '</option>';
        }
echo <<<HTML
    </select></br>
HTML;
    echo '<button class="btn btn-primary" id="btActualizar">Guardar Información</button>';
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
        x.click(actFA);
    }


    function actFA() {
        var identi = "<?php echo $identidad; ?>" ;
        data = {
            modTipo: $('#modTipo').val(),
            modTitulo: $('#modTitulo').val(),
            modUniversidad: $('#modUniversidad').val(),
            identi:identi,
            tipoProcedimiento:"actualizarFA"
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

    function inicioEnvio() {
        var x = $("#cuerpoActFA");
        x.html('Cargando...');
    }

    function llegadaSelecPersona() {
         $('body').removeClass('modal-open');
        $("#contenedor").load('pages/recursos_humanos/cv/EditarCV.php',data);
    }

    function problemas() {
        $("#cuerpoActFA").text('Problemas en el servidor.');
    }
</script>
