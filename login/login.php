<?php

$maindir = "../";

session_set_cookie_params(0);
if(!isset($_SESSION)) 
{ 
  session_start(); 
} 

if(isset( $_SESSION['user_id'] ))
{
    //$message = 'Users is already logged in';
    header('Location: '.$maindir.'index.php');
}
 
?>

<script type="text/javascript">

  function login(){
     var usuario = document.getElementById("usuario").value;
     var password = document.getElementById("password").value;
     
     var text = "";
     var valid = true;
     
     if(usuario == "" || password == ""){
         text = "Introduzca un nombre de usuario y contraseña validos";
         valid = false;
     }
     
     if(!valid){
         alert(text);
         return;
     }
     
     var loginInfo = "login_submit.php?usuario=" + encodeURIComponent(usuario) +
                     "&password=" + encodeURIComponent(password);
     
     window.location.href = loginInfo;
  }
    
</script> 

<!DOCTYPE html>
<html lang="es">
<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Sistema Ciencias Jurídicas</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <link href="../css/bootstrap.min.css" rel="stylesheet">
        <!--[if lt IE 9]>
            <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="../css/styles.css" rel="stylesheet">
    </head>
    <body>
<!--login modal-->
      <div id="login-page">
        <div class="container">
          <form class="form-login">
            <h2 class="form-login-heading">Inicio de sesión sistema de Ciencias Jurídicas</h2>
              <div class="login-wrap">

<?php

   if(isset($_GET["error_code"]))
   {
       $accion = $_GET["error_code"];
        switch ($accion) {
            case 0:
                error_print(0);
                break;
            case 1:
                error_print(1);
                break;
            case 2:
                error_print(2);
                break;
            case 3:
                error_print(3);
                break;
            case 4:
                error_print(4);
                break;
            case 5:
                error_print(5);
                break;
            default:
                break;
        }
   }
   
   function error_print($error_code)
   {
       $mensaje = "";
       switch ($error_code) {
            case 0:
                $mensaje = "Sus credenciales ya expiraron, por favor trate de ingresar dentro de unos segundos";
                break;
            case 1:
                $mensaje = "Usuario o contraseña incorrecto";
                break;
            case 2:
                $mensaje = "Credenciales inválidas, por favor trate de ingresar dentro de unos segundos";
                break;
            case 3:
                $mensaje = "Por el momento no es posible procesar su petición, por favor trate de ingresar dentro de unos momentos";
                break;
            case 4:
                $mensaje = "La conexión con el sevidor no fue exitosa, por favor trate de ingresar dentro de unos segundos";
                break;
            case 5:
                $mensaje = "Lo sentimos pero su sesión ya ha expirado, por favor ingrese otra vez";
                break;
            default:
                break;
        }
        echo '<div class="alert alert-danger alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Error! </strong>'.$mensaje.'</div>';
   }

?>

                <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" autofocus>
                <br/>
                <input type="password" name="password" id="password" class="form-control" placeholder="contraseña">
				<br/>
				<!--
                <label class="checkbox">
                    <span class="pull-right">
                        <a data-toggle="modal" href="login.html#myModal"> Olvido su contraseña? </a>
                    </span>
                </label>
				-->
                <input type="button" class="btn btn-primary btn-lg btn-block" value="Acceder" onclick="login();">
                   </input>
                <hr>
              </div>
          </form>
        </div>
      </div>

    <!-- script references -->
        <script type="text/javascript" src="../js/jquery-2.1.1.min.js" ></script>
        <script type="text/javascript"src="../js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("../assets/img/UNAH_1.jpg", {speed: 1000});
    </script>

    </body>
</html>