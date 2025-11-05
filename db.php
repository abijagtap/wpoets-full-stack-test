<?php
$servername = "localhost";
$username = "root";
// $password = "";
$password = "redhat@123";
$dbname = "wpoets_test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>
