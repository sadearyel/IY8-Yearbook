<?php
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
    <title>IY8 Yearbook Login!</title>
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
    <div style="text-align: center"><h1>IY8 Yearbook Login!</h1><br><em>new to the site? <a href='search.php'>create an account here.</a> </em></div>
    <hr>

    <form action="loginresults.php">

        <div class="label">Username:</div> <input type="text" name="username" placeholder="Username">

        <br style="clear:both;">

        <div class="label">Password:</div> <input type="text" name="password" placeholder="Password">

        <br style="clear:both;">

        <br style="clear:both;">
        <br style="clear:both;">
        <div style="text-align:center;"><input type="submit" value="Login!" style="background-color: darkolivegreen; color: white; border: 0"></div>
</div>
</form>
</body>
</html>