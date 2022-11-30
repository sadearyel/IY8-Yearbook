<?php
session_start();

// redirect page visitors to the home page if it was accessed in error
if(empty($_REQUEST["nameID"])){
    header('Location: index.php');
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
    <title>IY8 Yearbook - Individual Page</title>
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
        #quotes, #images {
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

    // user profile card
    $sql = "SELECT * FROM names WHERE name_id = " . $_REQUEST["nameID"];

    $results = $dbconnection -> query($sql);

    // checking for errors
    if(!results) {
        echo "ERROR: " . $dbconnection -> error;
    }

    while($currentrow = $results -> fetch_assoc()) {
        echo "<img src='Image Uploads/" . $currentrow["pfp"] . "' style='width: 30%; margin-bottom: 20px;'>";
        echo "<h1 class='section-title'>";
        echo $currentrow["name"];
        echo "</h1>";
        echo "<p>";
        echo $currentrow["bio"];
        echo "</p>";
    }

    echo "<br><br>";

    // quote cards
    echo "<h2>QUOTES</h2>";
    echo "<div id='quotes'>";

    $sql_quotes = "SELECT * FROM quotes WHERE name_id = " . $_REQUEST["nameID"];

    $results_quotes = $dbconnection -> query($sql_quotes);

    // checking for errors
    if(!results_quotes) {
        echo "ERROR: " . $dbconnection -> error;
    }

    while($currentrow = $results_quotes -> fetch_assoc()) {
        echo "<div class='card'>";
        echo "<p>";
        echo "'" . $currentrow["quote"] . "'";
        echo "<br>";
        echo $currentrow["date"];
        echo "</p>";
        echo "</div>";
    }

    echo "</div>";

    echo "<br><br>";

    // image cards
    echo "<h2>IMAGES</h2>";
    echo "<div id='images'>";

    // change this to tagged images later
    $sql_images = "SELECT * FROM images WHERE name_id = " . $_REQUEST["nameID"];

    $results_images = $dbconnection -> query($sql_images);

    // checking for errors
    if(!results_images) {
        echo "ERROR: " . $dbconnection -> error;
    }

    while($currentrow = $results_images -> fetch_assoc()) {
        echo "<div class='card'>";
        echo "<img src='Image Uploads/" . $currentrow['image_name'] . "' style='width: 100%;'>";
        echo "</div>";
    }

    echo "</div>";
    ?>
</div>

<?php include "Global Elements/footer.php"; ?>

</body>
</html>
