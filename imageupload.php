<?php
session_start();

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

// Dumping variables here to help with looking for bugs
var_dump($_REQUEST);
var_dump($_FILES);

// First, move the newly uploaded image to the appropriate Image Uploads folder
$filepath = $_SERVER["CONTEXT_DOCUMENT_ROOT"] . "/acad276/IY8-Yearbook/Image Uploads/";
move_uploaded_file($_FILES["newimage"]["tmp_name"], $filepath . $_FILES["newimage"]["name"]);

// THIS SECTION IS INCOMPLETE
// Then, add the new image to the Images table with all the necessary info
$sql = "INSERT INTO images
        (image_type_id, name_id, image_name, date, event_id)
        VALUES
        (" . $_REQUEST["image-type"] . ",
        " . $_REQUEST["photographer"] . ",
        '" . $_FILES["newimage"]["name"] . "',
        '" . $_REQUEST["date"] . "',
        " . $_REQUEST["event"] . ")";

$results = $mysql -> query($sql);

// Testing for possible errors
if(!$results) {
    echo "SQL ERROR! " . $mysql -> error;
} else {
    echo "SUCCESS! Image added.";
}
?>