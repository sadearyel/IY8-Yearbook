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
        #quotes, .images {
             width: 100%;
             margin-top: 50px;

             display: flex;
             flex-direction: row;
             flex-wrap: wrap;
             justify-content: space-between;
         }
        .card {
            width: 200px;
            margin-bottom: 20px;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;

            border: 1px solid black;
            border-radius: 5px;

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

    echo "<br><br>";

    echo "<p>";

    $sql_user = "SELECT * FROM users WHERE user_id = " . $_SESSION["user_id"];

    $results_user = $dbconnection -> query($sql_user);
    $currentrow_user = $results_user -> fetch_assoc();

    if($currentrow_user["security_lvl"] == 0) { // admin status
        ?>

        <hr>
        <br>
        <h2>
            ADMIN ACCESS PAGES
        </h2>
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

    if($currentrow_user["security_lvl"] <= 1) { // cohort 8 status
        ?>

        <hr>
        <br>
        <h2>
            COHORT 8 ACCESS PAGES
        </h2>
        <br><br>
        <div class="section">
            <a href="imageform.php">
                <div class="button">
                    Add Image
                </div>
            </a>
            <a href="quotesform.php">
                <div class="button">
                    Add Quote
                </div>
            </a>
        </div>
        <br>
        <hr>

        <br><br>
        <?php
    }

    echo "</p>";

    // show all quotes that are attributed to this user
    echo "<h2>QUOTES</h2>";
    echo"<div id='quotes'>";

    $sql_quotes = "SELECT * FROM quotes WHERE name_id = " . $_SESSION["name_id"];
    $results_quotes = $dbconnection -> query($sql_quotes);

    // checking for errors
    if(!$results_quotes) {
        echo "ERROR: " . $dbconnection -> error;
    }

    while($currentrow_quotes = $results_quotes -> fetch_assoc()) {
        echo "<a href='details2.php?yearbookID=" . $currentrow_quotes['quote_id'] . "'>";
        echo "<div class='card'>";
        echo "<p>";
        echo "'" . $currentrow_quotes["quote"] . "'";
        echo "<br>";
        echo $currentrow_quotes["date"];
        echo "</p>";
        echo "</div>";
        echo "</a>";
    }

    echo "</div>";

    echo "<br><br>";

    // show all images that are photographed by this user
    echo "<h2>PHOTOGRAPHED IMAGES</h2>";
    echo "<div class='images'>";

    $sql_images = "SELECT * FROM images WHERE name_id = " . $_SESSION["name_id"];
    $results_images = $dbconnection -> query($sql_images);

    // checking for errors
    if(!$results_images) {
        echo "ERROR: " . $dbconnection -> error;
    }

    while($currentrow_images = $results_images -> fetch_assoc()) {
        echo "<a href='details.php?yearbookID=" . $currentrow_images['image_id'] . "'>";
        echo "<div class='card'>";
        echo "<img src='Image Uploads/" . $currentrow_images['image_name'] . "' style='width: 100%;'>";
        echo "</div>";
        echo "</a>";
    }

    echo "</div>";


    ?>
</div>

<?php include "Global Elements/footer.php"; ?>

</body>
</html>
