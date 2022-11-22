<?php
// redirect page visitors to the sign up form / create an account page if ANY of the data fields are empty
if(empty($_REQUEST["username"]) || empty($_REQUEST["password"]) || empty($_REQUEST["email"])) {
    header('Location: signupform.php');
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
    echo $dbconnection -> connect_error;
    exit();
}
?>

<html lang="en">
<head>
    <title>IY8 Yearbook - Sign Up</title>
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

            text-align: center;
        }
    </style>
</head>
<body>
<div id="container">

    <?php
    $sql = "INSERT INTO users
            (username, password, email, name_id)
            VALUES 
            ('" . $_REQUEST["username"] . "',
            '" . $_REQUEST["password"] . "',
            '" . $_REQUEST["email"] . "',
            " . $_REQUEST["name"] . ")";

    $results = $dbconnection -> query($sql);

    // Testing for possible errors
    if(!$results) {
        echo "SQL ERROR! " . $dbconnection -> error;
    } else {
        echo "SUCCESS! Account added.";
        echo "<br>";
        echo "<a href='index.php'>Take me back home</a>";
    }
    ?>
</div>
</body>
</html>

