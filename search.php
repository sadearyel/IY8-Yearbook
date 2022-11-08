<?php
//form, want to be able to search by name (drop down), event (drop down), date (range - date), quote and images default


//1. Connect to db
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
    <title>IY8 Yearbook Search!</title>
</head>
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
        width: 300px;
        text-align: left;
        color:white;
    }

    .label {
        float:left;
        clear:both;
        width: 120px;
    }
    h1{
        margin-bottom: -15px;
    }
</style>

<body>
<div id="container">
    <div style="text-align: center"><h1>IY8 Yearbook Search!</h1><br><em>please enter all information</em></div>
    <hr>

    <form action="results.php">

        <?php   $sql = "SELECT * FROM names ORDER BY name";
        $results = $dbconnection->query($sql);

        if(!$results) {
            echo "SQL error: ". $dbconnection->error;
            exit();
        }?>

        Name: <select name="name">
                <option value="All">Cohort</option>
                <?php
                while($currentrow = $results->fetch_assoc()){
                    echo "<option>" . $currentrow["name"]."</option>";
                }
                ?>
        </select>
            <br style="clear:both;">

        <?php   $sql = "SELECT * FROM events ORDER BY event";
        $results = $dbconnection->query($sql);

        if(!$results) {
            echo "SQL error: ". $dbconnection->error;
            exit();
        }?>
                Events: <select name="event">
                    <option value="All">Everything</option>
                    <?php
                    while($currentrow = $results->fetch_assoc()){
                        echo "<option>" . $currentrow["event"]."</option>";
                    }
                    ?>
        </select>
                <br style="clear:both;">

                <div class="label">After Date:</div> <input type="text" name="date" placeholder="yyyy-mm-dd">

                <br style="clear:both;">

                <div class="label">Quote or Images:</div>    <select name="quoteImages">
                    <option>Images</option>
                    <option>Quotes</option>
                    </select>
        <br>

        <br style="clear:both;">




        <br style="clear:both;">
        <br style="clear:both;">
        <div style="text-align:center;"><input type="submit" value="Search!" style="background-color: darkolivegreen; color: white; border: 0"></div>
</div>
</form>
</body>
</html>