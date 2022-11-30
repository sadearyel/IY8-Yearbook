<?php

// logout routine
session_start();

unset($_SESSION["loggedin"]);
unset($_SESSION["name_id"]);
unset($_SESSION["user_id"]);
unset($_SESSION["security_lvl"]);

echo "LOGGED OUT";
print_r($_SESSION);
header("Location: login.php");

?>