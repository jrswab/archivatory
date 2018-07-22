<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}

$user = htmlspecialchars($_SESSION['username']);

// Loging info for database contianing user tables.
include_once '../config/uploadDBconfig.php';

// Check if a table call 'username' exists
if ($tableCheck = $link->query("SHOW TABLES LIKE '".$user."'")) {
	if($tableCheck->num_rows == 1) {
		if($titleTest = $link->query("SELECT title FROM '".$user."'")) {
				echo '';
		} else {
			$addTitle = "ALTER TABLE ".$user." ADD title VARCHAR(256);";
			$link->query($addTitle);
			$addDes = "ALTER TABLE ".$user." ADD des VARCHAR(60000);";
			$link->query($addDes);
		}
	}
}

if (!$_POST['title']) {
	echo '';
} else {
	$changeTitle = "UPDATE ".$user." SET title = '".$_POST['title']."', date = date WHERE id = '".$_POST['rowID']."';";
	$link->query($changeTitle);
}

if (!$_POST['des']) {
	echo '';
} else {
	$changeDes = "UPDATE ".$user." SET des = '".$_POST['des']."', date = date WHERE id = '".$_POST['rowID']."';";
	$link->query($changeDes);
}

$link->close();

header("location: ../hashtable.php");
