<?php
$idObj = $_POST['idObj'];
$idPoa= $_POST['idPOA'];
//echo $idPoa;
include '../Datos/conexion.php';

$def;
$area;
$tip;
$res;

$consulta = "SELECT * FROM objetivos_institucionales WHERE id_Objetivo=" . $idObj;

if ($resultado = $conectar->query($consulta)) {

    while ($fila = $resultado->fetch_row()) {
        $def = $fila[1];
        $area = $fila[2];
        $res = $fila[3];
        $tip = $fila[4];
    }
    $resultado->close();
}
?>

<script>


            $(document).ready(function() {
                $("#form1").submit(function(e) {
                    e.preventDefault();
                    $("#editarObjetivo").modal('hide');
                    //var pnombre = $("#titulo").val();
                    // alert(pnombre);
                    data = {def: $("#defA").val(),
                        area: $("#areaA").val(),
                        tipArea: $("#tipAreaA").val(),
                        res: $("#resA").val(),
                        idObj: $("#idObjA").val(),
                        idPOA: $("#idPOA").val(),
                    };
                    //alert($("#defA").val());
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        //contentType: "application/x-www-form-urlencoded",
                        //url: "Datos/insertarObjetivo.php",
                        //beforeSend: inicioEnvio,
                        success: llegadaActualizarObjetivo,
                        timeout: 4000,
                        error: problemasObjetivo
                    });

                    limpiarCamposObjetivos();
                    return false;

                });
            });

            function problemasObjetivo()
            {
                $("#contenedor2").text('Problemas en el servidor.');
                //$('#editarPOA').modal('show');
            }
            function llegadaActualizarObjetivo()
            {
                $("#contenedor2").load('Datos/actualizarObjetivo.php', data);
                 
                //$('#editarPOA').modal('show');
            }
        </script>
<form role='form1' id="form1" name="form1">
    <input type="hidden" id="idObjA" value="<?php echo $idObj; ?>">  
    <input type="hidden" id="idPOA" value="<?php echo $idPoa; ?>">  
    <div class="form-group">
        <label>Definición </label>
        <textarea id="defA" class="form-control" rows="2" required> <?php echo $def; ?></textarea>
    </div>
    <div class="form-group">
        <label>Area Estrategica </label>
        <textarea id="areaA" class="form-control" rows="2" required> <?php echo $area; ?></textarea>
    </div>
    <div class="form-group">
        <label>Resultado</label>
        <textarea id="resA" class="form-control" rows="2" required> <?php echo $res; ?></textarea>
    </div>
    <div class="form-group">
        <label>Area a la que pertenece </label>
        <select id="tipAreaA" class="form-control"  >
            <option value="0">Seleccione..</option>
<?php
$consulta = "SELECT * FROM area";

if ($resultado = $conectar->query($consulta)) {

    while ($fila = $resultado->fetch_row()) {
        
        $id = $fila[0];
        $area = $fila[1];
        if($id==$tip){
         ?>
            <option selected value="<?php echo $id; ?>"><?php echo $area; ?></option>
        <?php   
        }else{
        ?>
            <option value="<?php echo $id; ?>"><?php echo $area; ?></option>
        <?php
        
        }

    }
    $resultado->close();
}
?>

        </select>
    </div>
    <div class="modal-footer">
        <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button  class="btn btn-primary" >Guardar</button>
    </div>

</form>



<?php $conectar->close(); ?>