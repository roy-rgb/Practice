<?php
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname="userdata";
//
//// Create connection
//$conn = mysqli_connect($servername, $username, $password,$dbname);

$conn = mysqli_connect("localhost", "root", "","userdata");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//if (!$conn) {
//  die("Connection failed: " . mysqli_connect_error());
//}+
?>