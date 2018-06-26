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
    <title>User Settings</title>
		<link rel="stylesheet" 
		href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" 
		integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" 
		crossorigin="anonymous">
		<!-- Archivonaut Favicons -->
		<link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="img/favicons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="img/favicons/favicon-16x16.png">
		<link rel="manifest" href="img/favicons/site.webmanifest">
		<link rel="mask-icon" href="img/favicons/safari-pinned-tab.svg" color="#f51e0f">
		<link rel="shortcut icon" href="img/favicons/favicon.ico">
		<meta name="msapplication-TileColor" content="#f51e0f">
		<meta name="msapplication-config" content="img/favicons/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">
		<!-- end favicons -->
</head>
<body>
	<nav class="navbar navbar-light bg-light">
		<a class="navbar-brand" href="index.html">Archivatory</a>
		<ul class="nav mr-auto">
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
	</nav>

	<div id="content" class="container">
		<div style="text-align:center;width:100%;">
			<br>
			<h2>Welcome to Archivatory.</h2>
			<h4>More features are coming soon so make sure to join us on 
			<a href="https://discord.gg/dKDuaST" target="_blank">Discord</a> and 
			meet all the other Archivonauts!</h4>
		</div>
		<br>
		<button class="btn btn-danger">Delete Account</button>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" 
		integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" 
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" 
		integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" 
		crossorigin="anonymous"></script>
</body>
</html>
