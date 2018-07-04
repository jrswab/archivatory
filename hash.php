<?php include 'config/mainTop.php'; ?>
			<h2>Here is your IPFS Hash!</h2>
			<h4>If you need to upload larger files user accounts can upload files up 
			to 10x for free! Also, please consider donating while we continue to 
			improve this service. Server space gets very expesive.</h4>
		</div>

		<?php
		if (isset($_POST['submit'])) {
			$file = $_FILES['file']; // define file

			$fileName = $_FILES['file']['name']; // grab the file name
			$fileTmpName = $_FILES['file']['tmp_name']; // define file temp name
			$fileSize = $_FILES['file']['size']; // grab the file size
			$fileError = $_FILES['file']['error']; // define error code
			$fileType = $_FILES['file']['type']; // grab the file type

			// separate the file extension from the file name
			$fileExt = explode('.', $fileName);
			// convert the extension to lower case
			$fileActualExt = strtolower(end($fileExt));

			// allowed file extensions
			$allowed = array('jpg', 'jpeg', 'png', 'mp4', 'm4v', 'ogg', 'mp3', 'webm');

			if (in_array($fileActualExt, $allowed)) { // check if file extension is allowed
				if ($fileError === 0) { // check for no error codes
					if ($fileSize < 26760830) { // make sure file size is less than 500MB
						// give thu upload a unique name
						$fileNameNew = uniqid('', true).".".$fileActualExt;
						// define file upload end location
						$fileDestination = 'uploads/'.$fileNameNew;
						// move the file
						move_uploaded_file($fileTmpName, $fileDestination);
						// apache rust the IPFS upload command
						$output = shell_exec("ipfs add ".$fileDestination." 2>&1");
						// create an array of the IPFS STDOUT, dilimited on spaces
						$dicedOut = explode(' ', $output);
						end($dicedOut); // Move pointer to the end of the array
						// display the second to last item in the array
						$hash = prev($dicedOut);
						// output rest of HTML with the hash in plain text and in link form
						echo '<h3>'.$hash.'</h3>
						<p>Copy and paste the line above to save a copy and use it around 
						the internet!<br /> Or <a href="https://ipfs.io/ipfs/'.$hash.'" 
						target="_blank">click here</a> to see your media in the IPFS gateway.
						</p>';
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
<h3><a href="index.php">Return To Upload.</a></h3>
<?php include 'config/bottom.html'; ?>
