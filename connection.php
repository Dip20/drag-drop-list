<?php
date_default_timezone_set("Asia/kolkata"); //set asia time
// error_reporting(0);

$conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);

if ($conn->connect_error) {
    echo '<h4 style="color:red; text-align:center;">connect Error: ' . $conn->connect_error . '</h4>';
    die();
}
