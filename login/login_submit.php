<?php

$maindir = "../";

require_once($maindir."conexion/config.inc.php");

ob_start();
if(!isset($_SESSION)) 
{ 
  session_start(); 
} 

if(isset( $_SESSION['user_id'] ))
{
    //$message = 'Users is already logged in';
    header('Location: '.$maindir.'index.php');
    exit();
}
 
if(isset($_GET['usuario']) && isset($_GET['password']))
{  
  $LoginUsuario = $_GET['usuario'];
  $LoginPassword = $_GET['password'];
}
else
{
  header('Location: login.php?error_code=2');
  exit();
}
        
//$query = "SELECT id, username, password, salt FROM member WHERE username = '$username';";
try{

    $stmt = $db->prepare("CALL sp_login(?,?)");
    $stmt->bindParam(1, $LoginUsuario, PDO::PARAM_STR); 
	$stmt->bindParam(2, $LoginPassword, PDO::PARAM_STR);

	$stmt->execute();	
 
    $result = $stmt -> fetch();

    $stmt = null;
}
catch(PDOExecption $e)
{
   header('Location: login.php?error_code=3');
   exit();
   //die("We are unable to process your request. Please try again later");
} 
 
//$result = mysql_query($query);
 
//if(mysql_num_rows($result) == 0) // User not found. So, redirect to login_form again.

if($result)
{
//$userData = mysql_fetch_array($result, MYSQL_ASSOC);
//$hash = hash('sha256', $userData['salt'] . hash('sha256', $password) );
 
//if($hash != $userData['password']) // Incorrect password. So, redirect to login_form again.
 // Redirect to home page after successful login.
 
	session_regenerate_id();
	$_SESSION['user_id'] = $result['id_Usuario'];
	$_SESSION['user_rol'] = $result['Id_Rol'];
	$_SESSION['nombreUsuario'] = $LoginUsuario;
	$_SESSION['timeout'] = time();
	session_write_close();

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
	
	$user_ip = get_client_ip();
	
	try{
	
        $stmt = $db->prepare("CALL sp_log_user(?,?)");
        $stmt->bindParam(1, $result['id_Usuario'], PDO::PARAM_STR); 
	    $stmt->bindParam(2, $user_ip, PDO::PARAM_STR);

	    $stmt->execute();	

        $stmt = null;
        $db = null;
    }
    catch(PDOExecption $e)
    {
       header('Location: login.php?error_code=3');
       exit();
       //die("We are unable to process your request. Please try again later");
    } 
	
	header('Location: '.$maindir.'index.php');
	exit();

}else
{
    //echo "<script>alert('Sorry wrong username or password')</script>";
    header('Location: login.php?error_code=1');
    exit();
}

?>