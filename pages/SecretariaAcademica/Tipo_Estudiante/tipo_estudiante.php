<?php

    $maindir = "../../";

  if(isset($_GET['contenido']))
    {
      $contenido = $_GET['contenido'];
    }
  else
    {
      $contenido = 'secretaria_academica';
    }

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");


if(!isset( $_SESSION['user_id'] ))
  {
    header('Location: '.$maindir.'login/logout.php?code=100');
    exit();
  }
?>

<br>

<div class="container">
  <div class="Row">
    <div class="col-md-6">
      <form>
          <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tipo de estudiante</h1>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                  <label >Número de Identidad</label>
                  <input type="text" autofocus class="form-control" id="identidad">
                </div>
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" id="nombre" disabled="False">
                </div>
                <div class="form-group">
                  <label>Tipo de estudiante</label>
                  <input type="text" class="form-control" id="nombre" disabled="False">
                </div>
                <div class="form-group">
                  <label>Seleccione nuevo tipo estudiante</label>
                <select class="form-control">
                  <option>LLENAR EL COMBOBOX CON LA BD</option>
                </select>
                </div>
                <button type="submit" class="btn btn-default">Guardar</button>
                <button type="submit" class= "btn btn-default">Cancelar</button>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>
