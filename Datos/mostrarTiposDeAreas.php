<?php
include '../Datos/conexion.php';

$query = mysql_query("Select * from tipo_area", $enlace);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body>
        <div>
            <select class="form-control" id="tipoArea">
                <option value="0">Seleccione</option>
                <?php
                $contador = 0;
                while ($row = mysql_fetch_array($query)) {
                    echo'<option name="'.$contador.'" Value="'.$row['id_Tipo_Area'].'">' . $row['nombre'] . '</option>';
                    $contador++;
                }
                ?>
            </select>
        </div>
    </body>
</html>
