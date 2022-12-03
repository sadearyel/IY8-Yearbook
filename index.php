<?php
session_start();

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
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RFSQ245J0B"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-RFSQ245J0B');
    </script>

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
        #gallery {
            padding-top: 100px;
            padding-bottom: 100px;
            padding-left: 0px;
            padding-right: 0px;

            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        #gallery img {
            width: 10.001%;
            padding-bottom: 10px;
        }
        #intro {
            padding-top: 50px;
            padding-bottom: 50px;
            padding-left: calc(100% * (4 / 12));
            padding-right: calc(100% * (4 / 12));

            text-align: center;
        }
        #timeline {
            padding-top: 75px;
            padding-bottom: 50px;
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

<?php include "Global Elements/nav.php"; ?>

<div id="gallery">
    <?php
    $sql = "SELECT * FROM images";
    $results = $mysql -> query($sql);
    $numrows = $results -> num_rows; // the total number of rows in the images table

    // $numimages refers to the total number of images displayed in the gallery block: 27
    for($numimages = 0; $numimages < 27; $numimages++) {

        // rand(int min, int max) function allows us to randomly generate an existing row number from the images table
        $randnum = rand(1, $numrows);

        $sql_rand = "SELECT * FROM images WHERE image_id = " . $randnum;
        $results_rand = $mysql -> query($sql_rand);

        // we assign the row data to a $currentrow variable so that we can access specific columns, ex. image_link
        $currentrow = $results_rand -> fetch_assoc();
        echo "<img src = 'Image Uploads/" . $currentrow["image_name"] . "'>";
    }
    ?>
</div>

<div id="intro">
    <h1 class="section-title">
        INTRO
    </h1>
    <p>
        A growing collection of memories from USC’s Iovine and Young Academy. Tagged images and funny quotes, conveniently categorized by date and event.
        <br><br>
        Made with love,
        <br>
        Ellie, Iris, Jenna, Kate, Sade
    </p>
</div>

<div id="timeline">
    <h1 class="section-title">
        CATEGORIZED BY TAGGED EVENTS
    </h1>
    <img src="Site%20Images/timeline.png" style="width: 100%;">
</div>

<!--
<div id="timeline">
    <h1 class="section-title">
        CATEGORIZED BY TAGGED EVENTS
    </h1>
</div>
__!>

<!-- cta refers to a "Call to Action" section - a section that prompts the user to do something --!>
<div id="cta">
    <div style="width: 50%;">
        <img src="Site%20Images/home-pizza.png" style="width: 100%;">
    </div>
    <div style="margin-left: 10%; width: 40%;">
        <h1 class="section-title">
            ADD YOUR MEMORIES
        </h1>
        <p>
            Contribute today to our growing colletion. Create an account or sign in to an existing account to submit your own images and quotes.
            <br><br>
            <a>Sign Up or Login</a>
        </p>
    </div>
</div>

<?php include "Global Elements/footer.php"; ?>

</body>
</html>