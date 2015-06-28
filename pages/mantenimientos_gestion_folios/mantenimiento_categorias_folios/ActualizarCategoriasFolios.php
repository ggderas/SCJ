<?php

  $maindir = "../../../";

  if(isset($_GET['contenido']))
  {
    $contenido = $_GET['contenido'];
  }
  else
  {
    $contenido = 'gestion_de_folios';
	$navbar_loc = 'mantenimiento';
  }

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");
  
  require_once($maindir.'pages/navbar.php');

  require_once($maindir."conexion/config.inc.php");

  $adId_categoria = $_POST['Id_categoria'];

  try{
    $sql = "SELECT * FROM categorias_folios WHERE Id_categoria=:adId_categoria";

    $query = $db->prepare($sql);
    $query->bindParam(":adId_categoria",$adId_categoria);
    $query->execute();
    $result = $query->fetch();
    $query = null;
    $db = null;
  }catch(PDOExecption $e){

  }

?>

<div class="container-fluid">
<div class="row">
<?php 
    require_once("../../gestion_folios/navbar.php");
?>
    <div class="col-sm-10">

    <section class="content">

                <!-- Content Header (Page header) -->
                <section class="content-header no-margin">
                    <h1 class="text-center">
                        Mantenimiento de Datos
                    </h1>
                </section>

  <div class="table-responsive">
	<table border="1" class='table table-bordered table-hover'>
        <thead>
            <tr>
                <th>Id_categoria</th>
                <th>NombreCategoría</th>
                <th>DescripciónCategoría</th>
				<th>Actualización</th>
                <th>Cancelar</th>				
            </tr>
        </thead>
        <tbody>
            <tr><form action='#'>
			    <td><p id="Id_categoria"><?php echo $result['Id_categoria']; ?></p></td>
				<td><input name='NombreCategoria' id="NombreCategoria" type ='text' maxlength="50" value="<?php echo htmlentities($result['NombreCategoria']); ?>" placeholder="<?php echo htmlentities($result['NombreCategoria']); ?>" ></td>
				<td><input name='DescripcionCategoria' id="DescripcionCategoria" type ='text' maxlength="300" value="<?php echo htmlentities($result['DescripcionCategoria']); ?>" placeholder="<?php echo htmlentities($result['DescripcionCategoria']); ?>" ></td>
               <td> <button type="button" id="actulizar_CategoriasFolios" data-id=<?php echo $result['Id_categoria']; ?> class="btn btn-primary pull-left" data-mode="actualizar" >Actualizar</button></td>
			   <td><a class="btn btn-primary" data-toggle="modal" data-target="#compose-modal" data-mode="cancelar"><i class="fa fa-pencil"></i>Cancelar</a></td>
             </form>			
            </tr>
        </tbody>
    </table>
                
  </div><!-- /.table-responsive -->	

    </section><!-- /.content -->
    </div><!-- /col-10 -->                
  </div><!-- end row -->
</div><!-- end container fluid -->

<script type="text/javascript">
    $(".btn-primary").on('click',function(){
mode = $(this).data('mode');
	if(mode == "actualizar"){

            id = $(this).data('id');
            NombreCategoria=$("#NombreCategoria").val();
            DescripcionCategoria=$("#DescripcionCategoria").val();
      data={
            Id_categoria:id,
            NombreCategoria:$("#NombreCategoria").val(),
            DescripcionCategoria:$("#DescripcionCategoria").val(),
            tipoProcedimiento:"actualizar_"
          };
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_categorias_folios.php", 
                success:actualizarCategoriasFoliosFinalizado,
                timeout:4000,
          }); 
          return false;}
    });

    function actualizarCategoriasFoliosFinalizado(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_categorias_folios.php',data);
    }
</script>

<script type="text/javascript">
    $(".btn-primary").on('click',function(){
        mode = $(this).data('mode');
         if(mode == "cancelar"){       
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_categorias_folios.php", 
                success:CancelarCategoriasFolios,
                timeout:4000,
                error:problemas
          }); 
          
          return false;
        }
    });

    function CancelarCategoriasFolios(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_categorias_folios.php');
    }
</script>



<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>
