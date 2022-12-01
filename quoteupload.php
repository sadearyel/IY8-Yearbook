<?php

session_start();

$host = "webdev.iyaclasses.com";
$userid = "icleung";
$userpw = "AcadDev_Leung_7912600781";
$db = "icleung_yearbook";
$mysql = new mysqli ($host, $userid, $userpw, $db);

if($mysql -> errno) {
    echo "DB CONNECTION ERROR!<br>";
    echo $mysql -> connect_error;
    exit();
}


// Dumping variables here to help with looking for bugs
// var_dump($_REQUEST);
// var_dump($_FILES);
?>

<html language="en">
<head>
    <title>IY8 Yearbook - Upload Quotes Page</title>
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

    $sql = "INSERT INTO quotes
(quote, name_id, date)
VALUES 
('" . $_REQUEST["quote"] . "',
 '" . $_REQUEST["name"] . "',
 '" . $_REQUEST["date"] . "')";

    echo "<hr>" . $sql;

    $results = $mysql -> query($sql);

    // Testing for possible errors
    if(!$results) {
        echo "SQL ERROR! " . $mysql -> error;
    } else {
        echo "<h1 class='section-title'>";
        echo "UPDATE CONFIRMATION PAGE";
        echo "</h1>";
        echo "<p>";
        echo "Your quote has been successfully added.";
        echo "<br><br>";
        echo "</p>";
    }
    ?>
</div>

<?php include "Global Elements/footer.php"; ?>

</body>
</html>




