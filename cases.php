<?php

//Required files
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('eabbitMQClient.php');
include("functions.php");


session_start();
$type = $_POST["type"];
switch ($type){
  //Login Case
  case "Login":
    $username = $_POST["username"];
    $password = $_POST["password"];
    $response = login($username, $password);
    if (!$response){
     	echo $response;
		echo '<div class="alert alert-danger" role="alert">Incorrect login, please try again!</div>';
		}
		else{
			echo $response;
		}
    break;
    
 //Sign up Case
  case "SignUp":
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
	  $confirmpassword = $_POST["confirmpassword"];

  	if ($confirmpassword!=$password){
          echo '<div class="alert alert-danger" role="alert">Passwords do not match, try again</div>';
  	}
    else{
      $response = SignUp($name,$email, $username, $password);
  		if ($response == true){
  			return '<div class="alert alert-success" role="alert">Successfully created your account, please login to the left!</div>';}
  	}
  	break;   
    
