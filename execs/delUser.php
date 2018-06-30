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

	$getProPho = shell_exec('ls uploads/profiles/ | grep '.$user;
	$runDelProPho = shell_exec('rm uploads/profiles/'.$getProPho;

	if ($runDelUp) {
		if ($runDelUser) {
			if ($runDelProPho){
				header("Location: index.php");
			} else {
				echo 'Could not delete '.$getProPho.;
				echo '<br /><br /> Please take a screen shot and send it to the 
				#support thread on our <a href="https://discord.gg/PVNKWDx"> 
				Discord chat</a>';
			}
		} else {
			echo 'Could not delete account. <br />';
			echo $link->error;
			echo '<br /><br /> Please take a screen shot and send it to the 
			#support thread on our <a href="https://discord.gg/PVNKWDx"> 
			Discord chat</a>';
		}
	} else {
		echo "Could not delete user content table. <br />";
		echo $link->error;
		echo '<br /><br /> Please take a screen shot and send it to the 
		#support thread on our <a href="https://discord.gg/PVNKWDx"> 
		Discord chat</a>';
	}
}

include 'config/bottom.html';

?>
