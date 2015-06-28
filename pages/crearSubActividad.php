
<?php
include '../Datos/conexion.php';
$idAct = $_POST['idAct'];
$iniAct=$_POST['iniAct'];
$finAct=$_POST['finAct'];

?>
<script>
    
    
    
    
    $(document).ready(function() {

                $("#form2").submit(function(e) {
                    e.preventDefault();
                    
                    
                    
                    fechaSA = document.getElementById('dp1').value;
                    
                    inicioA = document.getElementById('iniAct').value;
                    finalA = document.getElementById('finAct').value;
                    inicioA = new Date(inicioA);
                    finalA = new Date(finalA);
                    fechaSA = new Date(fechaSA);
                    
                    if (fechaSA <inicioA  || fechaSA >finalA  ) {
                        alert("Fechas Erroneas");
                    } else{
                        
                    
                    $("#myModal2").modal('hide');
                     data2 ={
                idAct:$("#idAct").val(),
                nombreSub:$("#nombreSubAct").val(),
                descripcion:$("#descripcion").val(),
                fecha:$("#dp1").val(),
                encargado:$("#encargado").val(),
                porcentaje:$("#porcentaje").val(),
                costo:$("#costo").val(),
                obs:$("#observacion").val()
                
            };  
            //alert($("#nombre").val()); 
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                //contentType: "application/x-www-form-urlencoded",
                //url:"pages/crearSubActividad.php", 
                //beforeSend:inicioSub,
                success:llegadaInsertarSubActividad,
                timeout:4000,
                error:problemasSub
            }); 
            return false;
             }

                });
                   
                   
                        
                   
                    
                    
                    
                   
                
    });
    
  
       


function llegadaInsertarSubActividad()
{
    $("#subActividades").load('Datos/insertarSubActividad.php',data2);
    //$('#myModal2').modal('show');
}



function problemasSub()
{
    $("#subActividades").text('Problemas en el servidor.');
}


    </script>
    


<script>
    if (top.location != location) {
        top.location.href = document.location.href;
    }
    $(function() {
        window.prettyPrint && prettyPrint();
        $('#dp1').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayBtn: true
        }).on('show', function() {
            // Obtener valores actuales z-index de cada elemento
            var zIndexModal = $('#myModal').css('z-index');
            var zIndexFecha = $('.datepicker').css('z-index');
            //alert(zIndexModal + zIndexFEcha);
            $('.datepicker').css('z-index', zIndexModal + 1);
        });
        $('#dp2').datepicker({
            language: "es",
            format: 'yyyy-mm-dd'
        });
        $('#dp3').datepicker();
        $('#dp3').datepicker();
        $('#dpYears').datepicker();
        $('#dpMonths').datepicker();


        var startDate = new Date(2012, 1, 20);
        var endDate = new Date(2012, 1, 25);
        $('#dp4').datepicker()
                .on('changeDate', function(ev) {
                    if (ev.date.valueOf() > endDate.valueOf()) {
                        $('#alert').show().find('strong').text('The start date can not be greater then the end date');
                    } else {
                        $('#alert').hide();
                        startDate = new Date(ev.date);
                        $('#startDate').text($('#dp4').data('date'));
                    }
                    $('#dp4').datepicker('hide');
                });
        $('#dp5').datepicker()
                .on('changeDate', function(ev) {
                    if (ev.date.valueOf() < startDate.valueOf()) {
                        $('#alert').show().find('strong').text('The end date can not be less then the start date');
                    } else {
                        $('#alert').hide();
                        endDate = new Date(ev.date);
                        $('#endDate').text($('#dp5').data('date'));
                    }
                    $('#dp5').datepicker('hide');
                });

        // disabling dates
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = $('#dpd1').datepicker({
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            if (ev.date.valueOf() > checkout.date.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 1);
                checkout.setValue(newDate);
            }
            checkin.hide();
            $('#dpd2')[0].focus();
        }).data('datepicker');
        var checkout = $('#dpd2').datepicker({
            onRender: function(date) {
                return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            checkout.hide();
        }).data('datepicker');
    });
</script>


<script type="text/javascript">
    _uacct = "UA-106117-1";
    urchinTracker();
</script>

<form role="form2" id="form2" name="form2">
<input type="hidden" id="idAct" value="<?php echo $idAct;?>">  
<input type="hidden" id="iniAct" value="<?php echo $iniAct;?>">
<input type="hidden" id="finAct" value="<?php echo $finAct;?>">
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">Nombre</span>
        <input id="nombreSubAct" type="text" class="form-control" placeholder="Nombre de la Sub Actividad" required>
    </div>
</div>
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">Descripción:</span>
        <textarea rows="2" id="descripcion" class="form-control" placeholder="Puede escribir en que consiste" required ></textarea>
    </div>
</div>
<div  class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-m-d"  data-link-format="yyyy-m-d">
    <span class="input-group-addon">Fecha</span>
    <input placeholder="Fecha de Cumplimiento" type="text" class="form-control" size="5"  id="dp1" required>
    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
</div>
<br>
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">Encargado</span>
        <select class="form-control" id="encargado" required="">
            <option value="">Seleccione..</option>



            <?php
            
            
            
            
            
            
            $consulta1 = "SELECT * FROM responsables_por_actividad where id_Actividad=" . $idAct ;
            
if ($resultado1 = $conectar->query($consulta1)) {

    while ($fila1 = $resultado1->fetch_row()) {
        $idRes= $fila1[2];
       $consulta2 = "select * from empleado where No_Empleado in (select No_Empleado from grupo_o_comite_has_empleado where ID_Grupo_o_comite in (select ID_Grupo_o_comite from grupo_o_comite where ID_Grupo_o_comite='" . $idRes . "'))";
       if ($resultado2 = $conectar->query($consulta2)) {
           while ($fila2 = $resultado2->fetch_row()) {
               $idEmp=$fila2[1];
               $NoEmp=$fila2[0];
               $consulta3 = "SELECT * FROM persona where N_identidad='".$idEmp."'";
               $resultado3 = $conectar->query($consulta3);
               $fila3 = $resultado3->fetch_row();
               $nombre=$fila3[1]." ".$fila3[2]." ".$fila3[3]." ".$fila3[4];
                       
                       ?>
                    <option value="<?php echo $NoEmp ?>"><?php echo $nombre." ".$NoEmp ?></option>
                    <?php
                   
               
           }
           
       }
 
    }
    //$resultado->close();
}

//$conectar->close();
            
            
            
            
             ?>
            
            

        </select>
    </div>
</div>
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">Porcentaje</span>
        <input id="porcentaje" type="number" class="form-control" placeholder="ingrese un valor numerico"required="">
    </div>
</div>
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">Costo</span>
        <input id="costo" type="number" step="0.01" class="form-control" placeholder="costo Monetario " required="">
    </div>
</div>
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon">Observación</span>
        <textarea rows="2" id="observacion" class="form-control"></textarea>
    </div>
</div>
<div class="modal-footer">
    <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button id="guardarSubActividad" class="btn btn-primary" >Guardar</button>
</div>
 
</form>

