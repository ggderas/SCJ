<?php

$hoy = date("Y-m-d");
//echo $hoy;
include '../Datos/conexion.php';


$obs= $_POST['obs'];
$idRes= $_POST['grupo'];
$idAct= $_POST['idAct'];

$consulta=$conectar->prepare("CALL pa_insertar_responsables_por_actividad(?,?,?,?)");
$consulta->bind_param('iiss',$idAct,$idRes,$hoy,$obs);
$resultado=$consulta->execute();

if($resultado==1)
    {
    echo '<div id="resultado2" class="alert alert-success">
        Se Asigno un Responsable
         
         </div>';
    
    }else{
         echo '<div id="resultado2" class="alert alert-danger">
        No se Inserto ningun Nuevo elemento 
         
         </div>';
    }

?>

<div id="responsables" class="panel-default">
                        
                        <table class="table">
                            <thead>
                            <th></th>
                            </thead>
                        
                        <?php
                    
                    $query = mysql_query("SELECT * FROM responsables_por_actividad inner join grupo_o_comite on responsables_por_actividad.id_Responsable=grupo_o_comite.ID_Grupo_o_comite where responsables_por_actividad.id_Actividad=".$idAct,$enlace);
                    while($row = mysql_fetch_array($query)){
                        //$idgrupo = $row['ID_Grupo_o_comite'];
                        $nombre=$row['Nombre_Grupo_o_comite'];
                        ?>
                            <tr>
                                <td><?php echo $nombre; ?></td>
                                <td><a class="elimina btn btn-danger fa fa-trash-o"></a></td>
                            </tr>
                    
                    <?php
                        }
                        ?>
                    </table>
                    </div>


<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $("#resultado2").fadeOut(1500);
    },3000);
	
});
</script>