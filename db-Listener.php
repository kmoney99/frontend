#!/usr/bin/php
<?php

    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
    require_once('dbfunctions.php');
    //require_once('logger.php');
 
    
    // Updating logs for rabbit 
   function logger($log_msg) {
    $log_filename = '/var/log/rabbit_log';   
    if (!file_exists($log_filename))
    {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_msg = print_r($log_msg, true);
    $log_file_data = $log_filename.'/log_' . 'rabbit' . '.log';
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
    }

 //Takes request from server and pushes to db
    function requestProcessor($request){
        echo "received request".PHP_EOL;
        echo $request['type'];
        var_dump($request);

      	//logger($request);

        if(!isset($request['type'])){
            return array('message'=>"ERROR: Message type is not supported");
        }

        $type = $request['type'];
        $response_msg = "test";
        switch($type){

            //Login & Authentication request
		case "Login":
			echo "Logging in a user.";
			$response_msg = doLogin($request['username'],$request['password']);
			echo "THIS IS RESPONSE MESSAGE" . $response_msg;
			break;
		case "SignUp":
			echo "Signing up a user.";
                	$response_msg = signUp($request['name'],$request['email'],$request['username'],$request['password']);     //update sql table name 
			break;
		case "Auth":
			echo "Authoring user.";
			$response_msg = check_user($request['key']);
			break;	
    		case "Err_Update":
			echo "Updating error log.";
			$response_msg = update_errors($request['err_msg']);
			break;
		
		
		}
	echo "THIS IS RESPONSE MESSAGE 2:" .  $response_msg;
	return $response_msg;
    }
    //Creates new rabbit server
    $server = new rabbitMQServer('rabbitMQ_db.ini', 'testServer');

    //processes requests sent by client
    $server->process_requests('requestProcessor');
             
?>
