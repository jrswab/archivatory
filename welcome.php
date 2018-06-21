<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
        <link rel="stylesheet" type="text/css" href="style.css?v=<?=time();?>">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
    <div class="page-header container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="index.html">Archivatory</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    			<span class="navbar-toggler-icon"></span>
			</button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
				  <li class="nav-item">
						<a class="nav-link" href="index.html">Home</a>
				  </li>
				  <li class="nav-item active">
						<span class="nav-link" href="welcome.php"><span class="sr-only">(current)</span>Upload</span>
				  </li>
				  <li class="nav-item">
						<a class="nav-link" href="hashtable.php">Your Content</a>
				  </li>
				</ul>
				<form class="form-inline my-2 my-lg-0">
				  <span class="btn btn-outline-info"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
				  &nbsp;&nbsp;
				  <a href="logout.php" class="btn btn-outline-danger">Sign Out</a>
				</form>
		  </div>
		</nav>
	</div>

	<div id="content" class="container">
		<div style="text-align:center;width:100%;">
			<h2>Welcome to Archivatory, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>.</h2>
			<h4>Since you signed up to be a member you can now upload a file that is up to 500MB is size! More features are coming soon so make sure to join us on <a href="https://discord.gg/dKDuaST" target="_blank">Discord</a> and meet all the other Archivians!</h4>
		<div>

		<form id="upload-form" enctype="multipart/form-data" action="memUp.php" method="POST">
			<h2>Upload Your File</h2>
			<p>Max allowed file size is 500MB.</p>
			<div class="custom-file">
				<input class="custom-file-input" type="file" name="file" id="customFile">
				<br><br>
				<label class="custom-file-label" for="customFile">Choose file</label>
			</div>
			<button id="click" onclick="pgShow()" class="btn btn-success btn-lg btn-block" name="submit" type="submit">Upload</button><br /><br />
			<img id="bar" style="display:none" src="img/bar.gif" />
			<p><strong>Disclaimer:</strong> Due to the nature of IPFS your content may never be able to be removed entirely from the network. Even if we delete your file from our server, the hash will more than likely still proved the end user with a copy. Please keep this in mind when uploading and never upload anything you do not want to be online forever.</p>
		</form>

	</div>
    <script>
		function pgShow() {
			var bar = document.getElementById("bar");
			bar.style.display = "block";
		}
	</script>
</body>
</html>
