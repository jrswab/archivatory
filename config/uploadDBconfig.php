<?php
// Database credentials.
$dbServerName = "localhost";
$dbUsername = "";
$dbPassword = "";
$dbName = "archivatoryUploads";
 
// Attempt to connect to MySQL database 
$link = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
