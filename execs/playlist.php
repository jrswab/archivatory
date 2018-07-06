<?php
	include 'config/uploadDBconfig.php';

	// query user data
	$sql = "SELECT * FROM ".$user." WHERE playlist=1;";
	$result = mysqli_query($link, $sql);
	$resultCheck = mysqli_num_rows($result);
?>
