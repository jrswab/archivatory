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
			if ($fileSize < 547608330) {
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				$output = shell_exec("ipfs add ".$fileDestination." 2>&1");
				//echo $output."<br />";
				$dicedOut = explode(' ', $output);
				end($dicedOut);
				$hash = prev($dicedOut);
				echo"
<!DOCTYPE html>
<html>
	<head>
		<title>Archivatory</title>
		<link rel='stylesheet' type='text/css' href='style.css'>
	</head>
	<body>
		<div class='container'>
			<img src='img/Archivatory_logo.png' /><br />
			<h3>".$hash."</h3>
			<span>Copy & paste the line above to save a copy and use in your favorite decentralized application!</span>
			<span>Or <a href='https://ipfs.io/ipfs/".$hash."' target='_blank'>click here</a> to see your media in the IPFS gateway.</span>
			<h3><a href='index.html'>Return To Upload.</a></h3>
		</div>
	</body>
</html>";
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
