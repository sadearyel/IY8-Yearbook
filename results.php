<?php
session_start();

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
            font-family: 'Inter', sans-serif;
        }
        #results {
            padding-top: 100px;
            padding-bottom: 100px;
            padding-left: calc(100% * (1 / 12));
            padding-right: calc(100% * (1 / 12));

            text-align: center;
        }
        .thumb {
            width: 20%;
        }

        /* Not yet used, might delete this later */
        .link {
            width: 100px;
            float:left;
            margin-left: 50px;
        }
    </style>
</head>
<body>

<?php include "Global Elements/nav.php"; ?>

<div id="results">
    <h1 class="section-title">
        YOU SEARCHED FOR

    <?php
    // first see whether the user is searching for images, quotes, or both types of records
    if($_REQUEST['quoteImages'] == 'Images') { // only searching for images

        // first complete the rest of the result summary html block
        echo "IMAGES";
        echo "</h1>";
        echo "<p>";

        // back to regular sql statements to parse through the database
        $sql = "SELECT * FROM imagesView";

        if($_REQUEST['name'] != 'ALL') {
            $sql .= " AND name = '" . $_REQUEST["name"] . "'";
            echo "Photographed by " . $_REQUEST["name"];
        } else {
            echo "Photographed by anyone in the cohort";
        }

        echo "<br>";

        if($_REQUEST['event'] != 'ALL') {
            $sql .= " AND event = '" . $_REQUEST["event"] . "'";
            echo "At event " . $_REQUEST["event"];
        } else {
            echo "At any event";
        }

        echo "<br>";

        if($_REQUEST['date'] != " ") {
            $sql .= " WHERE date > '" . $_REQUEST["date"] . "'";
            echo "Taken after date " . $_REQUEST["date"];
        } else {
            echo "Taken at any date";
        }

        echo "<br><br>";

        $results = $dbconnection -> query($sql);

        echo "<em>Your results returned ";
        echo $results -> num_rows;
        echo " image(s) </em>";

        echo "<br><br>";
        echo "</p>";

        // pagination code
        $start = 1;
        if(!empty($_REQUEST["start"])) {
            $start = $_REQUEST["start"];
        }
        $end = $start + 19;
        $i = $start - 1;
        $results -> data_seek($i);

        while($currentrow = $results -> fetch_assoc()) {
            $i++;

            echo "<div class='title'>";
            echo "<strong>";
            echo "<a href='details.php?yearbookID=" . $currentrow["image_id"] . "'>";
            echo "<img src='Image Uploads/" . $currentrow['image_name'] . "' class='thumb'>";
            echo "</a>";
            echo "</strong>";
            echo "<div class='link'>" . "" . "</div>";
            echo "</div>";
            echo "<br style='clear: both;'>";

            if($i == $end) {
              break;
            }
        }

        $url = "results.php?";
        $url .= "name=" . $_REQUEST["name"];
        $url .= "&event=" . $_REQUEST["event"];
        $url .= "&date=" . $_REQUEST["date"];
        $url .= "&quoteImages=" . $_REQUEST["quoteImages"];
        $url .= "&start=" . ($end + 1);

        echo "<br><br>";
        echo "Currently displaying records " . $start . " through " . $end . ".";

        echo "<a href='" . $url . "'>";
        echo "<div style='margin-top: 50px; margin-left: 40%; margin-right: 40%; padding-top: 12px; padding-bottom: 12px; width: 20%; background-color: black; color: white; border-radius: 4px;'>";
        echo "Next";
        echo "</div>";
        echo "</a>";

    } else if($_REQUEST['quoteImages'] == 'Quotes') { // only searching for quotes

        // first complete the rest of the result summary html block
        echo "QUOTES";
        echo "</h1>";
        echo "<p>";


        // back to regular sql statements to parse through the database
        $sql = "SELECT * FROM quotesView";

        if($_REQUEST['name'] != 'ALL') {
            $sql .= " AND name = '" . $_REQUEST["name"] . "'";
            echo "Said by " . $_REQUEST["name"];
        } else {
            echo "Said by anyone in the cohort";
        }

        echo "<br>";

        if($_REQUEST['event'] != 'ALL') {
            $sql .= " AND event = '" . $_REQUEST["event"] . "'";
            echo "At event " . $_REQUEST["event"];
        } else {
            echo "At any event";
        }

        echo "<br>";

        if($_REQUEST['date'] != " ") {
            $sql .= " WHERE date > '" . $_REQUEST["date"] . "'";
            echo "Said after date " . $_REQUEST["date"];
        } else {
            echo "Said at any date";
        }

        echo "<br><br>";

        $results = $dbconnection -> query($sql);

        echo "<em>Your results returned ";
        echo $results -> num_rows;
        echo " quote(s) </em>";

        echo "<br><br>";
        echo "</p>";

        // pagination code
        $start = 1;
        if(!empty($_REQUEST["start"])) {
            $start = $_REQUEST["start"];
        }
        $end = $start + 19;
        $i = $start - 1;
        $results -> data_seek($i);

        while($currentrow = $results -> fetch_assoc()) {
            $i++;

            echo "<div class='title'>";
            echo "<strong>";
            echo "<a href='details2.php?yearbookID=" . $currentrow["quote_id"] . "'>";
            echo $currentrow['quote'];
            echo "</a>";
            echo "</strong>";
            echo "<div class='link'>" . "" . "</div>";
            echo "</div>";
            echo "<br style='clear: both;'>";

            if($i == $end) {
                break;
            }
        }

        $url = "results.php?";
        $url .= "name=" . $_REQUEST["name"];
        $url .= "&event=" . $_REQUEST["event"];
        $url .= "&date=" . $_REQUEST["date"];
        $url .= "&quoteImages=" . $_REQUEST["quoteImages"];
        $url .= "&start=" . ($end + 1);

        echo "<br><br>";
        echo "Currently displaying records " . $start . " through " . $end . ".";

        echo "<a href='" . $url . "'>";
        echo "<div style='margin-top: 50px; margin-left: 40%; margin-right: 40%; padding-top: 12px; padding-bottom: 12px; width: 20%; background-color: black; color: white; border-radius: 4px;'>";
        echo "Next";
        echo "</div>";
        echo "</a>";

    } else if($_REQUEST['quoteImages'] == 'Both') { // seaching for both

        echo "IMAGES AND QUOTES";
        echo "</h1>";
        echo "<p>";

        // display images first
        $sql = "SELECT * FROM imagesView";

        if($_REQUEST['name'] != 'ALL') {
            $sql .= " AND name = '" . $_REQUEST["name"] . "'";
            echo "Photographed by " . $_REQUEST["name"];
        } else {
            echo "Photographed by anyone in the cohort";
        }

        echo "<br>";

        if($_REQUEST['event'] != 'ALL') {
            $sql .= " AND event = '" . $_REQUEST["event"] . "'";
            echo "At event " . $_REQUEST["event"];
        } else {
            echo "At any event";
        }

        echo "<br>";

        if($_REQUEST['date'] != " ") {
            $sql .= " WHERE date > '" . $_REQUEST["date"] . "'";
            echo "Taken after date " . $_REQUEST["date"];
        } else {
            echo "Taken at any date";
        }

        echo "<br><br>";

        $results = $dbconnection -> query($sql);

        echo "<em>Your results returned ";
        echo $results -> num_rows;
        echo " image(s) </em>";

        echo "<br><br>";
        echo "</p>";

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
        echo "<p>";
        echo "<br><br><br>";

        $sql = "SELECT * FROM quotesView";

        if($_REQUEST['name'] != 'ALL') {
            $sql .= " AND name = '" . $_REQUEST["name"] . "'";
            echo "Said by " . $_REQUEST["name"];
        } else {
            echo "Said by anyone in the cohort";
        }

        echo "<br>";

        if($_REQUEST['event'] != 'ALL') {
            $sql .= " AND event = '" . $_REQUEST["event"] . "'";
            echo "At event " . $_REQUEST["event"];
        } else {
            echo "At any event";
        }

        echo "<br>";

        if($_REQUEST['date'] != " ") {
            $sql .= " WHERE date > '" . $_REQUEST["date"] . "'";
            echo "Said after date " . $_REQUEST["date"];
        } else {
            echo "Said at any date";
        }

        echo "<br><br>";

        $results = $dbconnection -> query($sql);

        echo "<em>Your results returned ";
        echo $results -> num_rows;
        echo " quote(s) </em>";

        echo "<br><br>";
        echo "</p>";

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

<?php include "Global Elements/footer.php"; ?>

</body>
</html>
