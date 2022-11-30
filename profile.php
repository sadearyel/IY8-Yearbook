<?php
session_start();

// redirect page visitors to the login page if it was accessed in error
if(empty($_SESSION["user_id"])){
    header('Location: login.php');
    exit();
}

// connect to db
$host = "webdev.iyaclasses.com";
$userid = "icleung";
$userpw = "AcadDev_Leung_7912600781";
$db = "icleung_yearbook";

$dbconnection = new mysqli ($host, $userid, $userpw, $db);

if($dbconnection -> errno) {
    echo "DB CONNECTION ERROR!<br>";
    echo $dbconnection -> connect_error;
    exit();
}
?>
<html lang="en">
<head>
    <title>IY8 Yearbook - Profile Page</title>
    <link rel="shortcut icon" type="image/jpg" href="">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <link rel="stylesheet" href="main.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        #container {
            padding-top: 100px;
            padding-bottom: 100px;
            padding-left: calc(100% * (1 / 12));
            padding-right: calc(100% * (1 / 12));

            text-align: center;
        }
        .section {
            width: 50%;
            margin-left: 25%;
            margin-right: 25%;

            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .button {
            width: 150px;
            margin-bottom: 20px;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 10px;
            padding-right: 10px;

            background-color: black;
            color: white;

            text-align: center;
        }
    </style>
</head>
<body>

<?php include "Global Elements/nav.php"; ?>

<div id="container">

    <?php

    $sql = "SELECT * FROM names WHERE name_id = " . $_SESSION["name_id"];

    $results = $dbconnection -> query($sql);
    $currentrow = $results -> fetch_assoc();

    echo "<img src='Image Uploads/" . $currentrow["pfp"] . "' style='width: 30%; margin-bottom: 20px;'>";

    echo "<h1 class='section-title'>";
    echo "WELCOME<br>";
    echo $currentrow["name"];
    echo "</h1>";

    // logout page
    echo '<a href="logout.php">';
    echo '<div class="button" style="margin-left: calc(50% - 75px); margin-right: calc(50% - 75px);">';
    echo 'Logout';
    echo '</div>';
    echo '</a>';

    // users do not yet have the ability to edit their previous quote and image submissions - still needs to be built

    echo "<br><br>";

    echo "<p>";

    $sql_user = "SELECT * FROM users WHERE user_id = " . $_SESSION["user_id"];

    $results_user = $dbconnection -> query($sql_user);
    $currentrow = $results_user -> fetch_assoc();

    if($currentrow["security_lvl"] == 0) { // admin status
        ?>

        <hr>
        <br>
        Admin Access Pages
        <br><br>
        <div class="section">
            <div class="button">
                Edit User Roster
            </div>
            <div class="button">
                Edit All Images
            </div>
            <div class="button">
                Edit All Quotes
            </div>
        </div>
        <br>
        <hr>

        <br><br>
        <?php
    }

    if($currentrow["security_lvl"] <= 1) { // regular access
        ?>
        <hr>
        <br>
        Cohort 8 Member Pages
        <br><br>
        <div class="section">
            <div class="button">
                Edit Personal Images
            </div>
            <div class="button">
                Edit Personal Quotes
            </div>
        </div>
        <br>
        <hr>

        <?php
    }

    echo "</p>";

    ?>
</div>

<?php include "Global Elements/footer.php"; ?>

</body>
</html>
