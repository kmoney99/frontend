<?php

//Required files
unset ($_COOKIE["key"]);
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('rabbitMQClient.php');
include("functions.php");
//include("logger.php");

    $username = $_POST["username"];
    $password = $_POST["password"];
    $response = login_request($username, $password);
    if(!isset($_COOKIE["key"])){
    	setcookie("key",$response);
    }
    if ($response == Null){
     	echo '<div class="alert alert-danger" role="alert">Incorrect login, please try again!</div>';
    	header("Location: login.html");
    	}
    	
    else
    {
    	echo "Login successful, going to homepage.";
	    
	    //make sure it redirects
	header("Location: home.php");
	echo "<\br>(LOGIN.php)RESPONSE:" . $response . "END RESPONSE";
	}
    
?>
