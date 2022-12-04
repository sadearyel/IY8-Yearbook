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

$results = $dbconnection -> query($favsql);
$myresults = $dbconnection -> query($myrecsql);
?>

<p>Most Popular Searched Events</p>
<?php
$count=0;
while($currentrow = mysqli_fetch_array($results) && $count>5) {
    ++$count;
    echo $currentrow["event_name"] . "<br>";
    var_dump($currentrow);
}
?>

<p>Your Most Recent Searches</p>
<?php
$count=0;
if(!empty($_SESSION["user_id"])) {
    while($currentrow = mysqli_fetch_array($myresults) && $count>5) {
    ++$count;
    echo $currentrow["event_name"] . "<br>";
    var_dump($currentrow);
} else {
    echo "Please log in to view your most recent searches.";
}
?>
