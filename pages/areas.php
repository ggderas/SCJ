<!doctype html>
<html>
    <head>

    </head>
    <body>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Areas
                    </div>
                    <!-- .panel-heading -->
                    <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-lg-8">
                                        <button id="nuevaA" class="btn btn-success" data-toggle="modal" data-target="#modalNuevaArea">
                                            Nueva Area
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <label >Mis Areas</label>
                                    </h4>
                                </div>
                                <div >
                                    <div id="contenedor2" class="panel-body">
                                        <?php
                                        include '../Datos/mostrarAreas.php';
                                        ?>
                                    </div>
                                </div>
                            </div> 

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalNuevaArea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form role="form" id="form1" name="form" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Nueva Area</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nombre del Area</label>
                                    <input id="nombreDeArea" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <?php
                                    include '../Datos/mostrarTiposDeAreas.php';
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>Observacion</label>
                                    <textarea id="observacionDeArea" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button  id="guardarArea" class="btn btn-primary" >Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </body>
    <script>
        $(document).ready(function() {
            
            $("#nuevaA").click(function(){
             $("#nombreDeArea").val("");
             $("#tipoArea").val(0);
             $("#observacionDeArea").val(""); 
            });
            

            $("#form1").submit(function(e) {
                e.preventDefault();
                $("#modalNuevaArea").modal('hide');
                datosDeArea = {nombreDA: $("#nombreDeArea").val(),
                    tipoDA: $("#tipoArea").val(),
                    observacionDA: $("#observacionDeArea").val()
                };
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    //contentType: "application/x-www-form-urlencoded",
                    //url: "Datos/insertarArea.php",
                    //beforeSend: inicioEnvio,
                    success: guardarArea,
                    timeout: 4000,
                    error: problemas
                });

                //limpiarCamposArea();
                return false;
            });


            function guardarArea()
            {
                $("#contenedor2").load('Datos/insertarArea.php', datosDeArea);
            }

            function problemas()
            {
                var x = $("#contenedor2");
                x.html('problemas en el Servidor...');
            }
        });

    </script>
</html>
