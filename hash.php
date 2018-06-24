<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Your Hash!</title>
		<link rel="stylesheet" type="text/css" href="style.css?v=<?=time();?>">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	</head>	
	<body>
		<nav class="navbar navbar-light bg-light">
		  <a class="navbar-brand" href="index.html">Archivatory</a>
			<ul class="navbar-nav">
			  <li class="nav-item active">
				  <a class="nav-link" href="index.html"><span class="sr-only">(current)</span></a>
			  </li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<a href="register.php" class="btn btn-outline-danger">Register</a>&nbsp;&nbsp;
				<a href="login.php" class="btn btn-outline-primary">Login</a>
			</form>
		</nav>

		<div id="content" class="container">
			<div style="text-align:center;width:100%;">
				<br>
				<h2>Here is your IPFS Hash!</h2>
				<h4>If you need to upload larger files user accounts can upload files up to 10x for free! Also, please consider donating while we continue to improve this service. Server space gets very expesive.</h4>
			</div>
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
			if ($fileSize < 26760830) { // make sure file size is less than 500MB
				$fileNameNew = uniqid('', true).".".$fileActualExt; // give the upload a uniqe name
				$fileDestination = 'uploads/'.$fileNameNew; // define file upload end location
				move_uploaded_file($fileTmpName, $fileDestination); // move the file
				// $initIPFS = shell_exec("ipfs init 2>&1"); // init IPFS for apache user
				// echo $initIPFS; // output to view any errors with the command above.
				$output = shell_exec("ipfs add ".$fileDestination." 2>&1"); // Appache runs IPFS upload command
				$dicedOut = explode(' ', $output); // create an array of the IPFS STDOUT dilimited on spaces
				end($dicedOut); // Move pointer to the end of the array
				$hash = prev($dicedOut); // display the second to last item in the array
				// output rest of HTML with the hash in plain text and in link form
				echo '<h3>'.$hash.'</h3>
						<span>Copy and paste the line above to save a copy and use it around the internet!</span>
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
