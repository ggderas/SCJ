<?php

 if(isset($_POST['identi2'])){
     
     
     $temp1 = $_POST['identi'] ;
     $temp2 = $_POST['identi2'];

        $queryIP = mysql_query("UPDATE persona SET N_identidad = '$temp2' WHERE N_identidad = '$temp1'");
        
      
        
             if($queryIP){
        
           $mensaje = " El numero de identificacion se ha actualizado con éxito!";
            $codMensaje = 1;
            
            
            
            
            
            
                  
            $identi= $temp2;
            $s = mysql_query("SELECT * FROM persona WHERE N_identidad = '".$identi."'");
            if($row = mysql_fetch_array($s)){
                $id = $row['N_identidad'];
                $pNombre = $row['Primer_nombre'];
                $sNombre = $row['Segundo_nombre'];
                $pApellido = $row['Primer_apellido'];
                $sApellido = $row['Segundo_apellido'];
                $fNac = $row['Fecha_nacimiento'];
                $sexo = $row['Sexo'];
                $direc = $row['Direccion'];
                $email = $row['Correo_electronico'];
                $estCivil = $row['Estado_Civil'];
                $nacionalidad = $row['Nacionalidad'];

          
            }
        
            
            
            
            
            
            
    
    
   }else{
           $mensaje = 'error al actualizar o identificacion actualmente existente';
           $codMensaje = 0;
       
   }
   
   
   
   
   
 }
 