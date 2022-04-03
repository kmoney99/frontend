<?php

    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
    require_once('rabbitMQClient.php');
    require_once('dbh.php');
    //require_once('logger.php');

    //Login function
    function doLogin($username, $password){
    
    	$to_return = "bad login";
    	$mydb = dbConnect();
    	$query = "select * from users where username = '$username';";  //add username name next to $ 
	$response = $mydb->query($query);
 	$numRows = mysqli_num_rows($response);
	$responseArray = $response -> fetch_assoc();
        if ($numRows>0){
        		if (password_verify($password, $responseArray['password']))
			{
				$new_key = md5(time().$username);

				//before returning, will update new sess key and time. return key to be stored.
				echo "Updating info";
				$update_info = "UPDATE users SET sess_key = '$new_key', sess_time = CURRENT_TIMESTAMP WHERE username = '$username'";
				$mydb = dbConnect();
				$response = $mydb->query($update_info);
				echo "Session updated";	
				$request = "SELECT sess_key FROM users WHERE username = '$username'";
				$response = $mydb->query($request);
				$responseArray = $response -> fetch_assoc();
				$thekey = $responseArray['sess_key'];
				//echo "FUNC: RESPONSE" . $thekey;
				return $thekey;
			}
	}
	
        return $to_return;
    }


    // Authenticate function
    function check_user($session_key){
    	echo "Authenticating user.";

	echo "Checking if key exists.";
	$mydb = dbConnect();
	$query = "SELECT sess_key FROM users WHERE sess_key = '$session_key'";
	$response = $mydb->query($query);
	if (mysqli_num_rows($response) == 0) {
		return false;
	}
	else{
		$query = "SELECT sess_time FROM users WHERE DATE_ADD(sess_time, INTERVAL 1 DAY) > NOW()";
		$response = $mydb->query($query);
		if (mysqli_num_rows($response) == 0){
			return false;
		}
		else {
			return true;
		}
	
	}
    
    }




//Sign up function
    
function signUp($name, $email, $username, $password){
	    echo "SIGNING UP";
	    $pw = password_hash($password, PASSWORD_DEFAULT);
	    $sess_key = md5(time().$username);
	    $mydb = dbConnect();
	    echo "running query";
	    $query = "INSERT INTO `users`(`name`, `email`, `username`, `password`, `sess_key`) VALUES ('$name','$email','$username','$pw','$sess_key')";
	

	    $response = mysqli_query($mydb, $query);
		if ($response){
			echo "Worked.";
		}
	    	else{
		 	echo "Error: " . $query . " code: " . mysqli_error($mydb);	
		}

	    return true;
    }

    function update_errors($error_msg){
    	$error = escapeshellarg(`tail -n 1 ./log.txt`);
	if ($error != $error_msg){
		$file = fopen('data.txt', 'a');
		fwrite($file, $error_msg);
	}
	return true;
    }

?>
