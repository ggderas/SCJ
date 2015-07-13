<?php
//include "../../../../Datos/conexion.php";
session_start();
if (isset($_POST['id'])) {
    $tipo = $_POST['tipo'];
    $numero = $_POST['numero'];
    $identidad= $_POST['identi'];
   echo '<form role="form" id="form" action="#" method="POST">';
    echo '<div class="form-group">
    <label>Tipo</label>
    <select id="modTipo" class="form-control">
                                                                <option value="celular"';
    if ($tipo == "celular") echo "selected";
    echo '>Celular</option>
                                                                <option value="fijo"';
    if ($tipo == "fijo") echo "selected";
    echo '>Fijo</option>
                                                                <option value="oficina"';
    if ($tipo == "oficina") echo "selected";
    echo '>Oficina</option>
                                                                <option value="otro"';
    if ($tipo == "otro") echo "selected";
    echo '>Otro</option></select></div>';
    echo '<div class="form-group">
                                                            <label>Número de Teléfono</label>
                                                            <input id="modTel" class="form-control" value="'.$numero.'" required>
                                                        </div>';
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
            modTipo:$('#modTipo').val(),
            modTel:$('#modTel').val(),
            identi:identi,
            tipoProcedimiento:"ActualizarTel"
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
        var x = $("#cuerpoAct");
        x.html('Cargando...');
    }

    function llegadaSelecPersona()
    {
        $('body').removeClass('modal-open');
        $("#contenedor").load('pages/recursos_humanos/cv/EditarCV.php',data);
    }

    function problemas()
    {
        $("#cuerpoAct").text('Problemas en el servidor.');
    }

</script>
<script src="pages/recursos_humanos/cv/validacion.js"></script>
<script>
    $(function(){
        $('#modTel').validCampo('0123456789-+ ');
    });
</script>
