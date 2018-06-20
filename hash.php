<!DOCTYPE html>
<html>
	<head>
		<title>Archivatory</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="container">
			<img class="logo" src="img/Archivatory_logo.png" /><br />
<?php
if (isset($_POST['submit'])) {
	$file = $_FILES['file']; // define file

	$fileName = $_FILES['file']['name']; // grab the file name
	$fileTmpName = $_FILES['file']['tmp_name']; // define file temp name
	$fileSize = $_FILES['file']['size']; // grab the file size
	$fileError = $_FILES['file']['error']; // define error code
	$fileType = $_FILES['file']['type']; // grab the file type

	$fileExt = explode('.', $fileName); // separet the file extension from the file name
	$fileActualExt = strtolower(end($fileExt)); // convert file extension to lowercase

	// allowed file extensions
	$allowed = array('jpg', 'jpeg', 'png', 'mp4', 'm4v', 'ogg', 'mp3', 'webm');

	if (in_array($fileActualExt, $allowed)) { // check if file extension is allowed
		if ($fileError === 0) { // check for no error codes
			if ($fileSize < 547608330) { // make sure file size is less than 500MB
				$fileNameNew = uniqid('', true).".".$fileActualExt; // give the upload a uniqe name
				$fileDestination = 'uploads/'.$fileNameNew; // define file upload end location
				move_uploaded_file($fileTmpName, $fileDestination); // move the file
				$output = shell_exec("ipfs add ".$fileDestination." 2>&1"); // Appache runs IPFS upload command
				$dicedOut = explode(' ', $output); // create an array of the IPFS STDOUT dilimited on spaces
				end($dicedOut); // Move pointer to the end of the array
				$hash = prev($dicedOut); // display the second to last item in the array
				// output rest of HTML with the hash in plain text and in link form
				echo '<h3>'.$hash.'</h3>
						<span>Copy and paste the line above to save a copy and use in your favorite decentralized application!</span>
						<span>Or <a href="https://ipfs.io/ipfs/'.$hash.'" target="_blank">click here</a> to see your media in the IPFS gateway.</span>';
			} else {
				echo "Your file is too big. For best results please keep your file under 250MB.";
			}
		} else {
			echo "There was an error during uploading. Please try again.";
		}
	} else {
		echo "Sorry, the ".$fileActualExt." file type is not supported.";
	}
}
?>
			<h3><a href="index.html">Return To Upload.</a></h3>
		</div>
	</body>
</html>
