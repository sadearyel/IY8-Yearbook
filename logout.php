<?php

// logout routine
session_start();
unset($_SESSION["loggedin"]);
echo "LOGGED OUT";
print_r($_SESSION);
header("Location: login.php");

?>