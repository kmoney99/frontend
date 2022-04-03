<?php
  
//Required files
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('rabbitMQClient.php');
include("functions.php");
//include("logger.php");

    $username = $_POST["name"];
    $charactername = $_POST["char_name"];
    $response = get_char($username, $charactername);

    if ($response == Null){
        echo 'Could not make character';
        header("Location: char_gen.html");
        }
    else
    {
        echo "Got character";
	session_start();
	$_SESSION["charinfo"] = $response;

       	header("Location: char_sheet.html");
        
    }

?>

