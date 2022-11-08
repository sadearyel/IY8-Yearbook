<?php

if(empty($_REQUEST["yearbookID"])){
    echo "ERROR. Please go through the"
    ?>
    <a href=search.php'>search page.</a>
    <?php
    exit();
}
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
            .detail {
                width: 500px; float:left;
            }
        </style>
    </head>
    <body></body>
    </html>


<?php

$sql = "SELECT * from quotesView WHERE quote_id = " . $_REQUEST["yearbookID"];

$results = $dbconnection -> query($sql);
if(!results) {
    echo "ERROR: " . $dbconnection -> error;
}

while($currentrow = $results->fetch_assoc()) {
    echo "<div class='title'><strong>" .
        "Name: " .
        $currentrow['name'] .
        "<br>" .
        "Quote: " .
        $currentrow['quote'] .
        "<br>" .
        "</strong>".
        " (<em> Date: " . $currentrow['date'] . "</em>) </div>" .
        "<div class='link''>" . "  " . "</div>"  .
        "<br style='clear:both;'>";


}

?>