<?php
session_start();

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

// recent searches by one user
$myrecsql = "SELECT event_name
FROM  searches_view
WHERE user_id =" . $_SESSION["user_id"] . "
ORDER BY searchtime DESC";

// popular searches
$favsql = "SELECT count(*) AS count, event_name
FROM  searchesView
GROUP BY event_name
ORDER BY count DESC";
?>

<table>
    <tr>
        <th>Most Popular Searched Events</th>
        <th>Your Most Recent Searches</th>
    </tr>
    <tr>
        <th>
            <?php
            $dbconnection -> query($favsql);
            ?>
        </th>
        <th>
            <?php
            if(!empty($_SESSION["user_id"])) {
                $dbconnection -> query($myrecsql);
            } else {
                echo "Please log in to view your most recent searches.";
            }
            ?>
        </th>
    </tr>
</table>
