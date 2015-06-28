<?php

session_start();

if(isset($_SESSION['contenido']))
{
   $contenido = $_SESSION['contenido'];
}elseif($_GET['contenido'])
{
   $contenido = $_GET['contenido'];
}

if(isset($_GET['code']))
{
  $code = $_GET['code'];
  switch ($code) 
  {
      case 101:
	      session_unset();
          session_destroy(); // Destroying All Sessions
	   	  session_start();
          if($contenido == 'index')
          {
            echo '<script>window.top.location.href="login.php?error_code=5"</script>';
            exit();
          }
        echo '<script>window.top.location.href="login/login.php?error_code=5"</script>';
        exit();
        break;
	  case 100:
	      session_unset();
          session_destroy(); // Destroying All Sessions
		  session_start();
          if($contenido == 'index')
          {
            echo '<script>window.top.location.href="login.php"</script>';
            exit();
          }
		  echo '<script>window.top.location.href="login/login.php"</script>';
          exit();
	  break;
	  case 0:
	      session_unset();
          session_destroy(); // Destroying All Sessions
		  session_start();
		  if($contenido == 'index')
          {
            echo '<script>window.top.location.href="login.php?error_code=0"</script>';
            exit();
          }
          echo '<script>window.top.location.href="login/login.php?error_code=0"</script>';
          exit();
	  break;
      default:
	      session_unset();
          session_destroy(); // Destroying All Sessions
		  session_start();
		  if($contenido == 'index')
          {
            echo '<script>window.top.location.href="login.php?error_code=0"</script>';
            exit();
          }
          echo '<script>window.top.location.href="login/login.php?error_code=0"</script>';
          exit();
	  break;
  }
}
else
{  
  session_destroy(); // Destroying All Sessions
  header("Location: login.php"); // Redirecting To Home Page
}
?>