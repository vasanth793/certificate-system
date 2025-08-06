<?php
// Localhost development settings (for local testing)
$localHost = "localhost";
$localUser = "root";
$localPass = "";
$localDB = "certificate_system";

// Live server settings (for deployment)
$servername = "sql302.epizy.com"; // Replace with your actual InfinityFree SQL hostname
$username = "epiz_12345678";      // Replace with your actual InfinityFree username
$password = "your_password";      // Replace with your actual InfinityFree password
$dbname = "epiz_12345678_certificate"; // Replace with your actual InfinityFree database name

// Uncomment below line to switch to local development
// $conn = new mysqli($localHost, $localUser, $localPass, $localDB);

// Use this line for live server connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
