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
<html>
	<head>
		<meta charset="UTF-8">
		<title>User Data</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	</head>	
	<body>
		<nav class="navbar navbar-light bg-light">
		  <a class="navbar-brand" href="index.html">Archivatory</a>
			<ul class="nav mr-auto">
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
		</nav>
		<div id="content" class="container">
			<div style="text-align:center;width:100%;">
				<br>
				<h3>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. This is your personal Archivatory Database! </h3>
			</div>

			<?php
				include_once 'config/uploadDBconfig.php';
				// query user data
				$sql = "SELECT * FROM ".$_SESSION['username']." ORDER BY date DESC;";
				$result = mysqli_query($link, $sql);
				$resultCheck = mysqli_num_rows($result);

				if ($resultCheck > 0) {
					// Set up the html table
					echo "<div class='table-responsive'>";
					echo "<table class='table table-striped table-sm'>";
					echo "<thead><tr><th scope='col'>Upload Date</th><th scope='col'>File Name</th><th scope='col'>IPFS Hash</th><th scope='col'>File Size (in bytes)</th></tr></thead>";
					echo "<tbody>";
					// loop through users' table and output into html table body	
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr><td>".$row['date']."</td><td>".$row['file_name']."</td><td><a href='https://ipfs.io/ipfs/".$row['hash']."' target='_blank'>".$row['hash']."</a></td><td>".$row['file_size']."</tr>";
					}
					// end html table
					echo "</tbody>";
					echo "</table>";
					echo "</div>";
				}
			?>
		</div>
	</body>
</html>
