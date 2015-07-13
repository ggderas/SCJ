
<?php

if(!isset($_SESSION)) 
{ 
  session_set_cookie_params(1800); // las sesion de los cookies durara 1 hora en el cliente
  session_start(); 
  
} 

?>
