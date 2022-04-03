<?php

setcookie("key", "", time() - 3600);

session_start();
session_unset();
session_destroy();

header("location: login.html");
exit();

?>
