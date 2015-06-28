<?php

   // include '../Datos/conexion.php';

     require_once('funciones.php');
	
	$nombre='';	
	$apellido='';
	$id='';
	$pais='';
        $existeEmpleado='';
    
 
	
	$enlace = mysql_connect('localhost', 'root', '');
        mysql_select_db("sistema_ciencias_juridicas", $enlace);
	
	  if (isset($_POST['idempleado'])) 
    {
	  $codE=$_POST['idempleado'];
         
          
	  $pa = mysql_query("SELECT * FROM empleado inner join persona on persona.N_identidad=empleado.N_identidad WHERE No_Empleado='".$codE."'");
         
      //$pa=mysql_query("SELECT * FROM persona WHERE N_identidad='$id'");			  
		if($row=mysql_fetch_array($pa)){
                    
                   // $row2=mysql_fetch_array($pa2);
                            
			$existeEmpleado=1;
			$nombre=$row['Primer_nombre'] ;
                        $apellido=$row['Primer_apellido'] ;
                        $id=$row['N_identidad'] ;
                       //$idG=$row2['ID_Grupo_o_comite'];
			//echo $nombre;
			
		
                      echo <<<HTML
                        
                                <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Datos Empleado
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">       


                          <form role="form" action="#" method="Post">
                           <div class="form-group">
                                        <label>Numero de identidad</label>
                                        <input class="form-control" name="n_identidad" id="idp" value= "$id"  readonly> <!-- agregue el atrributo name que mediante este vas a poder acceder al valor de la etiqueta -->

                                    </div>

                                    <div class="form-group">
                                        <label>Primer Nombre</label>
                                        <input class="form-control" name="Primer_nombre" value= "$nombre "  readonly> <!-- agregue el atrributo name que mediante este vas a poder acceder al valor de la etiqueta -->

                                    </div>


                                    <div class="form-group">
                                        <label>Primer Apellido</label>
                                        <input class="form-control" name="Primer_apellido" value= "$apellido"  readonly> <!-- agregue el atrributo name que mediante este vas a poder acceder al valor de la etiqueta -->

                                    </div>
                              
                            
                              
                              
                              </form>
                                                        </div>
                            <!-- /.col-lg-6 (nested) -->

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
                           
                              
                              
HTML;
                        
                        
                        
		}
                else{
                   $existeEmpleado=0; 
               echo mensajes('No se encontro ningun registro','azul');

                    
                }
    }
    

    
   ?>
