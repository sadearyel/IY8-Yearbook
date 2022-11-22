<?php
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
    <title>IY8 Yearbook - Login</title>
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
        form {
            width: 60%;
            padding-left: 20%;
            padding-right: 20%;

            text-align: left;
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

    <?php
    session_start();

    if($_SESSION["logedin"] == "yes") { // already logged in - reached this page in error
        echo "ALREADY LOGGED IN";
    } else if(!empty($_REQUEST["username"])) { // submitted login form
        $sql = "SELECT * FROM users WHERE username = '" . $_REQUEST["username"] . "'";

        $results = $dbconnection -> query($sql);
        $currentrow = $results -> fetch_assoc();

        // checking whether the inserted password matches the respective password in the database
        if($_REQUEST["password"] == $currentrow["password"]) {
            // valid login
            $_SESSION["loggedin"] = "yes";
            $_SESSION["user_id"] = $currentrow["user_id"];

            echo "SUCCESSFUL LOGIN";
        } else { // invalid login
            echo "ERROR. WRONG PASSWORD";
            exit();
        }
    } else { // not logged in and has not submitted login form
        ?>

        <h1 class="section-title">
            LOGIN PAGE
        </h1>
        <p>
            New to the site? Create an account <a href="signupform.php">here</a>.
            <br><br>
        </p>
        <form>
            <label for="username">
                Username:
            </label>
            <input type="text" name="username">

            <br><br>

            <label for="password">
                Password:
            </label>
            <input type="text" name="password">

            <br><br>

            <input type="submit" value="Log In">
        </form>

        <?php
        exit();
    }
    ?>
</div>

<?php include "Global Elements/footer.php"; ?>

</body>
</html>