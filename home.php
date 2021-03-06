<?php 
//Required files
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('rabbitMQClient.php');
include("functions.php");
//include("logger.php");

if (isset($_COOKIE["key"])){
	authenticate_request($_COOKIE["key"]);
}
else{
	header("Location: login.html");
}

?>

<head>

    <title>Simply DnD</title>
	
	<div class="topnav">
  <a  href="./home.php">Home</a>
  <a href="./char_gen.html">Character Generator</a>
  <a  href="./logout.php">Logout</a>
</div>

<div class="footer">
   <h3>&#169 Simply DND Rights Reserved</h3>
</div>
 
</head>
<body>
    <div class="background">
        <div class="shape"></div>
       
    </div>
     
    </form>
</body>
</html>
	<style media="screen">
	*,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #FFFFFF;
}

form{
    height: 520px;
    width: 450px;
    background-color: rgba(255,0,0, 53%);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 250px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(0,0,0);
    box-shadow: 0 0 30px rgba(255,0,0);
    padding: 65px 75px;
}
form *{
    font-family: 'Trebuchet MS', sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 35px;
    font-weight: 500;
    line-height: 100px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 30px;
    width: 100%;
    background-color: rgba(0, 0, 0);
    border-radius: 415px;
    padding: 20px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
	color: #f2f2f2;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #000000;
    color: #ffffff;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 230px;
    cursor: pointer;
}

.topnav {
  overflow: hidden;
  background-color: #000;
  font-family: 'Trebuchet MS', sans-serif;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 20px 30px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ff0000;
  color: black;
}

.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: #000000;
  color: white;
  text-align: center;
  font-family: 'Trebuchet MS', sans-serif;
  padding-bottom: 35px;

  }
  
  

  
    </style>
