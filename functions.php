<?php 

//Required files
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('rabbitMQClient.php');
//Start session
//session_start();

	//Check if user is logged in, redirect to login page if not
	/*
	function loggedCheck(){
		if (!$_SESSION["logged"]){
			header("Location: login.php");
		}
	}
*/
	//Login function
	/*
    function login($username, $password){

        $request = array();

        $request['type'] = "Login";
        $request['username'] = $username;
        $request['password'] = $password;

        $returnedValue = createClientForDb($request);

        if($returnedValue == 1){
            $_SESSION["username"] = $username;
            $_SESSION["logged"] = true;
			header("Location: index.php");
			return true;
        }else{
			header("Location: login.php");
            		session_destroy();
			return false;
        }
        return $returnedValue;
    }
    */
    //rabbit login request

    
function login_request($user,$pass){
	$client = new rabbitMQClient("testRabbitMQ.ini","Server");
	$request = array();
	$request['type'] = "Login";
	$request['username'] = $user;
	$request['password'] = $pass;
	$request['message'] = "Check to login";
	$response = $client->send_request($request);
	echo "[Login]Client received response: ".PHP_EOL;
	print_r($response);
	return $response;

}
function local_error($msg){
	$errorlog = fopen("log.txt", "a") or die ("CAN NOT OPEN ERROR LOG");
        fwrite($errorlog, $msg);
	fclose($errorlog);
}

function error_distribute($err_msg){
	$client = new rabbitMQClient("testRabbitMQ.ini","Server");
  	$msg = "This is a Error Distribution";
	$request = array();
	$request['type'] = "Err_Update";
	$request['err_msg'] = $err_msg;
	$request['message'] = "Updating error logs on all systems.";
	$response = $client->send_request($request);
	
	echo "[Err]Client received response: ".PHP_EOL;
	print_r($response);
	echo "\n\n";
	
	echo $argv[0]." END".PHP_EOL;

}

function authenticate_request($session_key){
	$client = new rabbitMQClient("testRabbitMQ.ini","Server");
  	$msg = "This is an Auth request";
	$request = array();
	$request['type'] = "Auth";
	$request['key'] = $session_key;
	$request['message'] = "Check to authenticate: " . $session_key;
	$response = $client->send_request($request);
	
	echo "[Auth]Client received response: ".PHP_EOL;
	print_r($response);
	echo "\n\n";
	if (!$response){
		header("Location login.php");
	}	
	echo $argv[0]." END".PHP_EOL;
}


function sign_up_request($name, $email, $username, $password){
	$client = new rabbitMQClient("testRabbitMQ.ini","Server");
  	$msg = "This is a signup request";
	
	$request = array();
	$request['type'] = "SignUp";
	$request['name'] = $name;
	$request['email'] = $email;
	$request['username'] = $username;
	$request['password'] = $password;
	$request['message'] = "Check to sign up";
	$response = $client->send_request($request);
	//$response = $client->publish($request);
	if (!$response){
		error_distribute("Error creating user.");	
	}	
	echo "[SignUp]Client received response: ".PHP_EOL;
	print_r($response);
	echo "\n\n";
	
	echo $argv[0]." END".PHP_EOL;
	return $response;
}


function get_char($username, $charactername){
	$client = new rabbitMQClient("testRabbitMQ.ini","Server");
        $msg = "This is a character request";

        $request = array();
        $request['type'] = "Get_Char";
        $request['username'] = $username;
        $request['charactername'] = $charactername;
        $request['message'] = "Get character.";
        $response = $client->send_request($request);
        //$response = $client->publish($request);

        echo "[Character]Client received response: ".PHP_EOL;
        print_r($response);
        echo "\n\n";

        echo $argv[0]." END".PHP_EOL;
        return $response;

}
function get_monster($monstername){
 	$client = new rabbitMQClient("testRabbitMQ.ini","Server");
         $msg = "This is a monster request";

         $request = array();
         $request['type'] = "Get_Monster";
         $request['monstername'] = $monstername;
         $request['message'] = "Get Monster Information.";
         $response = $client->send_request($request);
         //$response = $client->publish($request);

         echo "[Monster]Client received response: ".PHP_EOL;
         print_r($response);
         echo "\n\n";

         echo $argv[0]." END".PHP_EOL;
         return $response;

}


function get_chat($username, $chat_msg){
        $client = new rabbitMQClient("testRabbitMQ.ini","Server");
        $msg = "This is a character request";

        $request = array();
        $request['type'] = "Chat";
        $request['username'] = $username;
        $request['chat_msg'] = $chat_msg;
        $request['message'] = "Get Message.";
        $response = $client->send_request($request);
        //$response = $client->publish($request);

  //	 echo "Client received response: ".PHP_EOL;
  // 	print_r($response);
        echo "\n\n";

        echo $argv[0]." END".PHP_EOL;
        return $response;

}




