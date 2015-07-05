/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

  $(document).ready(function(){

    $("#SecretariaAcademica").click(function(event) {
      event.preventDefault();
      alert("entro");
          
      $("#div_contenido").load("pages/SecrerariaAcademica/SecrerariaAcademica.php");
      });
    $("#RegistroEstudiante").click(function(event) {

      event.preventDefault();
      alert("Entro");
          
      $("#contenedor" ).load( //Pantalla para ingresar un estudiante
                            );
      }); 
    $("#TipoEstudiante").click(function(event) {
      event.preventDefault();
      
      $("#contenedor").load( "pages/SecretariaAcademica/Tipo_Estudiante/tipo_estudiante.php");
      }); 

    $("#nuevaSolicitud").click(function(event) {
      event.preventDefault();
      $("#contenedor").load("pages/SecretariaAcademica/tipo_de_solicitud/tipo_de_solicitud.php"
                            );
      });

    $("#SolicitudEstudiante").click(function(event) {
      event.preventDefault();
      alert("Entro");
      $("#contenedor").load(// Pantalla para ingresar una solicitud por estudiante
                            );
      }); 

    $("#BusquedaAvanzada").click(function(event) {
      event.preventDefault();
      alert("Entro");
      $("#contenedor").load(// Pantalla para Hacer una busqueda avanzada
                            );
      });   
});
