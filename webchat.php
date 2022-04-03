<?php
include ("functions.php");
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('rabbitMQClient.php');
?>

<h2>Simply DND Group Chat</h2>

<?php

$username = $_POST["uname"];
$msg = $_POST["msg"];
$response = get_chat($username, $msg);

echo nl2br($response);


?> <br/>

<!DOCTYPE html>
<html>
<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: left;
}

input[type=submit]:hover {
  background-color: #45a049;
  float: left;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<body>


<form action="./webchat.php" method="POST">
<div>
  <label for="uname">Username:</label><br>
  <input type="text" id="uname" name="uname"><br>
  <label for="msg">Message:</label><br>
  <input type="text" id="msg" name="msg"><br><br>
  <input type="submit" value="Send">
</div>

</body>
</html>





