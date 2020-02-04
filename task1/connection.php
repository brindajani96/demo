<?php

$servername = "localhost";
$username = "root";
$password = "root";
$databaseName = "login";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $databaseName);

// Check connection
/* if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  } */
?>