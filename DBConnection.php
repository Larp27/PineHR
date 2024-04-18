<?php
$servername = "localhost";
$uname = "root";
$pass = "";
$dbname = "pinehr_db";

$conn = new mysqli($servername, $uname, $pass, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
