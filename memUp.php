<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}

// Loging info for database contianing user tables.
include_once 'config/uploadDBconfig.php';

// Check if a table call 'username' exists
if ($tableCheck = $link->query("SHOW TABLES LIKE '".$_SESSION['username']."'")) {
        if($tableCheck->num_rows == 1) {
                echo "Table Exists";
        } else {
			$sql = "CREATE TABLE " . $_SESSION['username'] . " (
			date TIMESTAMP NOT NULL,
			file_name VARCHAR(256) NOT NULL,
			hash VARCHAR(256) NOT NULL,
			file_size VARCHAR(256) NOT NULL,
			id VARCHAR(256) NOT NULL)";

			$link->query($sql);
		}

	// echo for testing
        //if ($link->query($sql) === TRUE) {
        //        echo "Table ".$_SESSION['username']."  created successfully";
        //} else {
        //        echo "Error creating table: " . $conn->error;
        //}
}

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
                        if ($fileSize < 254321000) { // make sure file size is less than 250MB
                                $fileNameNew = uniqid('', true).".".$fileActualExt; // give the upload a uniqe name
                                $fileDestination = 'uploads/'.$fileNameNew; // define file upload end location
                                move_uploaded_file($fileTmpName, $fileDestination); // move the file
                                $output = shell_exec("ipfs add ".$fileDestination." 2>&1"); // Appache runs IPFS upload command
                                $dicedOut = explode(' ', $output); // create an array of the IPFS STDOUT dilimited on spaces
                                end($dicedOut); // Move pointer to the end of the array
                                $hash = prev($dicedOut); // display the second to last item in the array

                                // add info to users' table
								$sqlAdd = "INSERT INTO ".$_SESSION['username']." (date, file_name, hash, file_size, id) 
									VALUES ('".date("Y/m/d H:i:s")."', '".$fileName."', '".$hash."', '".$fileSize."', '".$fileNameNew."');";
								// run INSERT command
                                $runSql = mysqli_query($link, $sqlAdd);

								// if INSERT is successful send user to their hash table else echo error
                                if ($runSql === true) {
                                        // send user to their table page after IPFS upload and successfully adding information to user mysql table.
										header("Location: hashtable.php");
                                } else {
                                        echo "Error: " . $sqlAdd . "<br />" . $link->error;
										echo "<br><br>Please copy this page or take a screen shot and send it to the #support thread on our <a href='https://discord.gg/PVNKWDx'>Discord chat</a>";
                                }
                        } else {
                                echo "Your file is too big. For best results please keep your file under 500MB.";
								echo "<br><br><a href='welcome.php'>Return to member upload</a>";
                        }
                } else {
                        echo "There was an error during uploading. Please try again.";
						echo "<br><br><a href='welcome.php'>Return to member upload</a>";
                }
        } else {
                echo "Sorry, the ".$fileActualExt." file type is not supported.";
				echo "<br><br><a href='welcome.php'>Return to member upload</a>";
        }
}

$link->close();
