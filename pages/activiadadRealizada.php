<?php

$idAct=$_POST['idAct'];

echo $idAct;

?>
<script>


            $(document).ready(function() {
                $("form").submit(function(e) {
                    e.preventDefault();
                    //$("#actividadRealizada").modal('hide');
                    //var pnombre = $("#titulo").val();
                    // alert(pnombre);
                    data = {
                        idAct: $("#idAct").val(),
                        obs: $("#obs").val()
                    };
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        //contentType: "application/x-www-form-urlencoded",
                        //url: "Datos/insertarPOA.php",
                        //beforeSend: inicioEnvio,
                        success: llegadaFinalizarActividad,
                        //timeout: 4000,
                        //error: problemas
                    });
                    ocultarModal();
                    return false;

                });
            });
            
            
            function ocultarModal() {
    $('body').removeClass('modal-open');

    escape.call(this)

    this.$element
            .trigger('hide')
            .removeClass('in')
    $.support.transition && this.$element.hasClass('fade') ?
            hideWithTransition.call(this) :
            hideModal.call(this)
}

            function llegadaFinalizarActividad()
            {
                $("#contenedor").load('Datos/insertarActividadRealizada.php', data);
                //$('#editarPOA').modal('show');
            }
        </script>


<form role='form' id="form" name="form">
 <input type="hidden" id="idAct" value="<?php echo $idAct; ?>"> 
    <div class="form-group">
        <label>Por favor Dejenos una Observacion</label>
        <textarea id="obs" class="form-control" rows="3"></textarea>
    </div>


    <div class="modal-footer">

       <button  class="btn btn-primary" >Guardar</button>

    </div>

</form>

