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
		  <a class="navbar-brand" href="#">Archivatory</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			  <li class="nav-item">
				<a class="nav-link" href="index.html">Home</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="welcome.php">Upload</a>
			  </li>
			  <li class="nav-item active">
				<span class="nav-link disabled">Your Content<span class="sr-only">(current)</span></span>
			  </li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
			  <a href="logout.php" class="btn btn-danger">Sign Out</a>
			</form>
		  </div>
		</nav>
	</div>
	<div class="container">
		<div style="text-align:center;width:100%;"><h2>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. This is your personal Archivatory Database! </h2></div>
<?php
	include_once 'uploadDBconfig.php';

	$sql = "SELECT * FROM ".$_SESSION['username']." ORDER BY date DESC;";
	$result = mysqli_query($link, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0) {
		echo "<table id='hashTable'";
		echo "<tr><th><h4>Upload Date</h4></th><th><h4>File Name</h4></th><th><h4>IPFS Hash</h4></th><th><h4>File Size (in bytes)</h4></th></tr>";
		$count = 0;
		while ($row = mysqli_fetch_assoc($result)) {
			if ($count % 2 == 0) {
				echo "<tr style='background-color:#e5e4e2;'><td>".$row['date']."</td><td>".$row['file_name']."</td><td><a href='https://gateway.ipfs.io/ipfs/".$row['hash']."' target='_blank'>".$row['hash']."</a></td><td>".$row['file_size']."</tr>";
			} else {
				echo "<tr><td>".$row['date']."</td><td>".$row['file_name']."</td><td><a href='https://gateway.ipfs.io/ipfs/".$row['hash']."' target='_blank'>".$row['hash']."</td><td>".$row['file_size']."</tr>";
			}
			$count++;
		}
		echo "</table>";
	}
?>
	</div>
</body>
</html>
