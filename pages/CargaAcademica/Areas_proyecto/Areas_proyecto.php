<html>
    <body> 
        <div class="row"> 
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-lg-8">
                        <button class="btn btn-success" data-toggle="modal" data-target="#myModal">Nueva area</button>
                    </div>
                </div>
            </div> 
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class= "panel-heading">
                        <h2 class="box-title">Areas</h2>
                    </div>
                </div>
                <div >
                    <div id="contenedor2" class="panel-body">
                        <?php
                        include '../../../Datos/ca_cargarAreas.php';
                        ?>
                    </div>
                </div>
            </div> 

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form role="form" id="form" name="form" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                              
                                <h4 class="modal-title" id="myModalLabel">Nuevo area</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nombre de area</label>
                                    <input id="nombreEdificio"  class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button  id="guardar" class="btn btn-primary" >Guardar</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>
            <!-- /.modal-dialog -->
        </div> 
    </body>
</html>