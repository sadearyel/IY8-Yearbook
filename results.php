<?php

if(empty($_REQUEST['name'])) {
    header('Location: search.php');
    exit();
}
if(empty($_REQUEST['event'])) {
    header('Location: search.php');
    exit();
}
if(empty($_REQUEST['date'])) {
    header('Location: search.php');
    exit();

}
if(empty($_REQUEST['quoteImages'])) {
    header('Location: search.php');
    exit();

}
//1. Connect to db
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

<html>
<head>
    <title>Your Results</title>
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

        .className {
            width: 500px;

            float:left;
        }

        .link {
            width: 100px;
            float:left;
            margin-left: 50px;

        }
        .thumb {
            width: 40px; float:left;
        }
    </style>
</head>
<body>
<div id="container">
    <h1>Your Results!</h1> <hr>
    <?php


    $sql = "SELECT * FROM imagesView";
    if ($_REQUEST['date'] != " ") {
        $sql = $sql . "
    WHERE date > '" . $_REQUEST["date"] . "'";
    }
    if ($_REQUEST['name'] != "ALL") {
        $sql .= " AND name ='" . $_REQUEST["name"] . "'";
    }
    if ($_REQUEST['event'] != "ALL") {
        $sql .= " AND event ='" . $_REQUEST["event"] . "'";
    };

    $results = $dbconnection->query($sql);

    if (!$results) {
        echo "<hr>Your SQL:<br> " . $sql . "<br><br>";
        echo "SQL Error: " . $dbconnection->error . "<hr>";
        exit();
    }

    echo "<em>Your results returned <strong>" .
        $results->num_rows .
        "</strong> image(s).</em>";
    echo "<br><br>";

    while ($currentrow = $results->fetch_assoc()) {
        echo "<div class='title'><strong>" .
            "<a href='details.php?yearbookID=" . $currentrow["image_id"] . "'>" .
            "<img src='" . $currentrow['image_name'] . "' class='thumb'>" . "</a>" .
            "</strong>" .
            "<div class='link''>" . "  " . "</div>" .
            "<br style='clear:both;'>";


    }

    ?>
    <?php

    $sql = "SELECT * FROM quotesView";
    if ($_REQUEST['date'] != " ") {
        $sql = $sql . "
    WHERE date > '" . $_REQUEST["date"] . "'";
    }
    if ($_REQUEST['name'] != "ALL") {
        $sql .= " AND name ='" . $_REQUEST["name"] . "'";
    }
    if ($_REQUEST['event'] != "ALL") {
        $sql .= " AND event ='" . $_REQUEST["event"] . "'";
    };

    $results = $dbconnection->query($sql);

    if (!$results) {
        echo "<hr>Your SQL:<br> " . $sql . "<br><br>";
        echo "SQL Error: " . $dbconnection->error . "<hr>";
        exit();
    }

    echo "<em>Your results returned <strong>" .
        $results->num_rows .
        "</strong> quote(s).</em>";
    echo "<br><br>";

    while ($currentrow = $results->fetch_assoc()) {
        echo "<div class='title'><strong>" .
            "<a href='details2.php?yearbookID=" . $currentrow["quote_id"] . "'>" .
            $currentrow['quote'] . "</a>" .
            "</strong>" .
            "<div class='link''>" . "  " . "</div>" .
            "<br style='clear:both;'>";

    }
    ?>
</div>

</body></html>
