<?php
// form, want to be able to search by name (drop down), event (drop down), date (range - date), quote and images default

// connect to db
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

<html lang="en">
<head>
    <title>IY8 Yearbook - Search</title>
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
        #container {
            padding-top: 100px;
            padding-bottom: 100px;
            padding-left: calc(100% * (1 / 12));
            padding-right: calc(100% * (1 / 12));
        }
        form {
            width: 60%;
            padding-left: 20%;
            padding-right: 20%;
        }
        input[type=text], select {
            width: 100%;
            padding-top: 12px;
            padding-bottom: 12px;
            padding-left: 10px;
            padding-right: 10px;

            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=submit] {
            width: 100%;
            margin-top: 50px;
            padding-top: 12px;
            padding-bottom: 12px;
            padding-left: 20px;
            padding-right: 20px;

            background-color: black;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php include "Global Elements/nav.php"; ?>

<div id="container">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 class="section-title">
            IY8 YEARBOOK SEARCH
        </h1>
        <p>
            Currently the database is only populated with images from 2022-02-09. You will be redirected to the search page if a valid date isn't entered.
        </p>
    </div>

    <form action="results.php">

        <?php
        $sql = "SELECT * FROM names ORDER BY name";
        $results = $dbconnection->query($sql);

        if(!$results) {
            echo "SQL error: ". $dbconnection -> error;
            exit();
        }
        ?>

        <label for="name">
            Name:
        </label>
        <select name="name">

            <option value="ALL"> Cohort </option>

            <?php
            while($currentrow = $results->fetch_assoc()){
                echo "<option>" . $currentrow["name"]."</option>";
            }
            ?>

        </select>

        <br><br>

        <?php
        $sql = "SELECT * FROM events ORDER BY event";
        $results = $dbconnection->query($sql);

        if(!$results) {
            echo "SQL error: ". $dbconnection->error;
            exit();
        }
        ?>

        <label for="event">
            Events:
        </label>
        <select name="event">

            <option value="ALL">Everything</option>

            <?php
            while($currentrow = $results->fetch_assoc()){
                echo "<option>" . $currentrow["event"]."</option>";
            }
            ?>

        </select>

        <br><br>

        <label for="date">
            After Date:
        </label>
        <input type="text" name="date" placeholder="yyyy-mm-dd">

        <br><br>

        <label for="quoteImages">
            Quote or Images:
        </label>
        <select name="quoteImages">
            <option>Images</option>
            <option>Quotes</option>
            <option>Both</option>
        </select>

        <br><br>

        <input type="submit" value="Search">
    </form>
</div>

<?php include "Global Elements/footer.php"; ?>

</body>
</html>