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

// First, move the newly uploaded image to the appropriate Image Uploads folder (same folder as regular image uploads, which is okay)
$filepath = $_SERVER["CONTEXT_DOCUMENT_ROOT"] . "/acad276/IY8-Yearbook/Image Uploads/";
move_uploaded_file($_FILES["newimage"]["tmp_name"], $filepath . $_FILES["newimage"]["name"]);

// Then, update the current pfp image attached to the individual's name
$sql = "UPDATE names SET " .
        "pfp = '" . $_FILES["newimage"]["name"] . "'" .
        " WHERE name_id = " . $_REQUEST["name"];

$results = $mysql -> query($sql);

// Testing for possible errors
if(!$results) {
    echo "SQL ERROR! " . $mysql -> error;
} else {
    echo "SUCCESS! Image added.";
}
?>
