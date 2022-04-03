<?php
  
//Required files
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('rabbitMQClient.php');
include("functions.php");
//include("logger.php");
	echo "Getting Monster Name";
    $monstername = $_POST["name"];
    echo "Getiing Monster Information";
    $response = get_monster($monstername);
	print_r($response);

    if ($response == Null){
        echo 'Could not find monster';
        header("Location: monsterview.html");
        }
    else
    {
        echo "Got Monster Information";
	session_start();
	$_SESSION["monsterinfo"] = $response;

       	header("Location: monster_info.html");
        
    }

?>
