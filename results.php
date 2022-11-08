<?php
// redirect page visitors to the search page if the date field is empty
if(empty($_REQUEST['date'])) {
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
    echo $dbconnection->connect_error;
    exit();
}
?>

<html lang="en">
<head>
    <title>IY8 Yearbook - Your Results</title>
    <link rel="shortcut icon" type="image/jpg" href="">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <link rel="stylesheet" href="main.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: burlywood;
            margin: 0 200px;
            text-align: center;
        }
        #container {
            padding: 30px;
            margin-top: 100px;
            background-color: olive;
            width: 650px;
            text-align: left;
            color:white;
        }
        .thumb {
            width: 100px;
        }
        .link {
            width: 100px;
            float:left;
            margin-left: 50px;
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

<div id="container">
    <h1>Your Results!</h1> <hr>
    <?php
    // first see whether the user is searching for images, quotes, or both types of records
    if($_REQUEST['quoteImages'] == 'Images') { // only searching for images

        $sql = "SELECT * FROM imagesView";

        if($_REQUEST['name'] != 'ALL') {
            $sql .= " AND name = '" . $_REQUEST["name"] . "'";
        }
        if($_REQUEST['event'] != 'ALL') {
            $sql .= " AND event = '" . $_REQUEST["event"] . "'";
        }
        if($_REQUEST['date'] != " ") {
            $sql .= " WHERE date > '" . $_REQUEST["date"] . "'";
        }

        $results = $dbconnection -> query($sql);

        echo "<em>Your results returned ";
        echo "<strong>" . $results -> num_rows . "</strong>";
        echo " image(s) </em>";
        echo "<br><br>";

        while($currentrow = $results -> fetch_assoc()) {
            echo "<div class='title'>";
            echo "<strong>";
            echo "<a href='details.php?yearbookID=" . $currentrow["image_id"] . "'>";
            echo "<img src='Image Uploads/" . $currentrow['image_name'] . "' class='thumb'>";
            echo "</a>";
            echo "</strong>";
            echo "<div class='link'>" . "" . "</div>";
            echo "</div>";
            echo "<br style='clear: both;'>";
        }

    } else if($_REQUEST['quoteImages'] == 'Quotes') { // only searching for quotes

        $sql = "SELECT * FROM quotesView";

        if($_REQUEST['name'] != 'ALL') {
            $sql .= " AND name = '" . $_REQUEST["name"] . "'";
        }
        if($_REQUEST['event'] != 'ALL') {
            $sql .= " AND event = '" . $_REQUEST["event"] . "'";
        }
        if($_REQUEST['date'] != " ") {
            $sql .= " WHERE date > '" . $_REQUEST["date"] . "'";
        }

        $results = $dbconnection -> query($sql);

        echo "<em>Your results returned ";
        echo "<strong>" . $results -> num_rows . "</strong>";
        echo " quote(s) </em>";
        echo "<br><br>";

        while($currentrow = $results -> fetch_assoc()) {
            echo "<div class='title'>";
            echo "<strong>";
            echo "<a href='details2.php?yearbookID=" . $currentrow["quote_id"] . "'>";
            echo $currentrow['quote'];
            echo "</a>";
            echo "</strong>";
            echo "<div class='link'>" . "" . "</div>";
            echo "</div>";
            echo "<br style='clear: both;'>";
        }

    } else if($_REQUEST['quoteImages'] == 'Both') { // seaching for both

        // display images first
        $sql = "SELECT * FROM imagesView";

        if($_REQUEST['name'] != 'ALL') {
            $sql .= " AND name = '" . $_REQUEST["name"] . "'";
        }
        if($_REQUEST['event'] != 'ALL') {
            $sql .= " AND event = '" . $_REQUEST["event"] . "'";
        }
        if($_REQUEST['date'] != " ") {
            $sql .= " WHERE date > '" . $_REQUEST["date"] . "'";
        }

        $results = $dbconnection -> query($sql);

        echo "<em>Your results returned ";
        echo "<strong>" . $results -> num_rows . "</strong>";
        echo " image(s) </em>";
        echo "<br><br>";

        while($currentrow = $results -> fetch_assoc()) {
            echo "<div class='title'>";
            echo "<strong>";
            echo "<a href='details.php?yearbookID=" . $currentrow["image_id"] . "'>";
            echo "<img src='Image Uploads/" . $currentrow['image_name'] . "' class='thumb'>";
            echo "</a>";
            echo "</strong>";
            echo "<div class='link'>" . "" . "</div>";
            echo "</div>";
            echo "<br style='clear: both;'>";
        }

        // display quotes second
        $sql = "SELECT * FROM quotesView";

        if($_REQUEST['name'] != 'ALL') {
            $sql .= " AND name = '" . $_REQUEST["name"] . "'";
        }
        if($_REQUEST['event'] != 'ALL') {
            $sql .= " AND event = '" . $_REQUEST["event"] . "'";
        }
        if($_REQUEST['date'] != " ") {
            $sql .= " WHERE date > '" . $_REQUEST["date"] . "'";
        }

        $results = $dbconnection -> query($sql);

        echo "<em>Your results returned ";
        echo "<strong>" . $results -> num_rows . "</strong>";
        echo " quote(s) </em>";
        echo "<br><br>";

        while($currentrow = $results -> fetch_assoc()) {
            echo "<div class='title'>";
            echo "<strong>";
            echo "<a href='details2.php?yearbookID=" . $currentrow["quote_id"] . "'>";
            echo $currentrow['quote'];
            echo "</a>";
            echo "</strong>";
            echo "<div class='link'>" . "" . "</div>";
            echo "</div>";
            echo "<br style='clear: both;'>";
        }
    }
    ?>
</div>
</body>
</html>
