/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

  $(document).ready(function(){

    $("#CargaAcademica").click(function(event) {
      event.preventDefault();
      alert("has presionado CargaAcademica");
          
      $("#div_contenido").load("pages/CargaAcademica/CargaAcademica.php");
      });
    $("#Asignaturas").click(function(event) {
      event.preventDefault();
          
      $("#contenedor" ).load( //Pantalla para ingresar un estudiante
                            );
      }); 
    $("#Edificios").click(function(event) {
      event.preventDefault();
          
      $("#contenedor" ).load( // Pantalla para modificar el tipo de estudiante
                            );
      }); 

    $("#Aulas").click(function(event) {
      event.preventDefault();
      $("#contenedor").load(// Pantalla para ingresar una nueva solicitud
                            );
      });

    $("#Clases").click(function(event) {
      event.preventDefault();
      $("#contenedor").load(// Pantalla para ingresar una solicitud por estudiante
                            );
      }); 

    $("#AsignacionClases").click(function(event) {
      event.preventDefault();
      $("#contenedor").load(// Pantalla para Hacer una busqueda avanzada
                            );
      });

    $("#RegistroDocentes").click(function(event) {
      event.preventDefault();
      $("#contenedor").load( "pages/CargaAcademica/RegistroDocentes/RegristroDocentes.php"
                            );
      });
    $("#Facultad").click(function(event) {
      event.preventDefault();
      $("#contenedor").load(// Pantalla para Hacer una busqueda avanzada
                            );
      }); 
    $("#AreasProyecto").click(function(event) {
      event.preventDefault();
      $("#contenedor").load(// Pantalla para Hacer una busqueda avanzada
                            );
      }); 
    $("#AreasVinculacion").click(function(event) {
      event.preventDefault();
      $("#contenedor").load(// Pantalla para Hacer una busqueda avanzada
                            );
      }); 
    $("#Proyectos").click(function(event) {
      event.preventDefault();
      $("#contenedor").load(// Pantalla para Hacer una busqueda avanzada
                            );
      });
    $("#AsigancionProyecto").click(function(event) {
      event.preventDefault();
      $("#contenedor").load(// Pantalla para Hacer una busqueda avanzada
                            );
      });
    $("#BusquedaAvanzada").click(function(event) {
      event.preventDefault();
      $("#contenedor").load(// Pantalla para Hacer una busqueda avanzada
                            );
      });    
});
