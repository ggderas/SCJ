<?php

if(!isset($maindir))
  {
    $maindir="../";
  }

//Start session
require_once($maindir.'funciones/check_session.php');
 
//Check si el contenido esta presente, sino le  asigna uno
if(isset($_GET['contenido']))
  {
    $contenido = $_GET['contenido'];
  }
else
  {
    $contenido = 'index';
  }
  
//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['user_id']) || (trim($_SESSION['user_id']) == '')) 
  {
    header('Location: '.$maindir.'login/logout.php?code=100&contenido='.$contenido);
    exit();
  }
else
  {
  $user = $_SESSION['nombreUsuario'];
  $rol = $_SESSION['user_rol'];
  }

//Check time
require_once($maindir."funciones/timeout.php");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>Sistema Ciencias Jurídicas</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" >
        <link rel="stylesheet" type="text/css" href="css/datatables/dataTables.bootstrap.css">

        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="/bootstrap/img/favicon.ico">
        <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">

        <!-- CSS code from Bootply.com editor -->
        
        <link href="css/styles.css" rel="stylesheet" type="text/css">

        <!-- Dorian Theme style -->

        <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    
	    <!-- switch CSS -->
	    <link href="bower_components/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">
	
        <!-- Timeline CSS -->
        <link href="dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="bower_components/morrisjs/morris.css" rel="stylesheet"> 
        <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/datepicker.css" rel="stylesheet" media="screen">

        <!-- <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" /> -->

    </head>
    
    <!-- HTML code from Bootply.com editor -->

  <body class="skin-green">
	
  <nav class="navbar navbar-inverse navbar-fixed-top header">
  <div class="col-md-12">
     <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Facultad de Ciencias Jurídicas</a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
	    <?php
		    if($rol == 100){
			                  echo <<<HTML
            <li class="dropdown">
            <a role="button" href="javascript:ajax_('pages/administracion/admin.php');"><i class="fa fa-cogs"></i> Administración</a>
            </li>
HTML;
		    }
		?>
        <li class="dropdown">
          <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
		     <i class="glyphicon glyphicon-user"></i><?php echo " ".$user; ?><span class="caret"></span></a>
		  <ul id="g-account-menu" class="dropdown-menu" role="menu">
		    <li href="#"><a href="#">Perfil</a></li>
		  </ul>
        </li>
        <li><a href="login/logout.php"><i class="glyphicon glyphicon-lock"></i> Salir</a></li>
      </ul>
    </div>
  </div> 
  </nav>
<!-- /Header -->