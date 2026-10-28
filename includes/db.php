<?php
$host = "sql312.infinityfree.com";
$username = "if0_43298420";
$password = "sDi9AVuD09DU";
$database = "if0_43298420_if0_43298420_restaurant";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>