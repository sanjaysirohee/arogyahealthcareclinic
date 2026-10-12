<?php
$baseurl = $_SERVER['SERVER_NAME'];
//echo $baseurl;
if($baseurl=='localhost')
{
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arogyahealthcareclinicdb";
}else{
 $servername = "localhost";
 $username = "arogyahealthcareclinic_admindb";
 $password = "HHduxRwzv9evuTaLuFtm";
 $dbname = "arogyahealthcareclinic_admindb";
}


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>

