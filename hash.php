<?php
if (isset($_POST['submit'])) {
	$file = $_FILES['file'];

	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png', 'mp4', 'm4v', 'ogg', 'mp3', 'webm');

	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 2362232012) {
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				$output = shell_exec("ipfs add ".$fileDestination." 2>&1");
				//echo $output."<br />";
				$dicedOut = explode(' ', $output);
				end($dicedOut);
				$hash = prev($dicedOut);
				echo"<!DOCTYPE html><html><head>
					<title>Archivatory</title>
					<link rel='stylesheet' type='text/css' href='style.css'>
				     </head>
					<body>
				     <div class='container'>
					<img src='img/Archivatory_logo.png' /><br />
					<div id='upload-form'><p>".$hash."</p><br /><br />
						Copy & paste the line above. <br />
						Or <a href='https://ipfs.io/ipfs/".$hash."' target='_blank'>click here</a> to see your media in the IPFS gateway.<br />
						<h2><a href='index.html'>Return To Upload.</a></h2>
					</div>
				     </div></body></html>";
			} else {
				echo "Your file is too big.";
			}
		} else {
			echo "There was an error during uploading. Please try again.";
		}
	} else {
		echo "This file type is not supported.";
	}
}
?>
