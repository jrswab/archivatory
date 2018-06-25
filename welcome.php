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
    <title>Archivatory</title>
		<link rel="stylesheet" 
		href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" 
		integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" 
		crossorigin="anonymous">
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
			meet all the other Archivians!</h4>
		</div>
		<br>
		<form id="upload-form" enctype="multipart/form-data" action="memUp.php" method="POST">
			<div class="text-center">
				<h2>Upload Your File</h2>
				<p>Max allowed file size is 250MB.</p>
				<input class="form-input" type="file" name="file" />
			</div>
			<br><br>
			<button id="click" onclick="pgShow()" 
			class="btn btn-success btn-lg btn-block" name="submit" type="submit">
			Upload</button><br>
			<div id="bar" style="display:none">
				<div class="progress">
					<div class="progress-bar progress-bar-striped progress-bar-animated" 
					role="progressbar" aria-valuenow="100" aria-valuemin="0" 
					aria-valuemax="100" style="width: 100%"></div>
				</div>
				<br>
			</div>

			<p class="alert alert-danger"><strong>Disclaimer:</strong> Due to the 
			nature of IPFS your content may never be able to be removed entirely from 
			the network. Even if we delete your file from our server, the hash will 
			more than likely still proved the end user with a copy. Please keep this in 
			mind when uploading and never upload anything you do not want to be online 
			forever.</p>
			<p class="alert alert-warning">
				<strong>This is still a beta serverice!</strong> Please do not use this as 
				a backup service. We are still in the early stages of Archivatory and 
				don't want you to lose your data. Always save a copy on an external hard drive and a separate cloud service for redundancy.</p>
		</form>
		
		<h3>How To Use:</h3>
		<div>
			<ol>
				<li>Click "Select File"</li>
				<li>Click "Upload"</li>
				<li>Wait. The larger the file the longer it will take to upload so be patient.</li>
			</ol>
		</div>
		
		<p>For video content, we recommend 
			<a href="https://handbrake.fr" target="_blank">HandBreak</a> it's a free 
			and open-source video transcoder that lets the user input their original 
			video and output a web-optimized version. This optimized version will not 
			only upload faster with our service but will also have better playback for 
			your viewers.</p>
		
		<p>Severs of this size are quite expensive; please consider donating STEEM 
			or SBD to <a href="https://steemit.com/@jrswab">@jrswab</a> in order to 
			keep this service running. Be sure to add a memo to let us know the 
			donation is for this project and we'll add your name to the coming 
			"supporters" page.</p>
		
		<p>Donations help show that you would like to see further development on 
			this project. Some things we'd like to include:  user signups so you can 
			save your hashes for future reference, better user experience, and 
			SteemConnect integration.</p>

		<p>If you have a Steem account and find this service helpful please 
			<a href="https://steemconnect.com/sign/account-witness-vote?witness=jrswab&approve=1" target="_blank">
				vote for @jrswab's witness server</a>. Every vote counts no matter how much 
			Steem Power you hold.</p>

		<p>Join us on <a href="https://discord.gg/dKDuaST" target="_blank">
			Discord</a>!</p>

		<p class="alert alert-light">Created by <a href="https://jrswab.com/">
			J. R. Swab</a> under GPLv3 for the idependent content creators around the 
			world. | Col. 3:17</p>
	</div>

<script>
	function pgShow() {
		var bar = document.getElementById("bar");
		bar.style.display = "block";
	}
</script>
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
