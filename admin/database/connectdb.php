<?php

$baseurl = $_SERVER['SERVER_NAME'];
if($baseurl=='localhost')
{
define("HOSTNAME","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DATABASE","arogyahealthcareclinicdb");
}else{
define("HOSTNAME","localhost");
define("USERNAME","arogyahealthcareclinic_admindb");
define("PASSWORD","HHduxRwzv9evuTaLuFtm");
define("DATABASE","arogyahealthcareclinic_admindb");
}

$con=new mysqli(HOSTNAME,USERNAME,PASSWORD,DATABASE) or die("Unable to connect");
?>
