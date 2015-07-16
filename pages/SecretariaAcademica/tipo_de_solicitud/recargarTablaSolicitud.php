 <?php
  include '../../../Datos/conexion.php';
?>    
<table class="table table-bordered table-hover table-striped" id="tblSolicitudes" >
  <tbody id="tbody">
    <?php
      $resultado= mysql_query("SELECT codigo, nombre FROM sa_tipos_solicitud");
      while ($row = mysql_fetch_array($resultado)) 
      {
          $codigo = $row['codigo'];
          $nom=$row['nombre'];
      ?>
        <tr height="50px">
          <td id="codigo">
            <?php echo $codigo ?>
          </td>
          <td id="nombreT">
            <?php echo $nom ?>
          </td>
          <td>
            <center>
              <button type="button"  id="editar" href="#" class="editar btn btn-primary glyphicon glyphicon-edit"  data-toggle="modal" data-target="#editarModal" data-whatever="@mdo"></button>
            </center>
          </td>
          <td>
            <center>
              <button type="button"  id="eliminar" href="#" class="elimina btn btn-danger glyphicon glyphicon-trash"></button>
            </center>
          </td>
        </tr>
      <?php
       } 
      ?>
  </tbody>
</table>
            