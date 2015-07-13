<?php
$idSubAct = $_POST['idSubAct'];
//echo $idSubAct;
?>





<form role='form' id="form" name="form">
 <input type="hidden" id="idSubAct" value="<?php echo $idSubAct; ?>"> 
    <div class="form-group">
        <label>Por favor Dejenos una Observacion Observacion</label>
        <textarea id="obs" class="form-control" rows="3"></textarea>
    </div>


    <div class="modal-footer">

        <button   class="btn btn-primary" >Finalizar Sub Actividad</button>

    </div>

</form>




<script>


            $(document).ready(function() {
                
                
                $("form").submit(function(e) {
                    e.preventDefault();
                    //$("#subActividadRealizada").modal('hide');
                    //var pnombre = $("#titulo").val();
                    // alert(pnombre);
                    data = {
                        idSubAct: $("#idSubAct").val(),
                        obs: $("#obs").val()
                    };
                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: "Datos/insertarPOA.php",
                       // beforeSend: inicioEnvio,
                        success: llegadaFinalizarSubActividad,
                        timeout: 4000,
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

            function llegadaFinalizarSubActividad()
            {
                
                $("#contenedor").load('Datos/insertarSubActividadRealizada.php', data);
                //$("#subActividadRealizada").modal('hide');
            }
        </script>


