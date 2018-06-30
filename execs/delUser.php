<?php

include 'config/topMem.php'; 
require 'config/config.php';
require 'config/uploadDBconfig.php';

if (isset($_POST['delAccount'])){
	$user = htmlspecialchars($_POST['user']);
	echo '<div class="alert alert-danger" role="alert">';
		echo '<h2>Deleting '.$user;
	echo '</div>';

	$sqlDelUp = 'DROP TABLE archivatoryUploads.'.$user.';';
	$sqlDelUser = 'DELETE FROM archivatory.users WHERE username="'.$user.'";';

	$runDelUp = mysqli_query($link, $sqlDelUp);
	$runDelUser = mysqli_query($link, $sqlDelUser);

	if ($runDelUp) {
		if ($runDelUser) {
			header("Location: index.php");
		} else {
			echo "Could not delete account. <br />";
			echo $link->error;
			echo "<br><br>Please copy this page or take a screen shot and send it to the 
			#support thread on our <a href='https://discord.gg/PVNKWDx'> 
			Discord chat</a>";
		}
	} else {
		echo "Could not delete user content table. <br />";
		echo $link->error;
		echo "<br><br>Please copy this page or take a screen shot and send it to the 
			#support thread on our <a href='https://discord.gg/PVNKWDx'>Discord chat</a>";
	}
}

include 'config/bottom.html';

?>
