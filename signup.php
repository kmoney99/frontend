<?php

include_once 'functions.php';
//Required files
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('rabbitMQClient.php');


$name = $_POST["name"];
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$confirmpassword = $_POST["confirmpassword"];
/*
if(strcmp(password,confirmpass) != 0){
	echo "<\br><\br><\br>PASSWORDS DO NOT MATCH!";
	header("Location: signup.html");
}
*/
$response = sign_up_request($name, $email, $username, $password);
echo $response;

	if (!$response){
		
     		echo '<div class="alert alert-danger" role="alert">Could not create user, please try again!</div>';
     		header("Location: login.html");
	}
	else
    {		
		echo "Created user!";
     		header("Location: login.html");
    	
	}




?>
