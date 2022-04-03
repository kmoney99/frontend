
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Simply DND</title>

  </head>


		  
<?php
  session_start();
  include_once 'includes/functions.inc.php';
 
 
  
   if (isset($_SESSION["userid"])) {
              echo "<a href='index.php'></a>";
              echo "<a href='logout.php'></a>";
			  
            }
	else {
	header("location: ./login.php");
   
}		
?>
