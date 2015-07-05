<?php
   include '../../Datos/conexion.php';
    $maindir = "../../";

    
  //echo $_SERVER['SERVER_NAME'];
 
  if(isset($_GET['contenido']))
    {
      $contenido = $_GET['contenido'];
     
    }
  else
    {
      $contenido = 'secretaria_academica';
   
      $navbar_loc = 'contenido';
    }

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");

  
  $rol = $_SESSION['user_rol']; 

?>
<div class="panel panel-default">
              <div class="panel-body">
              
<div class="conteiner">
  <div class="Row">
      <div class="col-md-6">
        <div class="panel panel-default">
              <div class="panel-body">
                  <div class="page-header">
                      <form>
                        <div class="form-group">
                          <label >No. Identidad</label>
                          <input class="form-control" id="identidad">
                        Estudaintes</div>
                        <div class="form-group">
                          <label >Nombres</label>
                          <input class="form-control" id="nombres">
                        </div>
                        <div class="form-group">
                          <label >Apellidos</label>
                          <input class="form-control" id="apellidos">
                        </div>
                        <div class="form-group">
                          <label >Sexo</label>
                          <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Masculino
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Femenino
                          </label>
                        </div>
                        <div class="form-group">
                          <label >Lugar de origen</label>
                          <select class="form-control">
                          <option>LLENAR EL COMBOBOX CON LA BD</option>
                        </select>
                        </div>
                        <div class="form-group">
                          <label >Residencia Actual</label>
                          <select class="form-control">
                          <option>LLENAR EL COMBOBOX CON LA BD</option>
                        </select>
                        </div>
                        <div class="form-group">
                          <label >Teléfono</label>
                          <input class="form-control" id="telefono">
                        </div>
                        <div class="form-group">
                          <label >Correo electrónico</label>
                          <input type="email" class="form-control" id="correo">
                        </div>
                        </div>
                  </div>
              </div>
           </div>
          </div>
      </div>
      
      <div class="col-md-6">
        <div class="panel panel-default">
              <div class="panel-body">
                  <div class="page-header">         
                        <div class="form-group">
                          <label >Plan de estudio</label>
                          <select class="form-control">
                          <option>LLENAR EL COMBOBOX CON LA BD</option>
                        </select>
                        </div>
                        <div class="form-group">
                          <label >Unidades valorativas</label>
                          <input class="form-control" id="unidadesValorativas">
                        </div>
                        <div class="form-group">
                          <label >Años de estudio</label>
                          <input class="form-control" id="aniosEstudio">
                        </div>
                        <div class="form-group">
                          <label >título</label>
                          <select class="form-control">
                          <option>LLENAR EL COMBOBOX CON LA BD</option>
                        </select>
                        </div>
                        <div class="form-group">
                          <label >Índice académico</label>
                          <input class="form-control" id="indiceAcademico">
                        </div>
                        <div class="form-group">
                          <label >Mención honorífica</label>
                          <select class="form-control">
                          <option>LLENAR EL COMBOBOX CON LA BD</option>
                        </select>
                        </div>
                        </div>
                        <button type="submit" class="btn btn-default">Guardar</button>
                      </form>
                  </div>
              </div>
           </div>
          </div>
      </div>
  </div>
</div> 

</div>
</div>