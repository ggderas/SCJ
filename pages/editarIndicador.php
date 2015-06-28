<?php
$idObj = $_POST['idObj'];
$idInd = $_POST['idInd'];
//echo $idObj . " " . $idInd;
include '../Datos/conexion.php';

$nom;
$des;

$consulta = "SELECT * FROM indicadores WHERE id_Indicadores=" . $idInd;

if ($resultado = $conectar->query($consulta)) {

    while ($fila = $resultado->fetch_row()) {
        $nom = $fila[2];
        $des = $fila[3];
    }
    $resultado->close();
}
?>
<script>


            $(document).ready(function() {
                $("#form4").submit(function(e) {
                    e.preventDefault();
                    $("#editarIndicador").modal('hide');
                    //var pnombre = $("#titulo").val();
                    // alert(pnombre);
                    $("#myModal").modal('hide');
                    data = {nombre: $("#indicadorA").val(),
                    def: $("#definicionA").val(),
                    idObj: $("#idObjA").val(),
                    idInd:$("#idIndA").val()

                };
                    //alert($("#defA").val());
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        //contentType: "application/x-www-form-urlencoded",
                        //url: "Datos/insertarObjetivo.php",
                        //beforeSend: inicioEnvio,
                        success: llegadaActualizarIndicador,
                        timeout: 4000,
                        error: problemasIndicador
                    });

                    //limpiarCamposObjetivos();
                    return false;

                });
            });

            function problemasIndicador()
            {
                $("#contenedor2").text('Problemas en el servidor.');
                //$('#editarPOA').modal('show');
            }
            function llegadaActualizarIndicador()
            {
                $("#contenedor2").load('Datos/actualizarIndicador.php', data);
                 
                //$('#editarPOA').modal('show');
            }
        </script>


<form id="form4" role='form4' name="form4">
    
    <input type="hidden" id="idObjA" value="<?php echo $idObj; ?>">  
    <input type="hidden" id="idIndA" value="<?php echo $idInd; ?>">  

    <div class="form-group">
        <label>Indicador</label>
        <textarea id="indicadorA" class="form-control" rows="2" required><?php echo $nom; ?></textarea>
    </div>
    <div class="form-group">
        <label>Descripcion</label>
        <textarea id="definicionA" class="form-control" rows="2" required><?php echo $des; ?></textarea>
    </div>                                                    





    <div class="modal-footer">
        <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button  class="btn btn-primary" >Guardar</button>
    </div>

</form>
