<?php
session_start();
//include "../../../../Datos/conexion.php";

        //Información Personal
	  	if(isset($_POST['id'])){
            //Borrar persona
                $identi = $_POST['id'];
                mysql_query("DELETE FROM telefono WHERE N_identidad = '$identi'");
                mysql_query("DELETE FROM empleado WHERE N_identidad = '$identi'");
                mysql_query("DELETE FROM estudios_academico WHERE N_identidad ='$identi'");
                mysql_query("DELETE FROM experiencia_laboral WHERE N_identidad ='$identi'");
                mysql_query("DELETE FROM experiencia_academica WHERE N_identidad ='$identi'");
                mysql_query("DELETE FROM telefono WHERE N_identidad = '$identi'");
                mysql_query("DELETE FROM persona WHERE N_identidad = '$identi'");
                echo "La persona se ha eliminado correctamente!";
        }
        
        
        
        if(isset($_POST['IdTel'])){
                $idtelefono = $_POST['IdTel'];
                $queryETEL=mysql_query("DELETE FROM telefono WHERE ID_telefono = '$idtelefono'");
                if($queryETEL){
                    
                      $mensaje = 'Registro telefonico eliminado';
                      $codMensaje = 1;
                    
               
                }else{
                    
                      $mensaje = 'Error eliminando el registro seleccionado';
                      $codMensaje = 0;
                    
                    
                }
        }

        //Formación Académica
        if(isset($_POST['IdForAc'])){
                $idFA = $_POST['IdForAc'];
               $queryEFA= mysql_query("DELETE FROM estudios_academico WHERE ID_Estudios_academico = '$idFA'");
               
               if($queryEFA){
                   
                    $mensaje = 'La formación académica se ha eliminado correctamente!';
                      $codMensaje = 1;
              
                
               }else{
                   
                    $mensaje = 'Error eliminando el registro seleccionado';
                      $codMensaje = 0;
                   
               }
                
        }

        //Experiencia laboral
        if(isset($_POST['IdExLA'])){
                $idel = $_POST['IdExLA'];
                $queryEEL= mysql_query("DELETE FROM experiencia_laboral WHERE ID_experiencia_laboral = '$idel'");
                
                if($queryEEL){
                      $mensaje = 'La experiencia laboral se ha eliminado correctamente!';
                      $codMensaje = 1;
                    
                
                }else{
                    
                      $mensaje = 'Error eliminando el registro seleccionado';
                      $codMensaje = 0;
                    
                    
                }
        }

        //Experiencia Académica
        if(isset($_POST['IdExAc'])){
                $idexac = $_POST['IdExAc'];
                $queryEEA=mysql_query("DELETE FROM experiencia_academica WHERE ID_Experiencia_academica = '$idexac'");
                
                   if($queryEEA){
                      $mensaje = 'La experiencia académica se ha eliminado correctamente!';
                      $codMensaje = 1;
                    
                
                }else{
                    
                      $mensaje = 'Error eliminando el registro seleccionado';
                      $codMensaje = 0;
                    
                    
                }
                
           
        }
        
        //eliminar idioma selecionado
           if(isset($_POST['idIdioma'])){
            $id = $_POST['idIdioma'];
            $queryEIDI= mysql_query("DELETE FROM idioma_has_persona WHERE Id = '$id'");

            if($queryEIDI){

                $mensaje = 'El idioma se ha eliminado correctamente!';
                $codMensaje = 1;


            }else{

                $mensaje = 'Error eliminando el registro seleccionado';
                $codMensaje = 0;

            }

        }
        
       
?>

