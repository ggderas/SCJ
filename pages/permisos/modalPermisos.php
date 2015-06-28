<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
</head>

</div>

 <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	  <form role="form" id="form" name="form" action="#">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-floppy-disk"></i> Justificación de denegación </h4>
      </div>
              <div class="modal-body">
                  <div class="form-group">
                      <div class="input-group">
                              <div class="input-group">
								  <input id="Permiso" type="text" class="form-control" placeholder="Justificacion de Deniego" value = "<?php echo $idP?>"  required>
                                  <input id="observacion" type="text" class="form-control" placeholder="Justificacion de Deniego"    required>
                                  <span class="input-group-btn">
                                      <button id="guardarJ" class="guardarJ btn btn-primary" type="button">Finalizar</button>
                                  </span>
                              </div>
                           
                        
                      </div>   
                       
                  </div>
                  
              </div>
           <!--  <div class="modal-footer clearfix">
            <button name="submit" id="submit" class="insertarbg btn btn-primary pull-left"><i class="glyphicon glyphicon-pencil"></i> Insertar</button>
          </div>
           -->
                
                    
          </form>
    
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>