/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var x;
x=$(document);
x.ready(inicio);
function inicio()
{
    var x;
    x=$("#crear");
    x.click(crear);
    
    var x;
    x=$("#actividades");
    x.click(actividades);
    
    var x;
    x=$("#reportes");
    x.click(reportes);
  
  
 
   
  var y;
    y=$("#estadisticas");
    y.click(estadisticas); 
    
      var y;
    y=$("#areas");
    y.click(areas);
   
   y=$("#tipoDeAreas");
    y.click(tiposDeAreas);
}





function areas()
{
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        //url:"pages/mantenimiento.php",    
        // url:"../cargarPOAs.php",  
       // beforeSend:inicioEnvio,
        success:p_areas,
        timeout:4000,
        error:problemas
    }); 
    return false;
}

function tiposDeAreas()
{
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        //url:"pages/poas.php",    
        // url:"../cargarPOAs.php",  
        //beforeSend:inicioEnvio,
        success:p_tiposDeAreas,
        timeout:4000,
        error:problemas
    }); 
    return false;
}




function estadisticas()
{
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        //url:"pages/mantenimiento.php",    
        // url:"../cargarPOAs.php",  
       // beforeSend:inicioEnvio,
        success:llegadaEstadisticas,
        //timeout:4000,
        //error:problemas
    }); 
    return false;
}

function reportes()
{
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        //url:"pages/mantenimiento.php",    
        // url:"../cargarPOAs.php",  
       // beforeSend:inicioEnvio,
        success:llegadaReportes,
        //timeout:4000,
        //error:problemas
    }); 
    return false;
}


function ajustes()
{
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        //url:"pages/mantenimiento.php",    
        // url:"../cargarPOAs.php",  
       // beforeSend:inicioEnvio,
        success:llegadaAjuste,
        timeout:4000,
        error:problemas
    }); 
    return false;
}
function actividades()
{
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        //url:"pages/poas.php",    
        // url:"../cargarPOAs.php",  
        //beforeSend:inicioEnvio,
        success:llegadaCalendario,
        timeout:4000,
        error:problemas
    }); 
    return false;
}

function crear()
{
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        url:"pages/crearPOA.php",    
        // url:"../cargarPOAs.php",  
        beforeSend:inicioEnvio,
        success:llegadaCrear,
        timeout:4000,
        error:problemas
    }); 
    return false;
}


function inicioEnvio()
{
    var x=$("#contenedor");
    x.html('Cargando...');
}

function llegadaEstadisticas()
{
    $("#contenedor").load('pages/estadisticas.php');
     //$("#contenedor").load('../cargarPOAs.php');
}

function llegadaReportes()
{
    $("#contenedor").load('pages/reportesActividades.php');
     //$("#contenedor").load('../cargarPOAs.php');
}


function llegadaAjuste()
{
    $("#contenedor").load('pages/mantenimiento.php');
     //$("#contenedor").load('../cargarPOAs.php');
}
function llegadaCalendario()
{
    $("#contenedor").load('pages/calendarioActividades.php');
     //$("#contenedor").load('../cargarPOAs.php');
}
function llegadaCrear()
{
    $("#contenedor").load('pages/crearPOA.php');
     //$("#contenedor").load('../cargarPOAs.php');
}

function problemas()
{
    $("#contenedor").text('Problemas en el servidor.');
}

function p_areas()
{
    $("#contenedor").load('pages/areas.php');
}

function p_tiposDeAreas()
{
    $("#contenedor").load('pages/tiposDeAreas.php');
}