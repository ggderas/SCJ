<?php

require_once("conn.php");

$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

  try
  {

    $db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$username, $password, $options);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  }
  catch(PDOException $ex)
  {
    die("Error al tratar de conectase al servidor, por favor contacte al administrador del sistema ". $ex->getMessage());
  }

 if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
 {

   function undo_magic_quotes_gpc(&$array)
   {

     foreach($array as &$value)
     {
        if(is_array($value))
        {
           undo_magic_quotes_gpc($value);
        }
        else
        {
           $value = stripslashes($value);
        }
     
     }
  
   }

   undo_magic_quotes_gpc($_POST);
   undo_magic_quotes_gpc($_GET);
   undo_magic_quotes_gpc($_COOKIE);

 }

 if (!headers_sent()) {
    header('Content-Type: text/html; charset=utf-8');
 }

  if(!isset($_SESSION)){
    session_start();
  }

?>