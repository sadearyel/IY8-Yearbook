<?php
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
        #gallery img {
            width: 10.001%;
            padding-bottom: 10px;
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
    </style>
</head>
<body>

<?php include "Global Elements/nav.php"; ?>

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



        <?php include "Global Elements/footer.php"; ?>
</body>
</html>