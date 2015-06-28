<?php
include '../Datos/conexion.php';
$idAct = $_POST['idAct'];
?>


<script>
    
    
    
    
    $(document).ready(function() {

                $("#form4").submit(function(e) {
                    e.preventDefault();
                    $("#myModal3").modal('hide');
                    ///alert($("#idAct").val());
                     data4 ={
                idAct:$("#idAct").val(),
                costo:$("#costoAct").val(),
                pond:$("#pondAct").val(),
                tri:$("#triAct").val(),
                
                obs:$("#obsAct").val()
                
            };  
            //alert($("#nombre").val()); 
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                //contentType: "application/x-www-form-urlencoded",
                //url:"pages/crearSubActividad.php", 
                //beforeSend:inicioSub,
                success:llegadaInsertarCostoActividad,
                timeout:4000,
                error:problemasSub
            }); 
            return false;

                });
                
    });
    
  
       


function llegadaInsertarCostoActividad()
{
    $("#costosActividad").load('Datos/insertarCostoActividad.php',data4);
    //$('#myModal2').modal('show');
}



function problemasSub()
{
    $("#costosActividad").text('Problemas en el servidor.');
}


    </script>




<form role="form4" name="form4" id="form4">
    <input type="hidden" id="idAct" value="<?php echo $idAct;?>">  
    <div class="form-group">
        <label>Costo</label>
        <input type="number" step="0.01" id="costoAct" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Ponderacion</label>
        <input type="number" step="0.01" id="pondAct" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Trimestre </label>
        <select id="triAct" class="form-control" required>
            <option value="0">Seleccione..</option>
            <option value="1">I</option>
            <option value="2">II</option>
            <option value="3">III </option>
            <option value="4">IV</option>

        </select>
    </div>


    <div class="form-group">
        <label>Observación</label>
        <textarea id="obsAct" class="form-control" rows="2"></textarea>
    </div>
    
    
    <div class="modal-footer">
    <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button  class="btn btn-primary" >Asignar</button>
</div>
    
</form>
