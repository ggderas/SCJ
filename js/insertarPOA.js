 var data;
 var x;
 x=$(document);
 x.ready(inicio);
 
    function inicio(){
        
        var x;
        x=$("#guardar");
        x.click(consulta);
       
    }
        
        
        
        function consulta()
{
    var pnombre=$("#titulo").val(); 
        alert(pnombre);
        data ={ titulo:$("#titulo").val(),
                inicio:$("#dp1").val(),
                fin:$("#dp2").val(),
                observacion:$("#observacion").val()
                
        };
    
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        url:"Datos/insertarPOA.php",     
        beforeSend:inicioEnvio,
        success:llegadaGuardar,
        timeout:4000,
        error:problemas
    }); 
    return false;
} 

function inicioEnvio()
{
    var x=$("#contenedor2");
    x.html('Cargando...');
}

function llegadaGuardar()
{
    $("#contenedor2").load('Datos/insertarPOA.php',data);
}

function problemas()
{
    $("#contenedor2").text('Problemas en el servidor.');
}

