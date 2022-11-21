<?php

session_start();

$host = "webdev.iyaclasses.com";
$userid = "icleung";
$userpw = "AcadDev_Leung_7912600781";
$db = "icleung_yearbook";
$dbconnection = new mysqli ($host, $userid, $userpw, $db);

if($dbconnection -> errno) {
    echo "DB CONNECTION ERROR!<br>";
    echo $dbconnection->connect_error;
    exit();
}
if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data)
    {

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        return $data;

    }
}

$username = validate($_POST['username']);

$password = validate($_POST['password']);

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

if($_SESSION["loggedin"] == "yes") {
// all good
    echo "(Access allowed)";
}
else if (!empty($_REQUEST["password"])) {
    if($_REQUEST["password"]=="$password") {
// VALID login
        $_SESSION["loggedin"]="yes";
    }
    else {
// INVALID login
        echo "ERROR. WRONG PASSWORD";
        exit();
    }
}
else 	{ // NOT logged in and has NOT submitted form/login
// include login form
    include "login.php";
    exit();
// STOP the page
}
?>

<html>
<head>
    <title>Your Profile</title>
    <style>
        body {
            background-color: burlywood;
            margin: 0 200px;
            text-align: center;
        }

        #container {
            padding: 30px;
            margin-top: 100px;
            background-color: olive;
            width: 650px;
            text-align: left;
            color:white;
        }

        .className {
            width: 500px;

            float:left;
        }

        .link {
            width: 100px;
            float:left;
            margin-left: 50px;

        }
        .thumb {
            width: 40px; float:left;
        }
    </style>
</head>
<body>
<div id="container">
    <h1>Your Profile</h1> <hr>

    <h2>Your Images:</h2>
    <?php
    $sql = "SELECT * FROM imagesView";

    ?>
    <h2>Your Quotes:</h2>
    <?php
    $sql = "SELECT * FROM quotesView";

    ?>
    <div style="text-align:center;"><input type="submit" value="Add A Picture (Coming Soon)" style="background-color: darkolivegreen; color: white; border: 0"></div>
    <div style="text-align:center;"><input type="submit" value="Edit Information/Add A Bio (Coming Soon)" style="background-color: darkolivegreen; color: white; border: 0"></div>


    <a href="logout.php">
        <div style="text-align:center;"><input type="submit" value="LOG OUT." style="background-color: darkolivegreen; color: white; border: 0"></div> </a>

</div>

</body></html>
