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

// Dumping variables here to help with looking for bugs
// var_dump($_REQUEST);
// var_dump($_FILES);
?>

<html language="en">
<head>
    <title>IY8 Yearbook - Upload Image Page</title>
    <link rel="shortcut icon" type="image/jpg" href="">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <link rel="stylesheet" href="main.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">

    <style>
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
    // First, move the newly uploaded image to the appropriate Image Uploads folder
    $filepath = $_SERVER["CONTEXT_DOCUMENT_ROOT"] . "/acad276/IY8-Yearbook/Image Uploads/";
    move_uploaded_file($_FILES["newimage"]["tmp_name"], $filepath . $_FILES["newimage"]["name"]);

    // Then, add the new image to the Images table with all the necessary info
    $sql = "INSERT INTO images
        (image_type_id, name_id, image_name, date, event_id)
        VALUES
        (" . $_REQUEST["image-type"] . ",
        " . $_REQUEST["photographer"] . ",
        '" . $_FILES["newimage"]["name"] . "',
        '" . $_REQUEST["date"] . "',
        " . $_REQUEST["event"] . ")";

    $results = $mysql -> query($sql);

    // Testing for possible errors
    if(!$results) {
        echo "SQL ERROR! " . $mysql -> error;
    } else {
        echo "<h1 class='section-title'>";
        echo "UPDATE CONFIRMATION PAGE";
        echo "</h1>";
        echo "<p>";
        echo "Your image has been successfully added.";
        echo "<br><br>";
        echo "Add tagged individuals by accessing your uploaded images on your profile";
        echo "</p>";
    }
    ?>
</div>

<?php include "Global Elements/footer.php"; ?>

</body>
</html>




