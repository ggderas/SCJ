/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

  $(document).ready(function(){

    $("#SecretariaAcademica").click(function(event) {
      event.preventDefault();
          
      $("#div_contenido").load("pages/SecretariaAcademica/SecrerariaAcademica.php");
      });
    
    $("#RegistroEstudiante").click(function(event) {

      event.preventDefault();
          
      $("#contenedor" ).load( "pages/SecretariaAcademica/RegistroEstudiantes/RegistroDeEstudiantes.php"
                            );
      }); 
    $("#TipoEstudiante").click(function(event) {
      event.preventDefault();
      
      $("#contenedor").load( "pages/SecretariaAcademica/Tipo_Estudiante/TipoEstudiante.php");
      }); 

    $("#nuevaSolicitud").click(function(event) {
      event.preventDefault();
      $("#contenedor").load("pages/SecretariaAcademica/tipo_de_solicitud/tipoSolicitud.php"
                            );
      });

    $("#SolicitudEstudiante").click(function(event) {
      event.preventDefault();
      
      $("#contenedor").load("pages/SecretariaAcademica/NuevaSolicitud/nuevaSolicitud.php"
                            );
      }); 

    $("#BusquedaAvanzada").click(function(event) {
      event.preventDefault();
      $("#contenedor").load( "pages/SecretariaAcademica/BusquedaAvanzada/BusquedaAvanzada.php"
                            );
      });

    $("#ManejoDocuementos").click(function(event) {
      event.preventDefault();
      $("#contenedor").load( "pages/SecretariaAcademica/Manejo_Documentos/manejo_Documentos.php"
                            );
      });
    $("#ciudadOrigen").click(function(event) {
      event.preventDefault();
      $("#contenedor").load( "pages/SecretariaAcademica/Mantenimiento/ciudadOrigen/ciudadOrigen.php"
                            );
      });

    $("#planesEstudio").click(function(event) {
      event.preventDefault();
      $("#contenedor").load( "pages/SecretariaAcademica/Mantenimiento/PlanesEstudio/planesEstudio.php"
                            );
      });

    $("#mencionHonorifica").click(function(event) {
      event.preventDefault();
      $("#contenedor").load( "pages/SecretariaAcademica/Mantenimiento/MencionesHonorificas/MencionesHonorificas.php"
                            );
      });

});

