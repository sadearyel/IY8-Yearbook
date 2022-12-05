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

// data visualization code - log search to searches table only if the user is logged in
if(!empty($_SESSION["user_id"])) {
    $userid = $_SESSION["user_id"];

    // grab event id from event table
    $sql_search_event = "SELECT * FROM events WHERE event = '" . $_REQUEST["event"] . "'";
    $results_search_event = $dbconnection -> query($sql_search_event);
    $currentrow_search_event = $results_search_event -> fetch_assoc();

    // insert search into searches table
    $sql_searches = "INSERT INTO searches 
    (event_id, searchtime, user_id) 
    VALUES 
    (" . $currentrow_search_event["event_id"] . ", '" . date('y-m-d H:i:s') . "', " . $userid . ")";

    $results_searches = $dbconnection -> query($sql_searches);
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

        // email results code - if the user is logged in, email their results to the email associated with their account
        $message = "";

        if(!empty($_SESSION["user_id"])) {
            $message .= "Thank you for visting the <a href='http://webdev.iyaclasses.com/~icleung/acad276/IY8-Yearbook/index.php'>IY8 Yearbook</a> site. To ensure you don't forget the memories you've flipped through, we've decided to send over a quick summary of your finds.";
            $message .= "<hr>";
        }

        // first complete the rest of the result summary html block
        echo "IMAGES";
        echo "</h1>";
        echo "<p>";

        $message .= "IMAGES";
        $message .= "<br><br>";

        // back to regular sql statements to parse through the database
        $sql = "SELECT * FROM imagesView";

        if($_REQUEST['date'] != " ") {
            $sql .= " WHERE date > '" . $_REQUEST["date"] . "'";
            echo "Taken after date " . $_REQUEST["date"];
            $message .= "Taken after date " . $_REQUEST["date"];
        } else {
            echo "Taken at any date";
            $message .= "Taken at any date";
        }

        echo "<br>";
        $message .= "<br>";

        if($_REQUEST['name'] != 'ALL') {
            $sql .= " AND name = '" . $_REQUEST["name"] . "'";
            echo "Photographed by " . $_REQUEST["name"];
            $message .= "Photographed by " . $_REQUEST["name"];
        } else {
            echo "Photographed by anyone in the cohort";
            $message .= "Photographed by anyone in the cohort";
        }

        echo "<br>";
        $message .= "<br>";

        if($_REQUEST['event'] != 'ALL') {
            $sql .= " AND event = '" . $_REQUEST["event"] . "'";
            echo "At event " . $_REQUEST["event"];
            $message .= "At event " . $_REQUEST["event"];
        } else {
            echo "At any event";
            $message .= "At any event";
        }

        echo "<br><br>";
        $message .= "<br><br>";

        $results = $dbconnection -> query($sql);

        echo "<em>Your results returned ";
        echo $results -> num_rows;
        echo " image(s) </em>";

        $message .= "<em>Your results returned ";
        $message .= $results -> num_rows;
        $message .= " image(s) </em>";
        $message .= "<br><br>";
        $message .= "Here are the first 20 results.";
        $message .= "<br>";

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

            $message .= "<img src='Image Uploads/" . $currentrow['image_name'] . "' class='thumb'>";
            $message .= "<br style='clear: both;'>";

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

        // email results code - email all the results
        if(!empty($_SESSION["user_id"])) {
            $sql_email = "SELECT * FROM users WHERE user_id = " . $_SESSION["user_id"];
            $results_email = $dbconnection->query($sql_email);
            $currentrow_email = $results_email->fetch_assoc();

            $to = $currentrow_email["email"];
            $subject = "Your Recent Search on IY8 Yearbook";

            $test = mail($to, $subject, $message);

            if($test == 1) {
                echo "Email with your recent search has been successfully sent to " . $to . ".";
            } else {
                echo "ERROR. Email NOT sent.";
            }
        }

    } else if($_REQUEST['quoteImages'] == 'Quotes') { // only searching for quotes

        // email results code - if the user is logged in, email their results to the email associated with their account
        $message = "";

        if(!empty($_SESSION["user_id"])) {
            $message .= "Thank you for visting the <a href='http://webdev.iyaclasses.com/~icleung/acad276/IY8-Yearbook/index.php'>IY8 Yearbook</a> site. To ensure you don't forget the memories you've flipped through, we've decided to send over a quick summary of your finds.";
            $message .= "<hr>";
        }

        // first complete the rest of the result summary html block
        echo "QUOTES";
        echo "</h1>";
        echo "<p>";

        $message .= "QUOTES";
        $message .= "<br><br>";

        // back to regular sql statements to parse through the database
        $sql = "SELECT * FROM quotesView";

        if($_REQUEST['date'] != " ") {
            $sql .= " WHERE date > '" . $_REQUEST["date"] . "'";
            echo "Said after date " . $_REQUEST["date"];
            $message .= "Said after date " . $_REQUEST["date"];
        } else {
            echo "Said at any date";
            $message .= "Said at any date";
        }

        echo "<br>";
        $message .= "<br>";

        if($_REQUEST['name'] != 'ALL') {
            $sql .= " AND name = '" . $_REQUEST["name"] . "'";
            echo "Said by " . $_REQUEST["name"];
            $message .= "Said by " . $_REQUEST["name"];
        } else {
            echo "Said by anyone in the cohort";
            $message .= "Said by anyone in the cohort";
        }

        echo "<br>";
        $message .= "<br>";

        if($_REQUEST['event'] != 'ALL') {
            $sql .= " AND event = '" . $_REQUEST["event"] . "'";
            echo "At event " . $_REQUEST["event"];
            $message .= "At event " . $_REQUEST["event"];
        } else {
            echo "At any event";
            $message .= "At any event";
        }

        echo "<br><br>";
        $message .= "<br><br>";

        $results = $dbconnection -> query($sql);

        echo "<em>Your results returned ";
        echo $results -> num_rows;
        echo " quote(s) </em>";

        $message .= "<em>Your results returned ";
        $message .= $results -> num_rows;
        $message .= " image(s) </em>";
        $message .= "<br><br>";
        $message .= "Here are the first 20 results.";
        $message .= "<br>";

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

            $message .= $currentrow['quote'];
            $message .= "<br style='clear: both;'>";

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

        // email results code - email all the results
        if(!empty($_SESSION["user_id"])) {
            $sql_email = "SELECT * FROM users WHERE user_id = " . $_SESSION["user_id"];
            $results_email = $dbconnection->query($sql_email);
            $currentrow_email = $results_email->fetch_assoc();

            $to = $currentrow_email["email"];
            $subject = "Your Recent Search on IY8 Yearbook";

            $test = mail($to, $subject, $message);

            if($test == 1) {
                echo "Email with your recent search has been successfully sent to " . $to . ".";
            } else {
                echo "ERROR. Email NOT sent.";
            }
        }

    } else if($_REQUEST['quoteImages'] == 'Both') { // seaching for both

        // email results code - if the user is logged in, email their results to the email associated with their account
        $message = "";

        if(!empty($_SESSION["user_id"])) {
            $message .= "Thank you for visting the <a href='http://webdev.iyaclasses.com/~icleung/acad276/IY8-Yearbook/index.php'>IY8 Yearbook</a> site. To ensure you don't forget the memories you've flipped through, we've decided to send over a quick summary of your finds.";
            $message .= "<hr>";
        }

        echo "IMAGES AND QUOTES";
        echo "</h1>";
        echo "<p>";

        $message .= "IMAGES AND QUOTES";
        $message .= "<br><br>";

        // display images first
        $sql = "SELECT * FROM imagesView";

        if($_REQUEST['date'] != " ") {
            $sql .= " WHERE date > '" . $_REQUEST["date"] . "'";
            echo "Taken after date " . $_REQUEST["date"];
            $message .= "Taken after date " . $_REQUEST["date"];
        } else {
            echo "Taken at any date";
            $message .= "Taken at any date";
        }

        echo "<br>";
        $message .= "<br>";

        if($_REQUEST['name'] != 'ALL') {
            $sql .= " AND name = '" . $_REQUEST["name"] . "'";
            echo "Photographed by " . $_REQUEST["name"];
            $message .= "Photographed by " . $_REQUEST["name"];
        } else {
            echo "Photographed by anyone in the cohort";
            $message .= "Photographed by anyone in the cohort";
        }

        echo "<br>";
        $message .= "<br>";

        if($_REQUEST['event'] != 'ALL') {
            $sql .= " AND event = '" . $_REQUEST["event"] . "'";
            echo "At event " . $_REQUEST["event"];
            $message .= "At event " . $_REQUEST["event"];
        } else {
            echo "At any event";
            $message .= "At any event";
        }

        echo "<br><br>";
        $message .= "<br><br>";

        $results = $dbconnection -> query($sql);

        echo "<em>Your results returned ";
        echo $results -> num_rows;
        echo " image(s) </em>";

        $message .= "<em>Your results returned ";
        $message .= $results -> num_rows;
        $message .= " image(s) </em>";
        $message .= "<br><br>";
        $message .= "Here are the first 20 results.";
        $message .= "<br>";

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

            $message .= "<img src='Image Uploads/" . $currentrow['image_name'] . "' class='thumb'>";
            $message .= "<br style='clear: both;'>";
        }

        // display quotes second
        echo "<p>";
        echo "<br><br><br>";
        $message .= "<br><br><br>";

        $sql = "SELECT * FROM quotesView";

        if($_REQUEST['date'] != " ") {
            $sql .= " WHERE date > '" . $_REQUEST["date"] . "'";
            echo "Said after date " . $_REQUEST["date"];
            $message .= "Said after date " . $_REQUEST["date"];
        } else {
            echo "Said at any date";
            $message .= "Said at any date";
        }

        echo "<br>";
        $message .= "<br>";

        if($_REQUEST['name'] != 'ALL') {
            $sql .= " AND name = '" . $_REQUEST["name"] . "'";
            echo "Said by " . $_REQUEST["name"];
            $message .= "Said by " . $_REQUEST["name"];
        } else {
            echo "Said by anyone in the cohort";
            $message .= "Said by anyone in the cohort";
        }

        echo "<br>";
        $message .= "<br>";

        if($_REQUEST['event'] != 'ALL') {
            $sql .= " AND event = '" . $_REQUEST["event"] . "'";
            echo "At event " . $_REQUEST["event"];
            $message .= "At event " . $_REQUEST["event"];
        } else {
            echo "At any event";
            $message .= "At any event";
        }
        echo "<br><br>";
        $message .= "<br><br>";

        $results = $dbconnection -> query($sql);

        echo "<em>Your results returned ";
        echo $results -> num_rows;
        echo " quote(s) </em>";

        $message .= "<em>Your results returned ";
        $message .= $results -> num_rows;
        $message .= " image(s) </em>";
        $message .= "<br><br>";
        $message .= "Here are the first 20 results.";
        $message .= "<br>";

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

            $message .= $currentrow['quote'];
            $message .= "<br style='clear: both;'>";
        }

        // email results code - email all the results
        if(!empty($_SESSION["user_id"])) {
            $sql_email = "SELECT * FROM users WHERE user_id = " . $_SESSION["user_id"];
            $results_email = $dbconnection->query($sql_email);
            $currentrow_email = $results_email->fetch_assoc();

            $to = $currentrow_email["email"];
            $subject = "Your Recent Search on IY8 Yearbook";

            $test = mail($to, $subject, $message);

            if($test == 1) {
                echo "Email with your recent search has been successfully sent to " . $to . ".";
            } else {
                echo "ERROR. Email NOT sent.";
            }
        }
    }
    ?>
</div>

<?php include "Global Elements/footer.php"; ?>

</body>
</html>
