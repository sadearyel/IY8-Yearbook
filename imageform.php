<!-- For now, an ugly page for purely administrative purposes --!>
<!-- We'll use this page to add images to the images table in our db --!>

<?php
$host = "webdev.iyaclasses.com";
$userid = "icleung";
$userpw = "AcadDev_Leung_7912600781";
$db = "icleung_yearbook";

$mysql = new mysqli(
    $host,
    $userid,
    $userpw,
    $db
);
?>

<html lang="en">
<head>
    <title>Administrator Only - Image Form Page</title>
</head>
<body>
<form action="imageupload.php" method="post" enctype="multipart/form-data">

    Image File:
    <input type="file" name="newimage">

    <br><br>

    Image Type:
    <select name="image-type">
        <?php
        $sql = "SELECT * FROM image_types";
        $results = $mysql -> query($sql);

        while($currentrow = $results -> fetch_assoc()) {
            echo "<option value='" . $currentrow['image_type_id'] . "'>" . $currentrow['image_type'] . "</option>";
        }
        ?>
    </select>

    <br><br>

    Photographer:
    <select name="photographer">
        <?php
        $sql = "SELECT * FROM names";
        $results = $mysql -> query($sql);

        while($currentrow = $results -> fetch_assoc()) {
            echo "<option value='" . $currentrow['name_id'] . "'>" . $currentrow['name'] . "</option>";
        }
        ?>
    </select>

    <br><br>

    Date:
    <input type="date" name="date">

    <br><br>

    Event:
    <select name="event">
        <?php
        $sql = "SELECT * FROM events";
        $results = $mysql -> query($sql);

        while($currentrow = $results -> fetch_assoc()) {
            echo "<option value='" . $currentrow['event_id'] . "'>" . $currentrow['event'] . "</option>";
        }
        ?>
    </select>

    <br><br>

    <input type="submit">
</form>
</body>