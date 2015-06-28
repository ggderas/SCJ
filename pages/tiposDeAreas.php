<!doctype html>
<html>
    <head>
    </head>
    <body>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      Tipos de Areas
                    </div>
                    <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-lg-8">
                                        <button id="nuevoTipoArea" class="btn btn-success" data-toggle="modal" data-target="#modalNuevoTipoArea">
                                            Nuevo Tipo De Area
                                        </button>
                                    </div>
                                </div>
                                <div id="miContenedor">
                                </div>                        <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <label >Mis Areas</label>
                                        </h4>
                                    </div>
                                    <div >
                                        <div id="contenedorTiposDeArea" class="panel-body">
                                            <?php
                                            include '../Datos/mostrarTipos.php';
                                            ?>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalNuevoTipoArea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form role="form" id="form2" name="form" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Nuevo Plan Operativo Anual</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nombre del Tipo de Area</label>
                                        <input id="nombreDeTArea" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Observacion</label>
                                        <textarea id="observacionDeTArea" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button  id="guardarR" class="btn btn-primary" >Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
                
                                <div class="modal fade" id="modalNuevoTipoArea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form role="form" id="form2" name="form" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Nuevo Plan Operativo Anual</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nombre del Tipo de Area</label>
                                        <input id="nombreDeTArea" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Observacion</label>
                                        <textarea id="observacionDeTArea" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button  id="guardarR" class="btn btn-primary" >Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 



            </div>
        </div>
    </body>
    <script type="text/javascript">
        $(document).ready(function() {
            
            $("#nuevoTipoArea").click(function(){
                  $("#nombreDeTArea").val("");
                  $("#observacionDeTArea").val(""); 
            });
            
            $("#form2").submit(function(e) {
                e.preventDefault();
                $("#modalNuevoTipoArea").modal('hide');
                datosDeTArea = {nombreDTA: $("#nombreDeTArea").val(),
                    observacionDTA: $("#observacionDeTArea").val()
                };


                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    //contentType: "application/x-www-form-urlencoded",
                    //url: "Datos/insertarArea.php",
                    //beforeSend: inicioEnvio,
                    success: guardarTArea,
                    timeout: 4000,
                    error: problemasT
                });
                //limpiarCamposArea();
                return false;
            });

            function guardarTArea()
            {
                $("#contenedorTiposDeArea").load('Datos/insertarTipoDeArea.php', datosDeTArea);
            }

            function problemasT()
            {
                var x = $("#contenedorTiposDeArea");
                x.html('Error!!');
            }

        });

    </script>

</html>
