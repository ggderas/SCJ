<?php

function limpiar($tags)
{
    $tags = strip_tags($tags);
    return $tags;
    
    
}




//Información Personal
if(isset($_POST['agregarPE'])){
if (!empty($_POST['identidad']) and !empty($_POST['primerNombre']) and !empty($_POST['primerApellido']) and !empty($_POST['segundoApellido'])
    and !empty($_POST['email'])
) {
    $identi = limpiar($_POST['identidad']);
    $pNombre = limpiar($_POST['primerNombre']);
    $sNombre = limpiar($_POST['segundoNombre']);
    $pApellido = limpiar($_POST['primerApellido']);
    $sApellido = limpiar($_POST['segundoApellido']);
    $fNac = limpiar($_POST['fecha']);
    $sexo = $_POST['sexo'];
    $direc = limpiar($_POST['direccion']);
    $email = limpiar($_POST['email']);
    $estCivil = $_POST['estCivil'];
    $nacionalidad = $_POST['nacionalidad'];

    
    
       
         $queryIP=mysql_query("INSERT INTO persona (N_identidad, Primer_nombre, Segundo_nombre, Primer_apellido,
                Segundo_apellido, Fecha_nacimiento, Sexo, Direccion, Correo_electronico, Estado_Civil, Nacionalidad)
                VALUES ('$identi', '$pNombre','$sNombre','$pApellido','$sApellido','$fNac','$sexo','$direc', '$email', '$estCivil','$nacionalidad')");
            
             if($queryIP){
        
           $mensaje = " ".$pNombre . " " . $pApellido . " ha sido agregado(a) con éxito!";
            $codMensaje = 1;
    
    
   }else{
           $mensaje = 'error al ingresar el registro o registro actualmente existente';
           $codMensaje = 0;
       
   }
            
           
          
        
        
            
}
}


//Idioma
if (isset($_POST['identi']) and isset($_POST['agregarIDI'])) {
    $identidad = $_POST['identi'];
    $idioma = $_POST['idioma'];
    $nivel = $_POST['nivel'];

    $r = mysql_query("SELECT ID_Idioma FROM idioma WHERE Idioma = '".$idioma."'");
    if ($row = mysql_fetch_array($r)) {
        $idIdioma = $row['ID_Idioma'];

        $queryIDI = mysql_query("INSERT INTO idioma_has_persona (Id, ID_Idioma, N_identidad, Nivel) VALUES (DEFAULT,'".$idIdioma."','".$identidad."','".$nivel."')");

        if($queryIDI){

            $mensaje = 'Idioma ha sido agregada con éxito!';
            $codMensaje = 1;


        }else{
            $mensaje = 'error al ingresar el registro de idioma';
            $codMensaje = 0;

        }
    }
}

//Formación Académica
if (isset($_POST['identi']) and isset($_POST['agregarFA'])) {
    
  
    
    $tipoE = $_POST['tipoEFA'];
   
   
    
    $nomTitulo = $_POST['tituloFA'];
   
    $idUni = $_POST['universidadFA'];
   
    $identidad = $_POST['identi'];
 

    $queryFAA=mysql_query("INSERT INTO estudios_academico (ID_Estudios_academico, Nombre_titulo,ID_Tipo_estudio, N_identidad, Id_universidad)
                    VALUES (DEFAULT,'".$nomTitulo."','".$tipoE."','".$identidad."','".$idUni."')");
    
  
    
        if($queryFAA){
        
           $mensaje = 'Formación Académica ha sido agregada con éxito!';
            $codMensaje = 1;
    
    
   }else{
           $mensaje = 'error al ingresar el registro de formacion academica ';
           $codMensaje = 0;
       
   }

    
  
}

//Experiencia laboral
if (isset($_POST['agregarEL'])) {
    $nomEmp = $_POST['nombreEmpresa'];
    $tiempo = $_POST['tiempoLab'];
    $identi = $_POST['identi'];
    $cargo  = $_POST['cargoEL'];

   $queryELA=mysql_query("INSERT INTO experiencia_laboral (ID_Experiencia_laboral, Nombre_empresa, Tiempo, N_identidad)
                            VALUES (DEFAULT,'$nomEmp','$tiempo','$identi')");
    
    
            if($queryELA){
                
                
                
                $rs = mysql_query("SELECT MAX(ID_Experiencia_laboral) AS id FROM experiencia_laboral");
               
                if ($row = mysql_fetch_row($rs)) {
                   
                    
                $idEperiencia = trim($row[0]);
               
                
                        
                
                  
                 $query2=mysql_query("INSERT INTO `experiencia_laboral_has_cargo`(`ID_Experiencia_laboral`, `ID_cargo`) VALUES ('$idEperiencia','$cargo')");
                 
                 if($query2){
                     
                  $mensaje = 'Experiencia laboral ha sido agregada con éxito!!';
                  $codMensaje = 1;
                     
                 }else{
                     
                   $mensaje = 'error al ingresar el registro de experiencia laboral ';
                   $codMensaje = 0;
                     
                     
                 }
                
               
                }else{
                    $mensaje = 'error al ingresar el registro de experiencia laboral ';
                   $codMensaje = 0;
                    
                }
        
         
    
    
   }else{
           $mensaje = 'error al ingresar el registro de experiencia laboral ';
           $codMensaje = 0;
       
   }
    
    
}

//Experiencia Académica
if (isset($_POST['agregarEA'])) {
    $nomInst = $_POST['nombreInst'];
    $tiempo = $_POST['tiempoAcad'];
    $identi = $_POST['identi'];
    $idClase = $_POST['clases'];
    
    $queryEAA=mysql_query("INSERT INTO experiencia_academica (ID_Experiencia_academica, Institucion, Tiempo, N_identidad)
                                    VALUES (DEFAULT,'$nomInst','$tiempo','$identi')");
    
   if($queryEAA){
       
       
       $rs = mysql_query("SELECT MAX(ID_Experiencia_academica) AS id FROM experiencia_academica");
               
          if ($row = mysql_fetch_row($rs)) {
                   
                    
                $idExAca = trim($row[0]);
                
                echo "$idExAca";
                echo "$idClase";
                
             $query3 =   mysql_query("INSERT INTO `clases_has_experiencia_academica`(`ID_Clases`, `ID_Experiencia_academica`) VALUES ('$idClase','$idExAca')"); 
       if($query3){
       
           $mensaje = 'Experiencia académica ha sido agregada con éxito!!';
            $codMensaje = 1;
            
             }else{
                
            $mensaje = 'error al ingresar el registro de experiencia academica 3';
           $codMensaje = 0;
                
           }
            
        }else{
                 
           $mensaje = 'error al ingresar el registro de experiencia academica 2';
           $codMensaje = 0;
                    
                }
    
   }else{
           $mensaje = 'error al ingresar el registro de experiencia academica 1';
           $codMensaje = 0;
       
   }
    
   
    
    
    
    
}


//numeros de telefono
if(isset($_POST['agregarTEL'])){
if (!empty($_POST['identi']) and !empty($_POST['telef']) ) {
    $tipo = $_POST['tipo'];
    $telef = $_POST['telef'];
    $identi = $_POST['identi'];
    
    
   $queryAT=mysql_query("INSERT INTO telefono (ID_Telefono, Tipo, Numero, N_identidad)
             VALUES (DEFAULT,'$tipo','$telef','$identi')");
   
    if($queryAT){
        
           $mensaje = 'Teléfono ha sido agregado con éxito!';
            $codMensaje = 1;
    
    
   }else{
           $mensaje = 'error al ingresar el registro de numero telefonico';
           $codMensaje = 0;
       
   }
}else{
    $mensaje = 'error al ingresar el registro de numero telefonico campos vacios o errores con servidor';
           $codMensaje = 0;
    
}
}
?>
