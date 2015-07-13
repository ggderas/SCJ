<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Módulo Curricular</title>
    <!-- CSS -->
    <?php include "../../../../Datos/conexion.php";?>
</head>

<body>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Actualizar Experiencia Laboral
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Número de identidad</label>
                    <select id="identi" name="identi" style="width: auto;">
                        <?php
                        $pa=mysql_query("SELECT N_identidad FROM persona");
                        while($row=mysql_fetch_array($pa)){
                            echo '<option value="'.$row['N_identidad'].'">'.$row['N_identidad'].'</option>';
                        }
                        ?>
                    </select>
                    <button id="seleccionar" class="btn btn-success">Seleccionar</button>
                </div>
                <!-- .panel-heading -->
                <div id="display"></div>
            </div>
            <!-- .panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<script>

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    var x;
    x = $(document);
    x.ready(inicio);

    function inicio()
    {
        var x;
        x = $("#seleccionar");
        x.click(selecPersona);
    }


    function selecPersona()
    {
        data={
            identi:$('#identi').val()
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
        var x = $("#display");
        x.html('Cargando...');
    }

    function llegadaSelecPersona()
    {
        $("#display").load('pages/recursos_humanos/cv/actualizar/expLabActualizar.php',data);
    }

    function problemas()
    {
        $("#display").text('Problemas en el servidor.');
    }

</script>

</body>

</html>



