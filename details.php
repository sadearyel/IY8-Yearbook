<?php
// redirect page visitors to the search page if it was accessed in error
if(empty($_REQUEST["yearbookID"])){
    header('Location: search.php');
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
<html>
<head>
    <title>IY8 Yearbook - Image Details</title>
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
    </style>
</head>
<body>

<?php include "Global Elements/nav.php"; ?>

<div id="container">
    <h1 class="section-title">
        IMAGE DETAILS
    </h1>

    <?php

    $sql = "SELECT * from imagesView WHERE image_id = " . $_REQUEST["yearbookID"];

    $results = $dbconnection -> query($sql);

    // checking for errors
    if(!results) {
        echo "ERROR: " . $dbconnection -> error;
    }

    while($currentrow = $results -> fetch_assoc()) {
        echo "<img src='Image Uploads/" . $currentrow["image_name"] . "' style='width: 80%; margin: 20px;'>";
        echo "<p>";
        echo "Photographer: " . "<a href='individualpage2.php?nameID=" . $currentrow["name_id"] . "'>" . $currentrow["name"] . "</a>";
        echo "<br>";
        echo "Event: " . $currentrow["event"];
        echo "<br>";
        echo "Date: " . $currentrow["date"];
        echo "</p>";
    }

    ?>

</div>

<?php include "Global Elements/footer.php"; ?>

</body>
</html>