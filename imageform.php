<!-- We'll use this page to add images to the images table in our db --!>

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
    <title>Administrator Only - Image Form Page</title>
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
        form {
            width: 60%;
            padding-left: 20%;
            padding-right: 20%;

            text-align: left;
        }
        input[type=text], input[type=date], select {
            width: 100%;
            padding-top: 12px;
            padding-bottom: 12px;
            padding-left: 10px;
            padding-right: 10px;

            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=submit] {
            width: 100%;
            margin-top: 50px;
            padding-top: 12px;
            padding-bottom: 12px;
            padding-left: 20px;
            padding-right: 20px;

            background-color: black;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php include "Global Elements/nav.php"; ?>

<div id="container">
    <h1 class="section-title">
        IMAGE UPLOAD FORM
    </h1>
    <form action="imageupload.php" method="post" enctype="multipart/form-data">

        <label for="newimage">
            Image File:
        </label>
        <input type="file" name="newimage">

        <br><br>

        <label for="image-type">
            Image Type:
        </label>
        <select name="image-type">
            <?php
            $sql = "SELECT * FROM image_types";
            $results = $mysql -> query($sql);

            while($currentrow = $results -> fetch_assoc()) {
                echo "<option value='" . $currentrow['image_type_id'] . "'>" . $currentrow['image_type'] . "</option>";
            }
            ?>
        </select>

        <br><br>

        <label for="photographer">
            Photographer:
        </label>
        <select name="photographer">
            <?php
            $sql = "SELECT * FROM names";
            $results = $mysql -> query($sql);

            while($currentrow = $results -> fetch_assoc()) {
                echo "<option value='" . $currentrow['name_id'] . "'>" . $currentrow['name'] . "</option>";
            }
            ?>
        </select>

        <br><br>

        <label for="date">
            Date:
        </label>
        <input type="date" name="date">

        <br><br>


        <label for="event">
            Event:
        </label>
        <select name="event">
            <?php
            $sql = "SELECT * FROM events";
            $results = $mysql -> query($sql);

            while($currentrow = $results -> fetch_assoc()) {
                echo "<option value='" . $currentrow['event_id'] . "'>" . $currentrow['event'] . "</option>";
            }
            ?>
        </select>

        <br><br>

        <input type="submit">
    </form>
</div>

<?php include "Global Elements/footer.php"; ?>

</body>