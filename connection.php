<?php
$servername = "localhost";
$database = "quan_ly_kho_hang_2";
$username = "root";
$password = "";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());

}
// echo "Connected successfully"."<br>";

?>