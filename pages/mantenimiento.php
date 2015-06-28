
<script src="js/funcionesDeAreas.js"></script>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                agregar Area
            </div>
            <!-- .panel-heading -->
            <div class="panel-body">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-lg-8">
                                <button id="nuevaArea" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                    Nueva Area
                                </button>
                                <div style="float:right; margin-bottom: 1em;">
                                    <button  id="nuevoTipo" class="btn btn-success" type="button" data-toggle="modal" data-target="#ventanaAreas">Nuevo Tipo de Area</button>
                                </div>
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

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Nueva Area</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form1" role="form1" name="form1">
                            <div class="form-group">
                                <label>Nombre del Area</label>
                                <input id="nombreDeArea" class="form-control" required>
                                <div class="form-group">
                                    <label>Tipo de Area</label>
                                    <div id="tipos" class="form-group">
                                        <?php
                                        include '../Datos/mostrarTiposDeAreas.php';
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Observacion</label>
                                    <textarea id="observacionDeArea" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button class="btn btn-success fa-save" ><i></i>Guardar</button>
                                </div>

                            </div>
                    </div>

                    </form>

                </div>
            </div>
        </div>
        <div class="modal fade" id="ventanaAreas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Nuevo Tipo de Area</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form2" role="form2" name="form2">
                            <div class="form-group">
                                <label>Nombre del Tipo de Area</label>
                                <input id="nombreTipoDeArea" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Observacion</label>
                                <textarea id="observacionTipoDeArea" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button class="btn btn-success " >Guardar</button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>  

        <div class="modal fade" id="emodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Nueva Area</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nombre del Area</label>
                            <input id="eNombreDeArea" class="form-control" required>
                            <div class="form-group">
                                <label>Tipo de Area</label>
                                <input id="eTipoDeArea" class="form-control" required>
                                <label>seleccione si desea Cambiar el Tipo</label>
                                <div id="tipos" class="form-group">
                                    <?php
                                    include '../Datos/mostrarTiposDeAreas.php';
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Observacion</label>
                                <textarea id="eObservacionDeArea" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" id="eGuardarArea" class="btn btn-success fa-save" data-dismiss="modal"><i></i>Guardar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

