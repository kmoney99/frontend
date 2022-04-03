<?php
ini_set('display_errors', 1);
$sched_date = $_POST['sess_date'];
$sched_time = $_POST['sess_time'];
$sched_email = $_POST['sess_email'];

echo "Sending email, please wait.";

$to = $sched_email;
$subject = "DND Session Scheduled!";
$message = "Someone scheduled time to play DND on " . $sched_date . " at " . $sched_time;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
mail($to,$subject,$message,$headers);

echo "Email sent! Heading home.";

header("Location home.php");

?>
