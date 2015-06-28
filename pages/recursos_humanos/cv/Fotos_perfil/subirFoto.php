
<html>

    <head>
        
        
        <script>
$(function (){
  $("#guardar").click(function() {
      
     alert("hola otra vez");
     
     var formData = new FormData($(".formulario")[0]);
    
     
    
     
             $.ajax({
      
                 //url:"subir.php",
                
                 type: "POST",
                 data: formData,
                 cache: false,
                 contentType: false,
                 ProcessData: false,
                 success: function(data){
                     
                     $("#display").html(data);
                     
                 }
 
             });
             return false;
     
    });
 });
 
  
</script>
        
        
    </head>    
    
    <body>
    
    
<form method="post" id="formulario" enctype="multipart/form-data">

<input name="foto1" type="file" id="foto1"  >

<button name="guardar" id="guardar"  value="Subir foto">Subir foto</button>



</form>

        
 <div id="display"> </div>       
        

    </body>




</html>