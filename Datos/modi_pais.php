<?php
$root = \realpath($_SERVER["DOCUMENT_ROOT"]);

include "$root\curriculo\Datos\conexion.php";

$nombre_pais = '';
$codigo = '';
$pais = '';
$row = '';

if (isset($_POST['pid'])) {

    $codigo = $_POST['pid'];
    $pa = mysql_query("SELECT * FROM pais WHERE Id_pais='$codigo'");
    if ($row = mysql_fetch_array($pa)) {
        $existe = TRUE;
        $codigo = $row['Id_pais'];
        $nombre_pais = $row['Nombre_pais'];
        $boton = 'Actualizar Informacion';
    }
}
?>
<!--mysql_connect("localhost","root",""); 
mysql_select_db("sistema_ciencias_juridicas"); -->


<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
	

</head>

<body>



    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Actualizacion de datos Universidad</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Llene los campos a continuación solicitados
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">

                            <form role="form" action="" method='POST'>

                                <div class="form-group">

                                    <label>ID Pais</label>

                                    <input type="text" name="id" class="form-control" autocomplete="off" required value="<?php echo $codigo; ?>"  disabled>


                                </div>


                                <div class="form-group">
                                    <label>Nombre del pais</label>
                                    <input type="text" name="nombre_pais" class="form-control" autocomplete="off" required value="<?php echo $nombre_pais; ?>"><br>

                                </div>






                                <button type="submit" class="btn btn-primary" class="icon-ok" >Actualizar</button>


                                <button type="button" class="btn btn-default"  onClick="location.href='Pais.php'"  >Cancelar</button>










                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-6">
                            <form role="form">
                                <fieldset enabled>

                                    <h4>Ejemplo Universidades </h4>
                                    <ol>
                                        <li>UNAH</li>
                                        <li>Unitec</li>
                                        <li>José Cecilio del Valle</li>
                                    </ol>										 
                                </fieldset>
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>




</body>

</html>