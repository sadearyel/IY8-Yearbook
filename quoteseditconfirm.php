<?php
session_start();

// connect to db
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

if($mysql -> errno) {
    echo "DB CONNECTION ERROR!<br>";
    echo $mysql -> connect_error;
    exit();
}

// Update the regular fields in the images table - not including tagged individuals just yet
$sql =  "UPDATE quotes SET " .
    "name_id = " . $_REQUEST['name'] . ", " .
    "date = " . $_REQUEST['date'] . ", " .
    "WHERE quote_id = " . $_REQUEST['quote_id'];

$results = $mysql -> query($sql);

?>

<html lang="en">
<head>
    <title>IY8 Yearbook - Edit Quotes Page</title>
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
    // This page requires users to be logged in
    // Redirect page visitors to the login page if it was accessed in error
    if(empty($_SESSION["user_id"])){
        echo "<p>Please login to access this page.</p>";
        exit();
    }

    if(!$results) {
        echo $sql;
        echo $mysql->error();
    } else {
        echo "<h1 class='section-title'>";
        echo "UPDATE CONFIRMATION PAGE";
        echo "</h1>";
        echo "<p>";
        echo "Your quote has been successfully updated.";
        echo "<br><br>";
        echo "<a href = 'profile.php'>";
        echo "Return to Profile page.";
        echo "</a>";
        echo "</p>";
    }
    ?>

</div>

<?php include "Global Elements/footer.php"; ?>

</body>
</html>