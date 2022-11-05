<?php
$host = "webdev.iyaclasses.com";
$userid = "icleung";
$userpw = "AcadDev_Leung_7912600781";
$db = "icleung_yearbook";

$mysql = new mysqli(
    $host,
    $userid,
    $userpw,
    $db
);
?>

<html lang="en">
<head>
    <title>IY8 Yearbook</title>
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
        #intro {
            padding-top: 125px;
            padding-bottom: 125px;
            padding-left: calc(100% * (4 / 12));
            padding-right: calc(100% * (4 / 12));

            text-align: center;
        }
        #gallery {
            padding-top: 100px;
            padding-bottom: 100px;
            padding-left: 0px;
            padding-right: 0px;

            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between;
        }
        #gallery img {
            width: 10.001%;
        }
        #timeline {
            padding-top: 125px;
            padding-bottom: 125px;
            padding-left: calc(100% * (1 / 12));
            padding-right: calc(100% * (1 / 12));

            text-align: center;
        }
        #cta {
            padding-top: 125px;
            padding-bottom: 125px;
            padding-left: calc(100% * (1 / 12));
            padding-right: calc(100% * (1 / 12));

            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between;

            text-align: center;
        }
    </style>
</head>
<body>
<div id="nav">
    <div style="text-align: left; flex-grow: 3;">
        <h2>
            LOS ANGELES, CALIFORNIA
        </h2>
    </div>
    <div style="text-align: center; flex-grow: 4;">
        <h2>
            IOVINE AND YOUNG ACADEMY YEARBOOK
        </h2>
    </div>
    <div style="text-align: right; flex-grow: 3;">
        <h2>
            <a>LOGIN</a>
        </h2>
    </div>
</div>

<img src="Image Uploads/000040370008.jpg">

<div id="gallery">
    <?php
    $sql = "SELECT * FROM images";
    $results = $mysql -> query($sql);
    $numrows = $results -> num_rows; // the total number of rows in the images table

    // $numimages refers to the total number of images displayed in the gallery block: 27
    for($numimages = 0; $numimages < 27; $numimages++) {

        // rand(int min, int max) function allows us to randomly generate an existing row number from the images table
        $randnum = rand(1, $numrows);

        // we assign the row data to a $currentrow variable so that we can access specific columns, ex. image_link
        $currentrow = $results -> data_seek($randnum);
        echo "<img src = 'Image%20Uploads/" . $currentrow["image_name"] . "'>";
    }
    ?>
</div>

<div id="intro">
    <p class="section-title">
        INTRO
    </p>
    <p>
        A growing collection of memories from USC’s Iovine and Young Academy. Tagged images and funny quotes, conveniently categorized by date and event.
        <br><br>
        Made with love,
        <br>
        Ellie, Iris, Jenna, Kate, Sade
    </p>
</div>

<div id="timeline">
    <p class="section-title">
        CATEGORIZED BY TAGGED EVENTS
    </p>
</div>

<!-- cta refers to a "Call to Action" section - a section that prompts the user to do something --!>
<div id="cta">
    <div style="width: 50%;">
        <img src="Site%20Images/home-pizza.png" style="width: 100%;">
    </div>
    <div style="margin-left: 10%; width: 40%;">
        <p class="section-title">
            ADD YOUR MEMORIES
        </p>
        <p>
            Contribute today to our growing colletion. Create an account or sign in to an existing account to submit your own images and quotes.
            <br><br>
            <a>Sign Up or Login</a>
        </p>
    </div>
</div>

<div id="footer">
    <div style="text-align: left; flex-grow: 5;">
        <h2>
            THANKS FOR POPPING BY!
            <br><br>
            THIS SITE IS NOT ASSOCIATED WITH THE IOVINE AND YOUNG ACADEMY OR THE UNIVERSITY OF SOUTHERN CALIFORNIA.
        </h2>
    </div>
    <div style="text-align: right; flex-grow: 5;">
        <h2>
            <a>CONTACT FOUNDING TEAM</a>
        </h2>
    </div>
</div>

</body>
</html>