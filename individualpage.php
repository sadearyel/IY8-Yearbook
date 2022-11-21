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
            padding-top: 125px;
            padding-bottom: 125px;
            padding-left: calc(100% * (4 / 12));
            padding-right: calc(100% * (4 / 12));

            text-align: center;
        }
        .individualpage {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;

        }
        #individualimg {

            height: 15%;
            width: 15%;
            padding-top: 125px;
            padding-left: calc(100% * (5.35 / 12));
            padding-right: calc(100% * (5.35 / 12));



            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between;

        }

        #name {
            font-size: 40px;
            text-align: center;
            font-family: 'Inter', sans-serif;

            padding-left: calc(100% * (5.5 / 12));
            padding-right: calc(100% * (3 / 12));
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        #bio {
            font-size: 20px;
            text-align: center;
            font-family: 'Inter', sans-serif;

            padding-left: calc(100% * (5.4 / 12));
            padding-right: calc(100% * (3 / 12));
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
            padding-bottom: 100px;
        }

        }
        .flex-text{
            position:relative;
            width: 484px;
            height: 58px;
            left: 80px;
            top: 91px;



            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 24px;
            line-height: 29px;
            text-align: center;

            color: #000000;

        }
        .quotes{
            box-sizing: border-box;
            width: 1640px;
            height: 42px;
            left: 200px;
            position: relative;


            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
            padding-bottom: 400px;

        }

        .flex-child {
            box-sizing: border-box;
            height: 242px;
            left: 260px;
            padding-top: 90px;


            background: #FFFFFF;
            border: 1.5px solid #000000;
            border-radius: 10px;
            flex: 1;





            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 24px;
            line-height: 29px;
            text-align: center;

            color: #000000;
        }

        .date{
            position: relative;
            left: 460px;
            padding-top: 20px;
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 24px;
            line-height: 29px;
            text-align: left;

            color: #000000;

        }

        .place{
            position: relative;
            left: 500px;
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 24px;
            line-height: 29px;
            text-align: left;

            color: #000000;

        }
        .flex-child:first-child {
            margin-right: 500px;
        }
        .quotetextleft{
            position:relative;
            width: 484px;
            height: 58px;
            left: 80px;
            top: 91px;



            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 24px;
            line-height: 29px;
            text-align: center;

            color: #000000;


        }
        .images{
            box-sizing: border-box;
            width: 1710px;
            height: 500px;
            float:right;
            float:left;
            padding-top: 40px;



            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;



        }

        .flex-image {
            box-sizing: border-box;
            height: 442px;
            left: 190px;
            padding-top: 90px;
            margin-right: 40px;
            position:relative;


            background: #FFFFFF;
            border: 1.5px solid #000000;
            border-radius: 10px;
            flex:1;





            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 24px;
            line-height: 29px;
            text-align: center;

            color: #000000;
        }

        .dateimage{
            position: relative;
            left: 280px;
            padding-top: 20px;
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 24px;
            line-height: 29px;
            text-align: left;

            color: #000000;

        }

        .placeimage{
            position: relative;
            left: 330px;
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 24px;
            line-height: 29px;
            text-align: left;

            color: #000000;

        }
        .flex-image:nth-child() {
            margin-right: 60px;
        }
        .personalimg{
            position: relative;
            width: 300px;
            height:300px;
            margin-top: -40px;

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
            <a href="index.php">IOVINE AND YOUNG ACADEMY YEARBOOK</a>
        </h2>
    </div>
    <div style="text-align: right; flex-grow: 2;">
        <h2>
            <a>LOGIN</a>
        </h2>
    </div>
    <div style="text-align: right; flex-grow: 1;">
        <h2>
            <a href="search.php">SEARCH</a>
        </h2>
    </div>
</div>
<div class="individualpage">
    <img src="kate.png" alt="picture of kate" id="individualimg">

    <h1 id="name"> Kate Mathew </h1>
</div>
<div id ="bio">
    Hi my name is Kate. I am cool.
</div>
<div class="quotes">
    <div class="flex-child"> “Did you hear that James started this club
        called Oozma Kappa?”
        <div class="date"> 9/25/22 </div>
        <div class="place"> IYH
        </div></div>
    <div class="flex-child"> “Can you take my contacts out?”   <div class="date"> 9/25/22 </div>
        <div class="place"> IYH</div>


    </div>
</div>

<!-- Row 1 --!>
<div class="images">
    <div class="flex-image">
        <img src="kate.png" alt="kate" class="personalimg">
        <div class="dateimage"> 9/25/22 </div>
        <div class="placeimage"> IYH </div>
    </div>
    <div class="flex-image"> <img src="kate.png" alt="kate" class="personalimg">
        <div class="dateimage"> 9/25/22 </div>
        <div class="placeimage"> IYH
        </div>
    </div>
    <div class="flex-image">
        <img src="kate.png" alt="kate" class="personalimg">
        <div class="dateimage"> 9/25/22 </div>
        <div class="placeimage"> IYH </div>
    </div>
    <div class="flex-image"> <img src="kate.png" alt="kate" class="personalimg">
        <div class="dateimage"> 9/25/22 </div>
        <div class="placeimage"> IYH
        </div>
    </div>

    <br>
    <!-- Row 2 --!>
    <div class="images">
        <div class="flex-image">
            <img src="kate.png" alt="kate" class="personalimg">
            <div class="dateimage"> 9/25/22 </div>
            <div class="placeimage"> IYH </div>
        </div>
        <div class="flex-image"> <img src="kate.png" alt="kate" class="personalimg">
            <div class="dateimage"> 9/25/22 </div>
            <div class="placeimage"> IYH
            </div>
        </div>
        <div class="flex-image">
            <img src="kate.png" alt="kate" class="personalimg">
            <div class="dateimage"> 9/25/22 </div>
            <div class="placeimage"> IYH </div>
        </div>
        <div class="flex-image"> <img src="kate.png" alt="kate" class="personalimg">
            <div class="dateimage"> 9/25/22 </div>
            <div class="placeimage"> IYH
            </div>
        </div>


        <!-- Row 3 --!>
        <div class="images">
            <div class="flex-image">
                <img src="kate.png" alt="kate" class="personalimg">
                <div class="dateimage"> 9/25/22 </div>
                <div class="placeimage"> IYH </div>
            </div>
            <div class="flex-image"> <img src="kate.png" alt="kate" class="personalimg">
                <div class="dateimage"> 9/25/22 </div>
                <div class="placeimage"> IYH
                </div>
            </div>
            <div class="flex-image">
                <img src="kate.png" alt="kate" class="personalimg">
                <div class="dateimage"> 9/25/22 </div>
                <div class="placeimage"> IYH </div>
            </div>
            <div class="flex-image"> <img src="kate.png" alt="kate" class="personalimg">
                <div class="dateimage"> 9/25/22 </div>
                <div class="placeimage"> IYH
                </div>
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




<!--   <div id="gallery
    <?php /*
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
    } */
?>
